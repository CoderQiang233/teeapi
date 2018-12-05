<?php

/**
 * Created by PhpStorm.
 * User: lxl
 * Date: 2018/7/18
 * Time: 下午3:21
 */
class Domain_Pay
{
    const ORDER_STATUS_0 = 0; // 未支付

    const ORDER_STATUS_1 = 1; // 已支付


    public function findMemOrderBySession3rd($openid){

        $model = new Model_Pay();

        return $model->findMemOrderBySession3rd($openid);

    }


    public function findRecordById($member_order_id){

        $model = new Model_Pay();

        return $model->findRecordById($member_order_id);

    }

    public function addOrder($data,$dataInfo){

        $pay = new Model_Pay();

        if($data['level_price']==0){

            return $pay ->addOrder($data,$dataInfo);
        }else{

            if($pay ->addOrder($data,$dataInfo)){

                return $this->unifiedOrder($data,$dataInfo);

            }else{
                return false;
            }
        }



    }
  
  public function upgrade($data){

        $pay = new Model_Pay();


        if($pay ->upgrade($data)){

            return $this->unifiedOrder2($data);

        }else{
            return false;
        }


    }

    //代理绑定

    public function proxybinding($data){

        $pay = new Model_Pay();


        return $pay->proxybinding($data);


    }


    /**
     * 支付接口
     * @return [type] [description]
     */
    private function unifiedOrder($_data,$dataInfo){

        $data = array();
        $data['order_no'] = $_data['order_id'];
        $data['title'] = '';
        $data['body'] = '志梨国际-会费结算';
        $data['price'] = $dataInfo->money;
        $data['openid'] = $_data['openid'];
        return DI()->pay->buildRequestForm($data);
    }
  
  	private function unifiedOrder2($_data){

        $data = array();
        $data['notify_url'] = 'https://xcxadmin.zgftlm.com/Public/pay/wechat/notify2.php';
        $data['order_no'] = $_data['order_id'];
        $data['title'] = '';
        $data['body'] = '志梨国际-会员升级';
        $data['price'] = $_data['up_price'];
        $data['openid'] = $_data['openid'];
        return DI()->pay->buildRequestForm($data);
    }
  


}