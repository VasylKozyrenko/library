@extends('master')

@section('main')

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <a class="btn btn-default" href="{{ URL::route('create_user') }}">Create New User</a>
            </div>
        </div>
        <h3>Users:</h3>
        <div class="row">
            <div class="col-md-12">
                @foreach($users as $user)
                    <p>
                        {{ $user->first_name }}
                        <a href="{{ URL::route('edit_user', ['user_id' => $user->id]) }}">Edit</a>
                        <a href="{{ URL::route('delete_user', ['user_id' => $user->id]) }}">Delete</a>
                    <p>
                @endforeach
            </div>
        </div>
        {!! $users->render() !!}
    </div>

@stop