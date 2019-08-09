<?php
namespace App\Mail;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class RecordAddedMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Table in which record was created
     *
     * @var $table
     */
    public $table;

    /**
     * ID of the new record
     *
     * @var $id
     */
    public $id;

    /**
     * Create a new message instance.
     *
     * @param $table
     * @param $id
     * @return void
     */
    public function __construct($table, $id)
    {
        $this->table = $table;
        $this->id = $id;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.recordadded');
    }
}