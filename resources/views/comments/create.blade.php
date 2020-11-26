<hr>
    <div id="comment">
        <div id="page" class="container">
            <H1 class="heading has-text-weight-bold is-size-3">Add your comment</H1>
            <form id="contactform" method="POST" class="validateform">
                {{ csrf_field() }}
                <div id="sendmessage">
                    Ваш комментарий успешно отправлен.
                </div>
                <div id="senderror">
                    При отправки комментария произошла ошибка.
                </div>
                <div class="field">
                    <label class="label" for="Subject">Subject</label>
                </div>
                <div class="control">
                    <input class="input @error('subject') is-danger @enderror "
                           type="text" name="subject" id="subject" value="{{old('subject')}}">
                    @error('subject')
                        <p class="help is-danger">{{$errors->first('subject')}}</p>
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
                <div class="field is-grouped">
                    <div class="control">
                        <button class="button is-link"  type="submit">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
<hr>
