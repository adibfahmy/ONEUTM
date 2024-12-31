<?php

namespace App\Observers;

use App\Models\Laundry;

class HistoryObserver
{
    /**
     * Handle the Laundry "created" event.
     */
    public function created(Laundry $laundry): void
    {
        //
    }

    /**
     * Handle the Laundry "updated" event.
     */
    public function updated(Laundry $laundry): void
    {
        //
    }

    /**
     * Handle the Laundry "deleted" event.
     */
    public function deleted(Laundry $laundry): void
    {
        //
    }

    /**
     * Handle the Laundry "restored" event.
     */
    public function restored(Laundry $laundry): void
    {
        //
    }

    /**
     * Handle the Laundry "force deleted" event.
     */
    public function forceDeleted(Laundry $laundry): void
    {
        //
    }
}
