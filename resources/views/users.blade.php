<!-- -->
@extends('master')

@section('main')

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                @foreach($users as $user)
                    <p>{{ $user->first_name }}<p>
                @endforeach
            </div>
        </div>
    </div>
    {!! $users->render() !!}
@stop