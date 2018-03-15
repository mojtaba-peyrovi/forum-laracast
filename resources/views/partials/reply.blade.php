<div class="card mb-2">
    <div class="card-body bg-light">
    <div class="card-title text-success">
            <a href="/replies/{{ $reply->owner->name }}">{{ $reply->owner->name }}</a>
        Said: {{ $reply->created_at->diffForHumans() }}
        <div class="float-right">
          <form method="POST" action="/replies/{{ $reply->id }}/favorites">
            {{ csrf_field() }}
            <button type="submit" name="button" class="btn btn-primary" {{ $reply->isFavorited() ? 'disabled':'' }}>
              {{ $reply->favorites()->count() }} {{ str_plural('Favorite',$reply->favorites()->count()) }}
            </button>
          </form>
        </div>
    </div>
    <p>{{ $reply->body }}</p>
    </div>
</div>
