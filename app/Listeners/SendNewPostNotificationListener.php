<?php

namespace App\Listeners;

use App\Events\NewPostEvent;
use App\Mail\NewPostNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendNewPostNotificationListener
{
    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(NewPostEvent $event)
    {
        Mail::to($event->post->user->email)->send(new NewPostNotification($event->post));
    }
}
