<?php

namespace App\Listeners;

use App\Events\NewUser;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Mail;
class SendMailAfterNewUser
{
    /**
     * Create the event listener.
     *
     * @return void
     */

    protected $user;

    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  NewUser  $event
     * @return void
     */
    public function handle(NewUser $event)
    {
        $this->user = $event->user;
        $data = array(
            'id' =>  $this->user->user_id,
        );
        Mail::send('affilate.emails.verify_user', $data, function ($message) {
            $message->to($this->user->email);
            $message->subject('Kích hoạt tài khoản Affilate');
        });
    }
}
