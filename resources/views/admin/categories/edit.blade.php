@extends('layout')

@section('head')
    <link href="/css/comment.css" rel="stylesheet"/>
@endsection

@section('content')
    <div id="wrapper">
        <div id="page" class="container">
            <H1 class="heading has-text-weight-bold is-size-4">Update category</H1>
            <form method="post" action="/acategory/{{$category->id}}/edit">
                @csrf
                @method('PUT')
                <div class="field">
                    <label class="label" for="title">Name</label>
                </div>
                <div class="control">
                    <input class="input @error('name') is-danger @enderror" type="text" name="name" id="name" value="{{$category->name}}">
                    @error('name')
                    <p class="help is-danger">{{$errors->first('title')}}</p>
                    @enderror
                </div>
                <div class="field is-grouped">
                    <div class="control">
                        <button class="button is-link" type="submit">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
