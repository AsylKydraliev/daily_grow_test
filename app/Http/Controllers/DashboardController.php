<?php

namespace App\Http\Controllers;


use App\Models\Client;
use App\Models\Mailing;
use Inertia\Inertia;
use Inertia\Response;

class DashboardController extends Controller
{
    /**
     * @return Response
     */
    public function index(): Response
    {
        $clientsCount = Client::query()->count('id');
        $mailingsSentCount = Mailing::query()->sum('sent_count');
        $mailingsDeliveredCount = Mailing::query()->sum('delivered_count');

        return Inertia::render('Home', [
           'clientsCount' =>  $clientsCount,
           'mailingsSentCount' =>  $mailingsSentCount,
           'mailingsDeliveredCount' =>  $mailingsDeliveredCount,
        ]);
    }
}
