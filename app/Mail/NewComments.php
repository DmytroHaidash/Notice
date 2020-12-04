<?php

namespace App\Mail;

use App\Models\Comment;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NewComments extends Mailable
{
    use Queueable, SerializesModels;

    public $comment;

    /**
     * NewComments constructor.
     * @param Comment $comment
     */
    public function __construct(Comment $comment)
    {
        $this->comment = $comment;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->to($this->comment->advertisement->user->email)
            ->subject('Новый комментарий к Вашему объявлению')
            ->view('mail.new-comment');
    }
}
