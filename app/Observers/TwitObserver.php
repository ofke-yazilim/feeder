<?php

namespace App\Observers;

use App\Models\Twit;
use App\Services\FeederService;

class TwitObserver
{
    /**
     * Handle the Twit "created" event.
     */
    public function created(Twit $twit): void
    {
        //
    }

    /**
     * Handle the Twit "updated" event.
     */
    public function updated(Twit $twit): void
    {
        //
        // Sisteme son 20 twit yükleniyor.
        $feeder_service = new FeederService();
        $feeder_service->update($twit->id,$twit->twitter_text);
    }

    /**
     * Handle the Twit "deleted" event.
     */
    public function deleted(Twit $twit): void
    {
        //
    }

    /**
     * Handle the Twit "restored" event.
     */
    public function restored(Twit $twit): void
    {
        //
    }

    /**
     * Handle the Twit "force deleted" event.
     */
    public function forceDeleted(Twit $twit): void
    {
        //
    }
}
