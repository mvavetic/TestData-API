<?php
namespace App\Listeners;
use App\Events\RecordAdded;
use App\Mail\RecordAddedMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendRecordAddedMail
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }
    /**
     * Handle the event.
     *
     * @param  RecordAdded  $event
     * @return void
     */
    public function handle(RecordAdded $event)
    {
        Mail::to("matija.vavetic@gmail.com")->send(
            new RecordAddedMail($event->table, $event->id));
    }
}