<?php

namespace App\GitHubApi;


use App\Helpers\DateHelper;

/**
 * Class GitHubApi
 * @package App\GitHubApi
 */
class GitHubApi
{

    /**
     * call github api and decode json result to returning an associative array
     * @return mixed[]
     */
    public static function callApi(): array {

        $date = DateHelper::getDate();
        $curl = curl_init("https://api.github.com/search/repositories?q=created:>{$date}&sort=stars&order=desc");
        curl_setopt_array($curl,[
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HTTPHEADER => [
                "User-Agent: Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/47.0.2526.111 YaBrowser/16.3.0.7146 Yowser/2.5 Safari/537.36"
            ]
        ]);
        $data = curl_exec($curl);
        if($data == false || curl_getinfo($curl, CURLINFO_HTTP_CODE ) !== 200){

            return  ["error" => curl_error($curl)];
        }else{
            $data = json_decode($data, true);
        }

        curl_close($curl);

        return $data;

    }

}