@extends('master')

@section('main')

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <a class="btn btn-default" href="{{ URL::route('create_book') }}">Create New Book</a>
            </div>
        </div>
        <h3>Your books:</h3>
        <div class="row">
            <div class="col-md-12">
                @foreach($userBooks as $userBook)
                    <p>
                        {{ $userBook->title }}
                        <a href="{{ URL::route('return', ['book_id' => $userBook->id]) }}">Return</a>
                        <a href="{{ URL::route('edit_book', ['book_id' => $userBook->id]) }}">Edit</a>
                        <a href="{{ URL::route('delete_book', ['book_id' => $userBook->id]) }}">Delete</a>
                    <p>
                @endforeach
            </div>
        </div>
        <h3>Free books:</h3>
        <div class="row">
            <div class="col-md-12">
                @foreach($freeBooks as $freeBook)
                    <p>
                        {{ $freeBook->title }}
                        <a href="{{ URL::route('take', ['book_id' => $freeBook->id]) }}">Take</a>
                        <a href="{{ URL::route('edit_book', ['book_id' => $freeBook->id]) }}">Edit</a>
                        <a href="{{ URL::route('delete_book', ['book_id' => $freeBook->id]) }}">Delete</a>
                    <p>
                @endforeach
            </div>
        </div>
        {!! $freeBooks->render() !!}
    </div>

@stop