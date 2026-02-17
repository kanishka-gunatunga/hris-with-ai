<?php



namespace App\Mail;



use Illuminate\Bus\Queueable;

use Illuminate\Contracts\Queue\ShouldQueue;

use Illuminate\Mail\Mailable;

use Illuminate\Queue\SerializesModels;



class InternMailSupervisor extends Mailable

{

    use Queueable, SerializesModels;



    public $details_supervisor;



    /**

     * Create a new message instance.

     *

     * @return void

     */

    public function __construct($details_supervisor)

    {

        $this->details_supervisor = $details_supervisor;

    }



    /**

     * Build the message.

     *

     * @return $this

     */

    public function build()

    {

        return $this->subject('Internship Update')

                    ->view('email_templates.intern_mail_supervisor');

    }

}
