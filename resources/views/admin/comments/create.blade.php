@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">

            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h2>
                            Yorum Ekle

                            <a href="{{ url('admin/comments') }}" class="btn btn-default pull-right">Go Back</a>
                        </h2>
                    </div>

                    <div class="panel-body">
                        <form method="POST" action="{{ url('admin/comments') }}" accept-charset="UTF-8" class="form-horizontal" role="form">
                            {{ csrf_field() }}
                            <div class="form-group{{ $errors->has('post') ? ' has-error' : '' }}">
                                <label for="post" class="col-md-2 control-label">Post Seç</label>
                                <div class="col-md-8">
                                    <select class="form-control" name="post">
                                        @foreach ($posts as $post)
                                            <option value="{{ $post->id }}">{{ $post->title }}</option>
                                        @endforeach
                                    </select>
                                    <span class="help-block">
                                        <strong>{{ $errors->first('post') }}</strong>
                                    </span>
                                </div>
                            </div>
                            <div class="form-group{{ $errors->has('text') ? ' has-error' : '' }}">
                                <label for="text" class="col-md-2 control-label">Text</label>
                                <div class="col-md-8">
                                    <textarea class="form-control" required="" autofocus="" name="text" type="text" id="text"></textarea>
                                    <span class="help-block">
                                        <strong>{{ $errors->first('text') }}</strong>
                                    </span>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-8 col-md-offset-2">
                                    <button type="submit" class="btn btn-primary">
                                        Oluştur
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
