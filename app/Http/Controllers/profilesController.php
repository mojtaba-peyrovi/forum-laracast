<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;

class profilesController extends Controller
{
    public function show(User $user){
        return view('profiles.show', [
          'profileUser' => $user,
          'threads' => $user->threads()->paginate(10)
        ]);
    }
}
