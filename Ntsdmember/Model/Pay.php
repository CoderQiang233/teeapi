<?php

/**
 * 支付订单
 * User: lxl
 * Date: 2018/7/18
 * Time: 下午5:42
 */
class Model_Pay extends PhalApi_Model_NotORM{


    /**
     * @param $openid
     * 通过session3rd获取会员订单信息
     */
    public function findMemOrderBySession3rd($openid){

        $result=DI()->notorm->members_order->where(array('openid'=>$openid,'payment <> ?'=> 0,'pay <> ?'=>'1'))->fetchOne();

        if($result){

            $result['unpaid_money']=$result['level_price']-$result['payment'];
        }
        return $result;
    }

    /**
     * @param $member_order_id
     * 通过member_order_id获取订单记录
     */
    public function findRecordById($member_order_id){

        $result=DI()->notorm->payment_record->where(array('member_order_id'=>$member_order_id,'state'=>'1'))->fetchAll();

        return $result;

    }


    public function addOrder($data,$dataInfo){

        try{

            $data1=$data;
            $data2=$data;

            $data3=$data;
            $data1['pay'] = 0;
            $data2['flag'] = 0;
            $data3['flag'] =1;
            $data3['updatedAt']=date('Y-m-d H:i:s',time());

            if($data['level_price']==0){

                DI() -> logger -> error('插入数据时间: ',date('Y-m-d H:i:s',time()).'插入数据：'.json_encode($data3));
                return  $Ordinary=DI()->notorm->members->insert($data3);


            }else{

                $info=DI()->notorm->members->where('flag',1)->order('authorization_number DESC')->fetchOne();
                if($info['authorization_number']){
                    $authorization_number=$info['authorization_number'] +1;

                }else{
                    $authorization_number=108;
                }

                if($data['level']!=1){
                    $data2['authorization_number']=$this->getcode($authorization_number).$authorization_number;
                }
                DI()->logger->info('3333'.json_encode($dataInfo));
                //首次支付：没有会员订单id则为首次支付
                if(!$dataInfo->member_order_id){
                    DI()->logger->info('1111'.json_encode($dataInfo->member_order_id));
                    DI()->logger->info('2222'.json_encode(!$dataInfo->member_order_id));


                    $data1['payment']=0;

                    $rs = DI()->notorm->members_order-> insert($data1);//插入member_order表

                    //应付金额>实付金额,插入payment_record表
                    if(trim($data1['level_price'])>trim($dataInfo-> money)){
                        //剩余未支付金额=应付金额-实付金额
                        $unpaid_money=$data1['level_price']-$dataInfo-> money;
                        $record_info=array(
                            'order_id' => $data1['order_id'],//微信支付ID
                            'member_order_id' => $rs['id'],//会员订单表ID
                            'total_money' => trim($data1['level_price']),//订单总金额11734
                            'money' => trim($dataInfo-> money),//实际支付金额
                            'unpaid_money' => $unpaid_money,//剩余未支付金额
                            'create_time' => date("Y-m-d H:i:s"),//创建时间
                            'state' => '0',//是否支付(1:支付,0:未支付)
                        );

                        DI()->logger->log('insertPaymentRecord','插入支付记录表'.date("Y-m-d H:i:s"),json_encode($record_info));

                        $result=DI()->notorm->payment_record->insert($record_info);

                        DI()->logger->log('insertPaymentRecord','插入支付记录表成功'.date("Y-m-d H:i:s"),json_encode($result));

                    }
                    DI()->notorm->members->insert($data2);
                }else{//非首次支付

                    $member_order=DI()->notorm->members_order->where('id', $dataInfo->member_order_id)->fetchOne();

                    //现已支付金额=原已支付金额+本次支付金额
                    $payment_money=$member_order['payment']+$dataInfo-> money;

                    //剩余未支付金额=应付金额-实付金额
                    $unpaid_money=trim($data1['level_price'])-$payment_money;

                    $record_info=array(
                        'order_id' => $data1['order_id'],//微信支付ID
                        'member_order_id' => $dataInfo->member_order_id,//会员订单表ID
                        'total_money' => $data1['level_price']-$member_order['payment'],//改变前订单剩余总金额
                        'money' => trim($dataInfo-> money),//支付金额
                        'unpaid_money' => $unpaid_money,//现在剩余未支付金额
                        'create_time' => date("Y-m-d H:i:s"),//创建时间
                        'state' => '0',//是否支付(1:支付,0:未支付)
                    );

                    DI()->logger->log('insertPaymentRecord','再次插入支付记录表'.date("Y-m-d H:i:s"),json_encode($record_info));

                    //插入会员订单支付明细表
                    $result=DI()->notorm->payment_record->insert($record_info);

                    DI()->logger->log('insertPaymentRecord','再次插入支付记录表成功'.date("Y-m-d H:i:s"),json_encode($result));

                }


                DI() -> logger -> error('插入数据时间: ',date('Y-m-d H:i:s',time()).'插入数据：'.json_encode($data2));

                return true;
            }


        }catch (Exception $e){

            DI() -> logger -> error('生成订单失败原因: ',$e);
            return false;

        }

    }

    public function upgrade($data){

        try{



            $info=DI()->notorm->upgrade_record;

            $info->insert($data);


            return true;


        }catch (Exception $e){

            DI() -> logger -> error('生成订单失败原因: ',$e);
            return false;

        }

    }

    public function proxybinding($data){


        $info=DI()->notorm->members;

        $data2=array();
        $data2['openid']=$data['openid'];
        $data2['wx_num']=$data['wx_num'];
        $data2['nick_name']=$data['nick_name'];
        $data2['head_portrait']=$data['head_portrait'];


        $members=$info->where(array("phone" => $data['phone'],'flag'=>1 ))->fetchOne();
        if($members){
            $updata=$info->where(array("phone" => $data['phone'],'flag'=>1 ))->update($data2);
            if($updata){
                return $updata;
            }else{
                return '重复绑定';
            }
        }else{
            return '没有该会员';
        }


    }

    function getcode($data){
        $length=6-strlen($data);
        $num='';
        for ($i=0;$i<$length;$i++){
            $num=$num.'0';
        }
        return $num;

    }
    /**
     * 新注册用户信息（带推荐人）记录到返现明细表
     */
    public  function  recordCashBack($id){
        try{
            //获取新注册用户用户信息(下级)
            $members=DI()->notorm->members->where(array('id'=>$id,))->fetchOne();

            //获取推荐人相关信息(上级)
            $referee=DI()->notorm->members->where(array('phone'=>$members['referee_phone'],"flag" => Domain_Pay::ORDER_STATUS_1))->fetchOne();

            $arr=array();

            $arr['member_id']=$members['id'];

            $arr['referee_id']=$referee['id'];

            $arr['member_name']=$members['name'];

            $arr['member_level']=$members['level'];

            $arr['member_price']=$members['level_price'];

            $arr['referee_name']=$referee['name'];

            $arr['referee_level']=$referee['level'];


            switch ($referee['level'])
            {
                case 2:
                    $arr['cashback_percentage']=0.15.'';//返现比例

                    $arr['final_cashback_amount']=$members['level_price']*0.15.'';

                    $arr['same_month']=$members['level_price']*0.7*0.15.'';//当月应返现

                    $arr['next_month']=$members['level_price']*0.3*0.15.'';//下月结余
                    break;
                case 3:
                    $arr['cashback_percentage']=0.3.'';//返现比例

                    $arr['final_cashback_amount']=$members['level_price']*0.3.'';

                    $arr['same_month']=$members['level_price']*0.7*0.3.'';//当月应返现

                    $arr['next_month']=$members['level_price']*0.3*0.3.'';//下月结余
                    break;
                case 4:
                    $arr['cashback_percentage']=0.3.'';//返现比例

                    $arr['final_cashback_amount']=$members['level_price']*0.3.'';

                    $arr['same_month']=$members['level_price']*0.7*0.3.'';//当月应返现

                    $arr['next_month']=$members['level_price']*0.3*0.3.'';//下月结余
                    break;
                default:
                    return;
            }


            $arr['registration_date']=date("Y-m-d H:i:s",time());//下级注册时间

            $arr['record_date']=date("Y-m",time());//记录时间

            DI()->notorm->cash_record->insert($arr);

            //统计注册人信息并计算返现金额记录到cash_month_record表中
            $current=date("Y-m",time());//获取当前年月

            $cashmonth=DI()->notorm->cash_month_record->where(array('cash_time'=>$current,'cash_id'=>$referee['id']))->fetchOne();

            if($cashmonth){
                //已有记录情况下获取到已有返现费用+新注册人注册费用并更新
                $newprice=$cashmonth['cash_price']+$arr['same_month'];

                DI()->notorm->cash_month_record->where('id',$cashmonth['id'])->update(array('cash_price'=>$newprice));

            }else{
                $datas=array();
                //上月
                $timestamp=strtotime(date("Y-m"));

                $firstmonth=date('Y-m',strtotime(date('Y',$timestamp).'-'.(date('m',$timestamp)-1)));

                $firstcashmonth=DI()->notorm->cash_month_record->where(array('cash_time'=>$firstmonth,'cash_id'=>$referee['id']))->fetchOne();
                //如果上月返现金额存在
                if($firstcashmonth){
                    //明细表中该注册人当月应返现金额
                    $datas['cash_price']=$firstcashmonth['cash_price']/7*3+$arr['same_month'];
                }else{
                    $datas['cash_price']=$arr['same_month'];
                }


                $datas['cash_time']=date("Y-m",time());

                $datas['cash_id']=$referee['id'];
                //1已返现2未返现
                $datas['status']='2';

                DI()->notorm->cash_month_record->insert($datas);

            }
            return true;
        }catch (Exception $e){
            DI() -> logger -> error('返现明细记录id值: '.$id+'插入失败',$e);

            return false;
        }


    }




}