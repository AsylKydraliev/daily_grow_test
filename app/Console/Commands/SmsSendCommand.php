<?php

namespace App\Console\Commands;

use App\Models\Client;
use App\Models\Mailing;
use App\Services\SmsSendService;
use Illuminate\Console\Command;

class SmsSendCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:sms-send';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send SMS to specified phones';

    protected SmsSendService $smsService;

    public function __construct(SmsSendService $smsService)
    {
        parent::__construct();
        $this->smsService = $smsService;
    }

    /**
     * @return void
     */
    public function handle(): void
    {
        $clients = Client::query()
            ->whereDate('birthday', '=', now()->addDays(8)->format('Y-m-d'))
            ->get();

        $mailing = Mailing::query()->latest()->first();

        foreach ($clients as $client) {
            $recipient = $client->email;
            if ($recipient) {
                $phones = preg_split("/[\s,;]+/", $client->phone);

                // TODO если ответ успешный то записать статус в таблицу рассылок для аналитики
                // TODO для аналитики, вывести количество отправленных, и кол-во доставленных, нужно будет записывать эти значения
                // TODO настроить отправку смс на сервере

                $this->smsService->sendSMS(
                    env('SMS_SEND_API_LOGIN'),
                    env('SMS_SEND_API_PASSWORD'),
                    $phones[0],
                    $mailing->message
                );
            }
        }
    }
}
