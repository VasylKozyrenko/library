<?php

namespace App\Console\Commands;

use App\Book;
use App\Jobs\MailSender;
use App\User;
use Illuminate\Console\Command;
use Illuminate\Foundation\Bus\DispatchesJobs;

class Remind extends Command
{
    use DispatchesJobs;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'remind';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Remind user to return a book';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $books = Book::whereRaw('taken < curdate() - interval 30 day')->get();
        foreach ($books as $book) {
            $url = route('books');
            $user = User::find($book->user_id);
            $this->dispatch(
                new MailSender(
                    $user,
                    $book,
                    'Did you forget to return a book to library?',
                    'emails.reminder',
                    $url
                )
            );
        }
    }
}
