<?php

namespace App\Observers;

use App\Models\Application;

class ApplicationObserver
{
   public function creating(Application $application)
   {
       $application->user_id = auth()->id();
   }

    public function created(Application $application)
    {
        //
    }
    
    public function updated(Application $application)
    {
        //
    }

    public function deleted(Application $application)
    {
        //
    }

    public function restored(Application $application)
    {
        //
    }

    public function forceDeleted(Application $application)
    {
        //
    }
}
