<?php
require_once dirname(__FILE__) .'/../libraries/JWT.php';
class jwt_helper
{

    const CONSUMER_KEY = 'huiyi'; // please replace YOUR_XX
    const CONSUMER_SECRET = 'huiyi'; // please replace YOUR_XX
    const CONSUMER_TTL = 86400;

    // create token
    public static function create($user)
    {
//        $CI =DI();
        $token = JWT::encode(array(
            'consumerKey' => self::CONSUMER_KEY,

            'user' => $user,
            'issuedAt' => date(DATE_ISO8601, strtotime("now")),
            'ttl' =>time()+ self::CONSUMER_TTL
        ), self::CONSUMER_SECRET);
        return $token;
    }

    // validate token
    public static function validate($token)
    {
//        $CI =DI();
//        $CI->load->library('JWT');
        try {
            JWT::decode($token, self::CONSUMER_SECRET);
            return true;
        } catch (Exception $e) {
            return false;
        }

    }

    // decode token
    public static function decode($token)
    {
//        $CI =DI();
//        $CI->load->library('JWT');
        try {
            $decodeToken = JWT::decode($token, self::CONSUMER_SECRET);
            return $decodeToken;
        } catch (Exception $e) {
            return false;
        }
    }
}
