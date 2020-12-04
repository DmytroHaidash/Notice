<?php

namespace App\Mail;

use App\Models\Advertisement;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class FavoriteAdvertisementDeleted extends Mailable
{
    use Queueable, SerializesModels;

    private $user;
    private $advertisement;

    /**
     * FavoriteAdvertisementDeleted constructor.
     * @param User $user
     * @param Advertisement $advertisement
     */
    public function __construct(User $user, Advertisement $advertisement)
    {
        $this->advertisement = $advertisement;
        $this->user = $user;
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
            ->view('mail.deleted-favorites');
    }
}
