<?php

namespace App\Http\Controllers;

class DashBoardController extends Controller
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
    public function index()
    {
        return view('dashboard');
    }
}