<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Favorite;
use App\Reply;
class Reply extends Model
{
    protected $guarded = [];
    public function owner(){
        return $this->belongsTo(User::class, 'user_id');
    }
    public function favorites(){
      return $this->morphMany(Favorite::class,'favorited');
    }

    public function favorite()
     {
         $attributes = ['user_id' => auth()->id()];
         if (! $this->favorites()->where($attributes)->exists()) {
             return $this->favorites()->create($attributes);
             return redirect()->back();
         }
     }

     public function isFavorited(){
       return $this->favorites()->where('user_id', auth()->id())->exists();
     }
}
