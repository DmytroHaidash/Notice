<?php

namespace App\Mail;

use App\Models\Advertisement;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AdminsDeletedAdvertisement extends Mailable
{
    use Queueable, SerializesModels;

    public $advertisement;

    /**
     * AdminsDeletedAdvertisement constructor.
     * @param Advertisement $advertisement
     */
    public function __construct(Advertisement $advertisement)
    {
        $this->advertisement = $advertisement;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->to($this->advertisement->user->email)
            ->subject('Ваше объявление удалено администратором')
            ->view('mail.admins-deleted');
    }
}
