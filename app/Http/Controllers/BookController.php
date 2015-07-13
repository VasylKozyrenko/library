<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Vasyl
 * Date: 12.07.15
 * Time: 20:41
 * To change this template use File | Settings | File Templates.
 */
namespace App\Http\Controllers;

use App\Book;
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

    public function save()
    {
        $bookId = Input::get('book_id');
        if ($bookId) {
            $book = Book::find($bookId);
            $book->update(Input::all());
        } else {
            $book = Book::create(Input::all());
        }
        if (!$book) {
            return Redirect::back()
                ->with('message', 'Something wrong happened while saving your model')
                ->withInput();
        }

        return Redirect::route('books')
            ->with('message', sprintf('Book "%s" saved', $book->title));
    }

    public function delete()
    {
        $bookId = Input::get('book_id');
        $book = Book::find($bookId);
        $book->delete();
        return Redirect::route('books')
            ->with('message', sprintf('Book "%s" deleted', $book->title));
    }

    public function create()
    {
        return view('book/create');
    }

    public function edit()
    {
        $bookId = Input::get('book_id');
        $book = Book::find($bookId);
        return view('book/edit', ['book' => $book]);
    }

    public function getList()
    {
        $currentUser = \Auth::user();
        $userBooks = $currentUser->books;
        $freeBooks = Book::whereNull('user_id')->paginate(10);
        return view('books', ['userBooks' => $userBooks, 'freeBooks' => $freeBooks]);
    }
}