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

class MailSenderTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var User | \PHPUnit_Framework_MockObject_MockObject
     */
    protected $userMock;

    /**
     * @var Book | \PHPUnit_Framework_MockObject_MockObject
     */
    protected $bookMock;

    /**
     * @var Mailer | \PHPUnit_Framework_MockObject_MockObject
     */
    protected $mailerMock;

    /**
     * @var MailSender
     */
    protected $mailSender;

    public function setUp()
    {
        $this->userMock = $this->getMock('App\User', [], [], '', false);
        $this->bookMock = $this->getMock('App\Book', [], [], '', false);
        $this->mailerMock = $this->getMock('Illuminate\Contracts\Mail\Mailer', [], [], '', false);
    }

    /**
     * @dataProvider handleProvider
     * @param string $subject
     * @param string $template
     * @param string $url
     */
    public function testHandle($subject, $template, $url)
    {
        $callback = function (Message $message) use ($subject) {
            $message->to($this->userMock->email, $this->userMock->first_name)
                ->subject($subject);
        };
        $this->mailerMock->expects($this->once())
            ->method('send')
            ->with(
                $template,
                [
                    'user' => $this->userMock,
                    'book' => $this->bookMock,
                    'url' => $url
                ],
                $callback
            );
        $mailSender = new MailSender($this->userMock, $this->bookMock, $subject, $template, $url);
        $mailSender->handle($this->mailerMock);
    }

    public function handleProvider()
    {
        return [
            ['Subject', 'template', 'url'],
        ];
    }
}
