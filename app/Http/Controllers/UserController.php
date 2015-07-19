<?php

namespace App\Http\Controllers;

use App\Book;
use App\User;
use App\Http\Requests\StoreUserPostRequest;
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

    /**
     * @return \Illuminate\View\View
     */
    public function getList()
    {
        $users = User::paginate(10);

        return view('users', ['users' => $users]);
    }

    /**
     * @return Redirect
     */
    public function takeBook()
    {
        $bookId = Input::get('book_id');
        $book = Book::find($bookId);
        $book->user_id = \Auth::user()->id;
        $book->taken = date("Y-m-d H:i:s");
        $book->save();
        return redirect('books');
    }

    /**
     * @return Redirect
     */
    public function returnBook()
    {
        $bookId = Input::get('book_id');
        $book = Book::find($bookId);
        $book->user_id = null;
        $book->taken = null;
        $book->save();
        return redirect('books');
    }

    /**
     * @param StoreUserPostRequest $request
     * @return mixed
     */
    public function save(StoreUserPostRequest $request)
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

    /**
     * @return mixed
     */
    public function delete()
    {
        $userId = Input::get('user_id');
        $user = User::find($userId);
        $user->delete();
        return Redirect::route('users')
            ->with('message', sprintf('User "%s" deleted', $user->first_name));
    }

    /**
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('user/create');
    }

    /**
     * @return \Illuminate\View\View
     */
    public function edit()
    {
        $userId = Input::get('user_id');
        $user = User::find($userId);
        return view('user/edit', ['user' => $user]);
    }
}