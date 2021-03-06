@extends('layout')

@section('head')
    <link href="/css/comment.css" rel="stylesheet"/>
@endsection

@section('content')
    <div id="wrapper">
        <div id="page" class="container">
            <H1 class="heading has-text-weight-bold is-size-4">New Article</H1>
            <form method="post" action="/articles">
                @csrf
                <div class="field">
                    <label class="label" for="category">Category</label>
                </div>
                <select class='select control' name='category' id='category' >
                    @foreach($category as $cat)
                        <option value="{{$cat->id}}">{{$cat->name}}</option>
                    @endforeach
                </select>
                <div class="field">
                    <label class="label" for="title">Title</label>
                </div>
                <div class="control">
                    <input class="input @error('title') is-danger @enderror "
                           type="text" name="title" id="title" value="{{old('title')}}">
                    @error('title')
                        <p class="help is-danger">{{$errors->first('title')}}</p>
                    @enderror
                </div>
                <div class="field">
                    <label class="label" for="short_body">Excerpt</label>
                </div>
                <div class="control">
                    <textarea class="textarea @error('short_body') is-danger @enderror"
                              name="short_body" id="short_body">{{old('short_body')}}</textarea>
                    @error('short_body')
                        <p class="help is-danger">{{$errors->first('short_body')}}</p>
                    @enderror
                </div>
                <div class="field">
                    <label class="label" for="body">Body</label>
                </div>
                <div class="control">
                    <textarea class="textarea  @error('body') is-danger @enderror"
                              name="body" id="body">{{old('body')}}</textarea>
                    @error('body')
                        <p class="help is-danger">{{$errors->first('body')}}</p>
                    @enderror
                </div>
                <template>
                    <vue-simplemde v-model="content" ref="markdownEditor" />
                </template>

                <script>
                    import VueSimplemde from 'vue-simplemde'

                    export default {
                        components: {
                            VueSimplemde
                        }
                    }
                </script>

                <style>
                    @import '~simplemde/dist/simplemde.min.css';
                </style>
                <div class="field">
                    <label class="label" for="short_body">Tags</label>
                </div>
                <div class="select is-multiple control">
                <select name="tags[]" multiple>
                    @foreach($tags as $tag)
                        <option value="{{$tag->id}}">{{$tag->name}}</option>
                    @endforeach
                </select>
                    @error('tags')
                        <p class="help is-danger">{{message}}</p>
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
