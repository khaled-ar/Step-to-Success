<?php

namespace App\Jobs;

use App\Models\Subscription;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Log;

class UpdateSubscriptionsStatus implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Log::info('starting>>>');
        try {
            Subscription::whereStatus('active')
                ->whereNotNull('expiration_date')
                ->where('expiration_date', '<=', now()->subHour())
                ->update([
                    'status' => 'inactive'
                ]);
        }catch(\Exception $e) {
            Log::error($e->getMessage());
        }
    }
}
