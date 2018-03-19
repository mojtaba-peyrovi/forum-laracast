@extends('layouts.app')

@section('content')

    <div class="row">
        <div class="col-md-7 offset-md-1">
            <div class="card">
                <div class="card-header bg-warning">
                    {{ $thread->title}}
                    <span class="float-right">
                      <strong>Posted:</strong> {{ $thread->created_at->diffForHumans() }}
                        @can ('update', $thread)
                          <form method="post" action="{{ $thread->path() }}" class="float-right ml-3">
                            {{ csrf_field() }}
                            {{ method_field('DELETE')}}
                            <button type="submit" class="btn btn-link btn-sm bg-danger text-white">Delete</button>
                          </form>
                        @endcan
                    </span>
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    <div class="container p-2 mb-3">
                         <div class="col-md-8 offset-md-2">
                                <blockquote class="blockquote">
                                  <p class="mb-0 lead">{{ $thread->body }}</p>
                                  <footer class="blockquote-footer float-right"> {{ $thread->owner->name }}</footer>
                                </blockquote>
                         </div>
                     </div>

                    @php
                    $replies = $thread->replies()->paginate(20);
                    @endphp

                    @foreach ($replies as $reply)
                        @include('partials.reply')
                    @endforeach

                    {{ $replies->links() }}
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card">
                <div class="card-body" id="show-meta-data">
                    This thread was published at:<br> {{ $thread->created_at->toDateString()}}<br>
                    by <a href="#"> {{ $thread->owner->name }}</a> <br>
                    and currently has {{ !$thread->replies_count == 0 ? $thread->replies_count:''}}

                    @if ($thread->replies_count == 0)
                        no comments
                    @elseif ($thread->replies_count == 1)
                        comment
                    @else
                        comments
                    @endif

                </div>
            </div>
        </div>
    </div>
    @if (auth()->check())
        <div class="row">
            <div class="col-md-7 offset-md-1">
                <div class="card my-3">
                    <div class="card-body bg-light my-2">
                        <form method="post" action="{{ $thread->path() . '/replies' }}">
                            {{ csrf_field() }}
                        <textarea name="body" class="form-control" placeholder="Reply your visitors here..." rows="5"></textarea>
                        <button type="submit" name="button" class="btn btn-success mt-2 px-5 float-right">Post</button>
                    </div>
                </div>
            </div>
        </div>
    @else

            <p class="text-center my-3">Please <a href="{{ route('login') }}">Sign In</a> to participate in this discussion, or register <a href="{{ route('register') }}"> here</a></p>


    @endif




@endsection
