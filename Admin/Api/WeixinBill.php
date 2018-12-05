<?php

/**
 * 微信下载对账单
 *
 * @author: dogstar <chanzonghuang@gmail.com> 2014-10-04
 */
class Api_WeixinBill  extends PhalApi_Api{


    public function getRules() {
        return array(

            'getWeixinBill'=> array(),

        );
    }

    /**
     *定时核对账单，并更新未更新状态的数据pay,updatedAt,update_date
     */
    public function checkBill(){

        try{

            DI()->logger->log('checkBill','进入微信对账单',date('Y-m-d H:i:s'));

            $weixinBillData=$this->getWeixinBill();

            if(!$weixinBillData){
                DI()->logger->log('checkBill','核对账单，微信端无账单',date('Y-m-d H:i:s'));
                return 'warn';
            }
            DI()->logger->log('checkBill','微信端的账单',json_encode($weixinBillData));
            $bill_date=date("Y-m-d",strtotime("-1 day"));//获取昨天日期
//            $data=DI()->notorm->commodity_order->where(array('create_time LIKE ?'=> '2018-10-26%','pay'=>'0'))->fetchAll();
            $data=DI()->notorm->commodity_order->where(array('create_time LIKE ?'=> $bill_date.'%','pay'=>'0'))->fetchAll();
            DI()->logger->log('checkBill','需核对的账单',json_encode($data));
            $rows=array();
            if(count($data)>0){
                if(count($weixinBillData['bill'])>0){
                    for($i=0;$i<count($data);$i++){
                        $order=$data[$i];
                        for($j=0;$j<count($weixinBillData['bill']);$j++){
                            $bill=$weixinBillData['bill'][$j];
                            if( trim($order['order_id'])==trim($bill['order_sn_sh'])){
                                $rows[$i]['order_id']=$order['order_id'];
                                $rows[$i]['order_sn_wx']=$bill['order_sn_wx'];
                                $rows[$i]['create_time']=date('Y-m-d H:i:s');
                                $info=array(
                                    'updatedAt' => date('Y-m-d H:i:s'),
                                    'update_date' => time(),
                                    'pay' => '1',
                                );
                                DI()->notorm->commodity_order->where('order_id', $order['order_id'])->update($info);
                                DI()->logger->log('checkBill','对账单',json_encode($order));
                            }
                        }
                    }
                    $rs=DI()->notorm->wx_bill_record->insert_multi($rows);
                }
            }
            return 'success';

        }catch (Exception $e){

            DI()->logger->log('checkBill','核对账单，更改数据失败',$e);

            return 'error';
        }
    }


    /**
     * 微信下载对账单
     * @return array
     */
    public function getWeixinBill(){

        try{

            //微信对账单链接
            $wexinBill=DI()->config->get('app.weixinBill');
            $url=$wexinBill['url'];
            //公众账号ID,即appid
            $wechat=DI()->config->get('app.Pay');
            $appid=$wechat['wechat']['appid'];
            //商户号
            $mch_id=$wechat['wechat']['mchid'];
            //随机字符串
            $nonce_str=$this->createNoncestr();
            //签名所需数据
//            $bill_date='20181016';
            $bill_date=date("Ymd",strtotime("-1 day"));//获取昨天的日期
            $bill_type=$wexinBill['bill_type'];
            $data=array();
            $data['appid']=$appid;//appid
            $data['mch_id']=$mch_id;//商户号
            $data['nonce_str']=$nonce_str;//随机字符串
            $data['bill_date']=$bill_date;//对账单日期
            $data['bill_type']=$bill_type;//账单类型
            //签名
            $sign=$this->getSign($data);
            $data['sign']=$sign;//签名
            $dataXml=$this->arrayToXml($data);
            // 进行POST 返回请求结果
            $weixinBillData = $this->postXmlCurl($dataXml,$url);

            if($weixinBillData){
                return array(
                    'bill'=>$weixinBillData['bill'],
                    'total'=>count($weixinBillData['bill']),
                );
            }else{
                return false;
            }

        }catch (Exception $e){

            DI()->logger->log('weixinBill','微信对账单',$e);

            return false;

        }


    }


    /**
     *  产生随机字符串，不长于32位
     */
    private function createNoncestr( $length = 32 ){
        $chars = "abcdefghijklmnopqrstuvwxyz0123456789";
        $str ="";
        for ( $i = 0; $i < $length; $i++ )  {
            $str.= substr($chars, mt_rand(0, strlen($chars)-1), 1);
        }
        return $str;
    }

    /**
     *  生成签名
     */
    private function getSign($data){
        //第一步：对参数按照key=value的格式，并按照参数名ASCII字典序排序如下：
        ksort($data);
        $string = $this->toUrlParams($data);

        //第二步：拼接API密钥
        $wechat=DI()->config->get('app.Pay');
        $string = $string."&key=".$wechat['wechat']['key'];

        //MD5加密
        $string = md5($string);

        //将得到的字符串全部大写并返回
        return strtoupper($string);
    }

    /**
     * 	array转xml
     */
    private function arrayToXml($arr){
        $xml = "<xml>";
        foreach ($arr as $key=>$val)
        {
            if (is_numeric($val))
            {
                $xml=$xml."<".$key.">".$val."</".$key.">";

            }
            else
                $xml=$xml."<".$key."><![CDATA[".$val."]]></".$key.">";
        }
        $xml=$xml."</xml>";
        return $xml;
    }

    /**
     * 将xml转为array
     * @param string $xml
     * @throws WxPayException
     */
    public function xmlToArray($xml){
        //将XML转为array
        //禁止引用外部xml实体
        libxml_disable_entity_loader(true);
        $array = json_decode(json_encode(simplexml_load_string($xml, 'SimpleXMLElement', LIBXML_NOCDATA)), true);
        return $array;
    }

    /**
     *
     * 拼接签名字符串
     * @param array $urlObj
     *
     * @return 返回已经拼接好的字符串
     */
    private function toUrlParams($urlObj){
        $buff = "";
        foreach ($urlObj as $k => $v)
        {
            if($k != "sign" && $v !== ''){
                $buff .= $k . "=" . $v . "&";
            }
        }

        $buff = trim($buff, "&");
        return $buff;
    }

    //自定义xml验证函数xml_parser()
    function xml_parser($str){

        $xml_parser = xml_parser_create();

        if(!xml_parse($xml_parser,$str,true)){//不是xml格式数据

            xml_parser_free($xml_parser);

            return false;

        }else {

            return true;//是xml格式数据

        }

    }

    /**
     * 以post方式提交xml到对应的接口url
     *
     * @param string $xml  需要post的xml数据
     * @param string $url  url
     * @param bool $useCert 是否需要证书，默认不需要
     * @param int $second   url执行超时时间，默认30s
     * @throws WxPayException
     */
    private function postXmlCurl($xml, $url, $useCert = false, $second = 30){
        $ch = curl_init();
        //设置超时
        curl_setopt($ch, CURLOPT_TIMEOUT, $second);

        //这里设置代理，如果有的话
        //curl_setopt($ch,CURLOPT_PROXY, '8.8.8.8');
        //curl_setopt($ch,CURLOPT_PROXYPORT, 8080);

        curl_setopt($ch,CURLOPT_URL, $url);
        curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,FALSE);
        curl_setopt($ch,CURLOPT_SSL_VERIFYHOST,FALSE);//严格校验
        //设置header
        curl_setopt($ch, CURLOPT_HEADER, FALSE);
        //要求结果为字符串且输出到屏幕上
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);

        if($useCert == true){
            //设置证书
            //使用证书：cert 与 key 分别属于两个.pem文件
            curl_setopt($ch,CURLOPT_SSLCERTTYPE,'PEM');
            curl_setopt($ch,CURLOPT_SSLCERT, dirname(dirname(__FILE__)) . '/' . $this->config['cert_path']);
            curl_setopt($ch,CURLOPT_SSLKEYTYPE,'PEM');
            curl_setopt($ch,CURLOPT_SSLKEY, dirname(dirname(__FILE__)) . '/' . $this->config['key_path']);
        }
        //post提交方式
        curl_setopt($ch, CURLOPT_POST, TRUE);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $xml);
        //运行curl
        $data = curl_exec($ch);

        if($this->xml_parser($data)){//是xml格式的数据
            $data=$this->xmlToArray($data);
            if($data['error_code']=='20002'){
                DI()->logger->log('billError','账单不存在，错误码', $data);
                return false;//当日账单不存在
            }else{
                DI()->logger->log('billError','curl出错，错误码', $data);
                return false;//其他失败情况
            }
        }else{//不是xml格式数据直接返回结果
            $data=$this->deal_WeChat_response($data);
            return $data;
        }
    }


    /**
     * 微信对账单数据处理
     * @param $response 对账单数据
     * @return array 返回结果
     */
    public function deal_WeChat_response($response){
        $result   = array();
        $response = str_replace(","," ",$response);
        $response = explode(PHP_EOL, $response);

        foreach ($response as $key=>$val){
            if(strpos($val, '`') !== false){
                $data = explode('`', $val);
                array_shift($data); // 删除第一个元素并下标从0开始
                if(count($data) == 20){ // 处理账单数据
                    $result['bill'][] = array(
                        'pay_time'             => $data[0], // 支付时间1
                        'APP_ID'               => $data[1], // app_id
                        'MCH_ID'               => $data[2], // 商户id
                        'IMEI'                 => $data[4], // 设备号
                        'order_sn_wx'          => $data[5], // 微信订单号2
                        'order_sn_sh'          => $data[6], // 商户订单号3
                        'user_tag'             => $data[7], // 用户标识
                        'pay_type'             => $data[8], // 交易类型
                        'pay_status'           => $data[9], // 交易状态4
                        'bank'                 => $data[10], // 付款银行5
                        'money_type'           => $data[11], // 货币种类
                        'total_amount'         => $data[12], // 总金额6
                        'coupon_amount'        => $data[13], // 代金券或立减优惠金额
//                        'refund_number_wx'     => $data[14], // 微信退款单号
//                        'refund_number_sh'     => $data[15], // 商户退款单号
//                        'refund_amount'        => $data[16], // 退款金额
//                        'coupon_refund_amount' => $data[17], // 代金券或立减优惠退款金额
//                        'refund_type'          => $data[18], // 退款类型
//                        'refund_status'        => $data[19], // 退款状态
//                        'goods_name'           => $data[20], // 商品名称
//                        'service_charge'       => $data[22], // 手续费
//                        'rate'                 => $data[23], // 费率
                    );
                }
//                if(count($data) == 7){ // 统计数据
//                    $result['summary'] = array(
//                        'order_num'       => $data[0],    // 总交易单数
//                        'turnover'        => $data[1],    // 总交易额
//                        'refund_turnover' => $data[2],    // 总退款金额
//                        'coupon_turnover' => $data[3],    // 总代金券或立减优惠退款金额
//                        'rate_turnover'   => $data[4],    // 手续费总金额
//                        'order_turnover' => $data[5],    // 订单总金额
//                        'order_refund_turnover'   => $data[6],    // 申请退款总金额
//                    );
//                }
            }
        }
        return $result;
    }






}