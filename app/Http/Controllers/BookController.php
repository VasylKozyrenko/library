<?php

namespace App\Http\Controllers;

use App\Book;
use App\Jobs\MailSender;
use App\User;
use App\Http\Requests\StoreBookPostRequest;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;

class BookController extends Controller
{
    /**
     * Ensuring authorization
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    protected function notifyUsers(Book $book)
    {
        $users = User::all();
        $url = route('books');
        foreach ($users as $user) {
            $this->dispatch(
                new MailSender(
                    $user,
                    $book,
                    'A new book is appeared!',
                    'emails.new_book',
                    $url
                )
            );
        }
    }

    /**
     * @param StoreBookPostRequest $request
     * @return mixed
     */
    public function save(StoreBookPostRequest $request)
    {
        $bookId = Input::get('book_id');
        if ($bookId) {
            $book = Book::find($bookId);
            $book->update(Input::all());
        } else {
            $book = Book::create(Input::all());
            $this->notifyUsers($book);
        }
        if (!$book) {
            return Redirect::back()
                ->with('message', 'Something wrong happened while saving your model')
                ->withInput();
        }
        return Redirect::route('books')
            ->with('message', sprintf('Book "%s" saved', $book->title));
    }

    /**
     * @return mixed
     */
    public function delete()
    {
        $bookId = Input::get('book_id');
        $book = Book::find($bookId);
        $book->delete();
        return Redirect::route('books')
            ->with('message', sprintf('Book "%s" deleted', $book->title));
    }

    /**
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('book/create');
    }

    /**
     * @return \Illuminate\View\View
     */
    public function edit()
    {
        $bookId = Input::get('book_id');
        $book = Book::find($bookId);
        return view('book/edit', ['book' => $book]);
    }

    /**
     * @return \Illuminate\View\View
     */
    public function getList()
    {
        $currentUser = \Auth::user();
        $userBooks = $currentUser->books;
        $freeBooks = Book::whereNull('user_id')->paginate(10);
        return view('books', ['userBooks' => $userBooks, 'freeBooks' => $freeBooks]);
    }
}