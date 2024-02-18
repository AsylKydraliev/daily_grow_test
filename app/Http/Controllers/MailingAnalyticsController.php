<?php

namespace App\Http\Controllers;

use App\Models\Mailing;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class MailingAnalyticsController extends Controller
{
    public function index(Request $request): Response
    {
        $mailingAnalytics = Mailing::query()
            ->filter($request->all())
            ->orderByDesc('created_at')
            ->get();

        $sentCount = $mailingAnalytics->sum('sent_count');
        $deliveredCount = $mailingAnalytics->sum('delivered_count');

        return Inertia::render('Analytics/Index', [
            'mailingAnalytics' => $mailingAnalytics,
            'sentCount' => $sentCount,
            'deliveredCount' => $deliveredCount,
        ]);
    }
}
