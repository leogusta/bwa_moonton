<?php

namespace App\Http\Middleware;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Auth;
use Inertia\Middleware;

class HandleInertiaRequests extends Middleware
{
    /**
     * The root template that is loaded on the first page visit.
     *
     * @var string
     */
    protected $rootView = 'app';

    /**
     * Determine the current asset version.
     */
    public function version(Request $request): string|null
    {
        return parent::version($request);
    }

    private function activePlan()
    {
        $activePlan = Auth::user() ? Auth::user()->LastActiveUserSubscription : null;

        if (!$activePlan) {
            return null;
        }

        $lastDays = Carbon::parse($activePlan->updated_at)->addMonths($activePlan->subscriptionPlan->active_period_in_months);
        $activeDays = Carbon::parse($activePlan->updated_at)->diffInDays($lastDays);
        $remainingActiveDays = Carbon::parse($activePlan->expired_date)->diffInDays(Carbon::now(), true);

        // return response()->json([
        //     'name' => $activePlan->subscriptionPlan->name,
        //     'remainingActiveDays' => round($remainingActiveDays, 0),
        //     'activeDays' => $activeDays,
        // ]);

        return [
            'name' => $activePlan->subscriptionPlan->name,
            'remainingActiveDays' => round($remainingActiveDays, 0),
            'activeDays' => $activeDays,
        ];
    }

    /**
     * Define the props that are shared by default.
     *
     * @return array<string, mixed>
     */
    public function share(Request $request): array
    {
        return [
            ...parent::share($request),
            'auth' => [
                'user' => $request->user(),
                'activePlan' => $this->activePlan()
            ],
        ];
    }
}
