@extends('layout')

@section('head')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.7.5/css/bulma.css" rel="stylesheet"/>
@endsection

@section('content')
    <div id="wrapper">
        <div id="page" class="container">
            <H1 class="heading has-text-weight-bold is-size-4">Update article</H1>
            <form method="post" action="/articles/{{$article->id}}">
                @csrf
                @method('PUT')
                <div class="field">
                    <label class="label" for="title">Title</label>
                </div>
                <div class="control">
                    <input class="input @error('title') is-danger @enderror" type="text" name="title" id="title" value="{{$article->title}}">
                    @error('title')
                    <p class="help is-danger">{{$errors->first('title')}}</p>
                    @enderror
                </div>
                <div class="field">
                    <label class="label" for="short_body">Excerpt</label>
                </div>
                <div class="control">
                    <textarea class="textarea @error('short_body') is-danger @enderror" name="short_body" id="short_body">{{$article->short_body}}</textarea>
                    @error('short_body')
                    <p class="help is-danger">{{$errors->first('short_body')}}</p>
                    @enderror
                </div>
                <div class="field">
                    <label class="label" for="body">Body</label>
                </div>
                <div class="control">
                    <textarea class="textarea @error('body') is-danger @enderror" name="body" id="body">{{$article->body}}</textarea>
                    @error('body')
                    <p class="help is-danger">{{$errors->first('body')}}</p>
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
