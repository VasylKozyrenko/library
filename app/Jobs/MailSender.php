<?php

namespace App\Jobs;

use App\User;
use App\Book;
use Illuminate\Mail\Message;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Bus\SelfHandling;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Contracts\Mail\Mailer;

class MailSender extends Job implements SelfHandling, ShouldQueue
{
    use InteractsWithQueue, SerializesModels;

    /**
     * @var User
     */
    protected $user;

    /**
     * @var Book
     */
    protected $book;

    /**
     * @var string
     */
    protected $subject;

    /**
     * @var string
     */
    protected $template;

    /**
     * @var string
     */
    protected $referenceUrl;

    /**
     * Create a new job instance.
     *
     * @param User $user
     * @param Book $book
     * @param string $subject
     * @param string $template
     * @param string $referen
     * @return self
     */
    public function __construct(User $user, Book $book, $subject, $template, $referenceUrl)
    {
        $this->user = $user;
        $this->book = $book;
        $this->subject = $subject;
        $this->template = $template;
        $this->referenceUrl = $referenceUrl;
    }

    /**
     * Execute the job.
     *
     * @param Mailer $mailer
     * @return void
     */
    public function handle(Mailer $mailer)
    {
        $mailer->send(
            $this->template,
            [
                'user' => $this->user,
                'book' => $this->book,
                'url' => $this->referenceUrl
            ],
            function (Message $message) {
                $message->to($this->user->email, $this->user->first_name)
                    ->subject($this->subject);
            }
        );
    }
}
