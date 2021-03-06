@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
                @include('partials.header')
            @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif

            @forelse ($threads as $thread)
                <div class="card my-2">
                    <div class="card-header text-white" style="background-color:#00cc99;">
                        <a href="/profiles/{{$thread->owner->name  }}" class="text-dark">{{ $thread->owner['name'] }}</a>
                        <span class="float-right">said: {{ $thread->created_at->diffForHumans() }}</span>
                    </div>
                    <div class="card-body">
                        <article class="">
                            <div class="level">
                                <h4 class="flex">
                                    <a href="{{ $thread->path() }}" class="text-capitalize">{{ $thread->title }}</a>
                                </h4>
                                @if (! $thread->replies()->count() == 0)
                                    <a href="{{ $thread->path() }}">{{ $thread->replies_count }} {{ str_plural('reply',$thread->replies_count)}}</a></span>

                                @endif
                            </div>

                            <hr>
                            <div class="body"> {{$thread->body }}</div>
                        </article>
                    </div>
                </div>
              @empty
                <div class="col-md-8 offset-md-2 bg-info text-white text-center">
                  Oops!!! There is no record for this channel at the moment.
                </div>

            @endforelse

        </div>
    </div>
</div>
@endsection
