<?php

namespace App\Http\Controllers;

use App\Models\Mailing;
use App\Http\Requests\StoreMailingRequest;
use Illuminate\Http\RedirectResponse;
use Inertia\Inertia;
use Inertia\Response;

class MailingController extends Controller
{
    /**
     * @return Response
     */
    public function index(): Response
    {
        $mailings = Mailing::query()
            ->orderByDesc('created_at')
            ->paginate(10);

        return Inertia::render('Mailings/Index', [
            'mailings' => $mailings
        ]);
    }

    /**
     * @return Response
     */
    public function create(): Response
    {
        return Inertia::render('Mailings/Create');
    }

    /**
     * @param StoreMailingRequest $request
     * @return RedirectResponse
     */
    public function store(StoreMailingRequest $request): RedirectResponse
    {
        Mailing::query()->create($request->validated());

        return to_route('mailings.index');
    }
}
