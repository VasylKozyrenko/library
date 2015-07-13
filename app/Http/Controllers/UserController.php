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
use App\User;
use Illuminate\Support\Facades\Input;

class UserController extends Controller
{
    /**
     * Ensuring authorization
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function getList()
    {
        $users = User::paginate(10);

        return view('users', ['users' => $users]);
    }

    public function takeBook()
    {
        $bookId = Input::get('book_id');
        $book = Book::find($bookId);
        $book->user_id = \Auth::user()->id;
        $book->save();
        return redirect('books');
    }

    public function returnBook()
    {
        $bookId = Input::get('book_id');
        $book = Book::find($bookId);
        $book->user_id = null;
        $book->save();
        return redirect('books');
    }
}