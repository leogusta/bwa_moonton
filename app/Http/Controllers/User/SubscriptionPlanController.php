<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SubscriptionPlan;
use App\Models\UserSubscription;
use Carbon\Carbon;

class SubscriptionPlanController extends Controller
{
    public function index()
    {
        $subscriptionPlans = SubscriptionPlan::all();
        $userSubscription = null;

        return inertia('User/Dashboard/SubscriptionPlan/Index', compact('subscriptionPlans', 'userSubscription'));
    }

    public function userSubscribe(Request $request, SubscriptionPlan $subscriptionPlan)
    {
        $data = [
            'user_id' => auth()->user()->id,
            'subscription_plan_id' => $subscriptionPlan->id,
            'price' => $subscriptionPlan->price,
            'expired_date' => Carbon::now()->addMonths($subscriptionPlan->active_period_in_months),
            'payment_status' => 'paid'
        ];

        $userSubscription = UserSubscription::create($data);

        // $params = [
        //     'transaction_details' => [
        //         'order_id' => $userSubscription->id.'-'.Str::random(5),
        //         'gross_amount' => $userSubscription->price
        //     ]
        // ];

        // $snapToken = \Midtrans\Snap::getSnapToken($params);

        // $userSubscription->update([
        //     'snap_token' => $snapToken
        // ]);

        return redirect(route('user.dashboard.index'));
    }
}
