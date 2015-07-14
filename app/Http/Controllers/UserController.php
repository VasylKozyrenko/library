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
use Illuminate\Support\Facades\Redirect;

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

    public function save()
    {
        $userId = Input::get('user_id');
        if ($userId) {
            $user = User::find($userId);
            $user->update(Input::all());
        } else {
            $user = User::create(Input::all());
        }
        if (!$user) {
            return Redirect::back()
                ->with('message', 'Something wrong happened while saving your model')
                ->withInput();
        }

        return Redirect::route('users')
            ->with('message', sprintf('User "%s" saved', $user->first_name));
    }

    public function delete()
    {
        $userId = Input::get('user_id');
        $user = User::find($userId);
        $user->delete();
        return Redirect::route('users')
            ->with('message', sprintf('User "%s" deleted', $user->first_name));
    }

    public function create()
    {
        return view('user/create');
    }

    public function edit()
    {
        $userId = Input::get('user_id');
        $user = User::find($userId);
        return view('user/edit', ['user' => $user]);
    }
}