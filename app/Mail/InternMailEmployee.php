<?php



namespace App\Mail;



use Illuminate\Bus\Queueable;

use Illuminate\Contracts\Queue\ShouldQueue;

use Illuminate\Mail\Mailable;

use Illuminate\Queue\SerializesModels;



class InternMailEmployee extends Mailable

{

    use Queueable, SerializesModels;



    public $details_employee;



    /**

     * Create a new message instance.

     *

     * @return void

     */

    public function __construct($details_employee)

    {

        $this->details_employee = $details_employee;

    }



    /**

     * Build the message.

     *

     * @return $this

     */

    public function build()

    {

        return $this->subject('Internship Update')

                    ->view('email_templates.intern_mail_employee');

    }

}
