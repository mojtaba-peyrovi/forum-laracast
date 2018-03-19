@extends('layouts.app')
@section('content')
  <div class="container">
    <div class="row">
      <div class="col-md-8 offset-md-2">
        <div class="jumbotron bg-success text-center text-white">
          <h2>
          {{ $profileUser->name }}
          </h2>
          <small>Since {{ $profileUser->created_at->diffForHumans() }}</small>
        </div>
        @foreach ($threads as $thread)
            <div class="card my-2">
                <div class="card-header bg-warning">
                  <a href="{{ route('profile', $thread->owner) }}" class="font-weight-bold text-dark">{{ $thread->owner->name}}</a> :
                    <a href="{{ $thread->path() }}" class="text-white">{{ $thread->title}}</a>

                    <span class="float-right"><strong>Posted:</strong> {{ $thread->created_at->diffForHumans() }}
                    </span>
                </div>
                <div class="card-body">
                    <div class="container p-2 mb-1">
                         <div class="col-md-8 offset-md-2">
                                <blockquote class="blockquote">
                                  <p class="mb-0 lead">{{ $thread->body}}</p>
                                </blockquote>
                         </div>
                         <form class="" action="{{ $thread->path() }}" method="post">
                           {{ csrf_field() }}
                           {{ method_field('DELETE') }}
                           <button type="submit" class="btn btn-danger float-right">Delete Thread</button>
                         </form>

                     </div>
                </div>
            </div>
        @endforeach
        <div class="mt-3">
          {{ $threads->links() }}
        </div>

        </div>
      </div>

    </div>




@endsection
