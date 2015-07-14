@extends('master')

@section('main')

    <div class="col-md-8 col-md-offset-2 form-content">
        <h3 class="heading">Edit Book {{ $book->title }}</h3>
        @foreach($errors->all() as $error)
            <p class="alert alert-danger">{!!$error!!}</p>
        @endforeach
        {!!Form::open(['url'=>'/book/save','class'=>'form form-horizontal','style'=>'margin-top:50px'])!!}
        <div class="form-group">
            {!! Form::label('title','Title:',['class'=>'col-sm-3 control-label']) !!}
            <div class="col-sm-8">
                {!! Form::text('title',$book->title,['class'=>'form-control']) !!}
            </div>
        </div>
        <div class="form-group">
            {!! Form::label('author','Author:',['class'=>'col-sm-3 control-label']) !!}
            <div class="col-sm-8">
                {!! Form::text('author',$book->author,['class'=>'form-control']) !!}
            </div>
        </div>
        <div class="form-group">
            {!! Form::label('year','Year:',['class'=>'col-sm-3 control-label']) !!}
            <div class="col-sm-8">
                {!! Form::text('year',$book->year,['class'=>'form-control']) !!}
            </div>
        </div>
        <div class="form-group">
            {!! Form::label('genre','Genre:',['class'=>'col-sm-3 control-label']) !!}
            <div class="col-sm-8">
                {!! Form::text('genre',$book->genre,['class'=>'form-control']) !!}
            </div>
        </div>
        {!! Form::hidden('book_id',$book->id) !!}
        <div class="col-md-8 col-md-offset-3">
            {!!Form::submit('Save',['class'=>'btn btn-default'])!!}
        </div>
        {!!Form::close()!!}
    </div>

@stop