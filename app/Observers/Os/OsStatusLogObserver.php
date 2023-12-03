<?php

namespace App\Observers\Os;

use App\Models\Os\Os;

class OsStatusLogObserver
{
    private $statusIdtemp;
    /**
     * Handle the Os "created" event.
     */
    public function created(Os $os): void
    {
        $os->statusLogs()->create([
            'status_id'=> $os->status_id,
            'user_id'=> $os->user_id,
        ]);
    }


    /**
     * Handle the Os "updated" event.
     */
    public function updated(Os $os): void
    {
        if ($os->getOriginal('status_id') != (int) $os->status_id) {
            $os->statusLogs()->create([
                'status_id'=> $os->status_id,
                'user_id'=> $os->user_id,
            ]);
        }
    }



    /**
     * Handle the Os "deleted" event.
     */
    public function deleted(Os $os): void
    {
        //
    }

    /**
     * Handle the Os "restored" event.
     */
    public function restored(Os $os): void
    {
        //
    }

    /**
     * Handle the Os "force deleted" event.
     */
    public function forceDeleted(Os $os): void
    {
        //
    }
}
