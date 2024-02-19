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
        $nextWeek = now()->addDays(7);
        $clientPhones = Client::query()
            ->whereMonth('birthday', '=', $nextWeek->month)
            ->whereDay('birthday', '=', $nextWeek->day)
            ->pluck('phone')
            ->toArray();

        $mailing = Mailing::query()->latest()->first();

        $phones_list = implode(", ", $clientPhones);

        if (!empty($clientPhones)) {
            $response = $this->smsService->sendSMS(
                env('SMS_SEND_API_LOGIN'),
                env('SMS_SEND_API_PASSWORD'),
                $phones_list,
                $mailing->message
            );

            if (!$response['error_code']) {
                $mailing->delivered_count += count($clientPhones);
            }

            $mailing->sent_count += count($clientPhones);
            $mailing->save();
        }
    }
}
