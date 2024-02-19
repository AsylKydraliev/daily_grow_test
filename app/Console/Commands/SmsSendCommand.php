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

        $phones_list = implode(", ", $clientPhones);

        $activeMailing = Mailing::query()->where('is_active', Mailing::MAILING_IS_ACTIVE)->first();

        if (!empty($clientPhones) && $activeMailing) {
            $response = $this->smsService->sendSMS(
                env('SMS_SEND_API_LOGIN'),
                env('SMS_SEND_API_PASSWORD'),
                $phones_list,
                $activeMailing->message
            );

            if (!$response['error_code']) {
                $activeMailing->delivered_count += count($clientPhones);
            }

            $activeMailing->sent_count += count($clientPhones);
            $activeMailing->save();
        }
    }
}
