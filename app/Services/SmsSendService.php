<?php

namespace App\Services;

use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;

class SmsSendService
{
    /**
     * @param $login
     * @param $password
     * @param $phones
     * @param $message
     * @return Response
     */
    public function sendSMS($login, $password, $phones, $message): Response
    {
        return Http::post('https://smsc.ru/rest/send/', [
            'login' => $login,
            'psw' => $password,
            'phones' => $phones,
            'mes' => $message
        ]);
    }
}
