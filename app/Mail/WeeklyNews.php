<?php

namespace App\Mail;

use App\Models\Advertisement;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\URL;

class WeeklyNews extends Mailable
{
    use Queueable, SerializesModels;

    private $user;
    public $unsubscribe_link;
    public $advertisements;

    /**
     * WeeklyNews constructor.
     * @param User $user
     */
    public function __construct(User $user, $advertisements)
    {
        $this->user = $user;
        $this->unsubscribe_link = URL::signedRoute('unsubscribe', ['user' => $this->user->id]);
        $this->advertisements = (object) $advertisements;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->to($this->user->email)
            ->subject('Новые объявления')
            ->view('mail.news');
    }
}
