<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

trait Favoritable
{
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
     return !! $this->favorites->where('user_id', auth()->id())->count();
   }
}
