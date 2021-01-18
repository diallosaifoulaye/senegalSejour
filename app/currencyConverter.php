<?php


namespace app;


class currencyConverter
{
    public static function currencyConverter($currency_from,$currency_to,$currency_input,$api){

        $string = $currency_from."_".$currency_to;

        $url = "https://free.currconv.com/api/v7/convert?q=".$string."&compact=ultra&apiKey=".$api;

        $request = curl_init();
        curl_setopt ($request, CURLOPT_URL, $url);
        curl_setopt ($request, CURLOPT_RETURNTRANSFER, 1);

//        curl_setopt ($request, CURLOPT_USERAGENT,"Mozilla/4.0 (compatible; MSIE 8.0; Windows NT 6.1)");
//        curl_setopt ($request, CURLOPT_CONNECTTIMEOUT, $timeOut);

        $response = curl_exec($request);

        $response = json_decode($response,true);

        $rate = $response[$string];

        curl_close($request);

        return $rate * $currency_input;
    }

}