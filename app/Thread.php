<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Reply;
use App\User;
use App\Channel;
class Thread extends Model
{
    protected $guarded = [];

    protected $with = ['owner','channel'];

    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope('replyCount', function($builder){
            $builder->withCount('replies');
        });

        static::deleting(function($thread){
          $thread->replies()->delete();
        });

    }

    public function path() {
        return "/threads/{$this->channel->slug}/{$this->id}";
    }

    public function replies(){
        return $this->hasMany(Reply::class);

    }



    public function owner(){
        return $this->belongsTo(User::class,'user_id');
    }

    public function addReply($reply){
        $this->replies()->create($reply);
    }

    public function channel(){
        return $this->belongsTo(Channel::class);
    }

    public function scopeFilter($query, $filters){
        return $filters->apply($query);
    }


}
