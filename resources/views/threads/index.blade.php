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

            @foreach ($threads as $thread)
                <div class="card my-2">
                    <div class="card-header text-white" style="background-color:#00cc99;">
                        <span>{{ $thread->owner['name'] }}</span>
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
            @endforeach

        </div>
    </div>
</div>
@endsection
