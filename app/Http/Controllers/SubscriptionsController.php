<?php

namespace App\Http\Controllers;

use App\Http\Requests\Subscriptions\SubscribeRequest;
use App\Models\Subscription;
use Illuminate\Http\Request;
use App\Traits\Files;

class SubscriptionsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $status = request('status') ?? 'pending';
        $subscriptions = Subscription::whereStatus($status)
            ->whereNotNull('transfer_image')
            ->with(['user', 'course'])
            ->get();
        return $this->generalResponse($subscriptions);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SubscribeRequest $request)
    {
        return $request->store();
    }

    public function store_transfer_image(Request $request, Subscription $subscription) {
        if($subscription->status == 'active') {
            return $this->generalResponse(null, 'Subscription cannot be confirmed because the subscription is currently active.', 400);
        }
        $image = $request->validate(['transfer_image' => ['required', 'image', 'mimes:png,jpg', 'max:2048']]);
        Files::deleteFile(public_path("Images/Payments/{$subscription->transfer_image}"));
        $image = Files::moveFile($image['transfer_image'], 'Images/Payments');
        $subscription->update(['transfer_image' => $image, 'status' => 'pending']);
        return $this->generalResponse(null, 'The request has been sent to the manager successfully. Please wait for the result.', 200);
    }

    public function get_subscriptions() {
        return $this->generalResponse(request()->user()->subscriptions);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $status = $request->validate(['status' => 'required', 'string', 'in:active,inactive']);
        if($request->status == 'active') {
            $status['expiration_date'] = now()->addYear();
        }
        Subscription::whereId($id)->update($status);
        return $this->generalResponse(null, 'Updated Successfully', 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Subscription $subscription)
    {
        if($subscription->status == 'active') {
            return $this->generalResponse(null, 'The subscription cannot be deleted because it is currently active.', 400);
        }
        if($subscription->status == 'pending') {
            return $this->generalResponse(null, 'The subscription cannot be deleted because it is under review by the administrator.', 400);
        }

        Files::deleteFile(public_path("Images/Payments/{$subscription->transfer_image}"));
        $subscription->delete();
        return $this->generalResponse(null, 'Deleted Successfully', 200);
    }
}
