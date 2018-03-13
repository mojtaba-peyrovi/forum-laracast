@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-info text-white">Create a New Thread</div>

                <div class="card-body bg-light">
                    <form action="/threads" method="post">
                        {{ csrf_field() }}
                        <div class="row">
                            <div class="col-md-4 order-md-2">
                                <div class="form-group">
                                    <label for="channel_id">Choose a Channel: </label>
                                    <select class="form-control" name="channel_id" id="channel_id">
                                        <option value="">--- Choose one ---</option>
                                        @foreach ($channels as $channel)

                                            <option value="{{ $channel->id }}" {{old('channel_id') == $channel->id ?  'selected': ''}}>{{ $channel->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label for="title">Post Title: </label>
                                    <input type="text" name="title" value="{{ old('title') }}" class="form-control" required>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="body">Post Body: </label>
                            <textarea name="body" class="form-control" rows="6" required>{{ old('body') }}</textarea>
                        </div>
                        <div class="form-group">
                            <button type="submit" name="button" class="btn btn-secondary float-right px-5 text-white">Post</button>
                        </div>
                    </form>
                </div>
            </div>
            @include('partials.error')
        </div>
    </div>
</div>
@endsection
