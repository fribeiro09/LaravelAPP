<?php

namespace App\Observers;

use App\Models\WorkLog;
use Illuminate\Support\Str;

class WorkLogObserver
{
    /**
     * Handle the work log "creating" event.
     *
     * @param  \App\Models\WorkLog  $workLog
     * @return void
     */
    public function creating(WorkLog $workLog)
    {
        $workLog->uuid = Str::uuid();
    }
}
