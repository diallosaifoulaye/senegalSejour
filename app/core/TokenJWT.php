<?php
/**
 * Created by PhpStorm.
 * User: Seyni FAYE
 * Date: 17/08/2017
 * Time: 11:01
 */

namespace app\core;

abstract class TokenJWT
{
    public static function encode($params, $key, $expire = false) {
        if($expire !== false && intval($expire) > 0)
            $params["expire"] = strtotime(Utils::getDateFuturFromDate([$expire,"minute"], "now"));
        return \JWT::encode($params, $key);
    }

    public static function decode($tokenJWT, $key) {
        try{
            return \JWT::decode($tokenJWT, $key, ['HS256']);
        }catch(\Exception $ex){
            return -2;
        }
    }

    /**
     * @param $tokenJWT
     * @param $key
     * @return bool|int|object
     *
     *  si retourne -1 alors le Token a expiré
     *  si retourne -2 alors le Token est invalide
     *
     */
    public static function verif($tokenJWT, $key) {
        try{
            $now = Utils::getDateNow(true);
            $result = \JWT::decode($tokenJWT, $key, ['HS256']);
            if (isset($result->{"expire"}))
                return (strtotime($now) < $result->{"expire"}) ? ($result->{"expire"} - strtotime($now)) : -1;
            else return $result;
        }catch(\Exception $ex){
            return -2;
        }
    }
}