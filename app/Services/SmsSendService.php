<?php

namespace App\Services;

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Http;

class SmsSendService
{
    /**
     * @param $login
     * @param $password
     * @param $phones
     * @param $message
     * @return mixed
     */
    public function sendSMS($login, $password, $phones, $message): mixed
    {
        $response = Http::post('https://smsc.ru/rest/send/', [
            'login' => $login,
            'psw' => $password,
            'phones' => $phones,
            'mes' => $message
        ]);

        return $this->processResponse($response);
    }

    /**
     * @param $response
     * @return mixed
     */
    private function processResponse($response): mixed
    {
        $body = $response->getBody()->getContents();
        return json_decode($body, true);
    }
}
