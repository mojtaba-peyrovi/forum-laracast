<?php

namespace App\Http\Controllers;
use App\Filters\ThreadFilters;
use App\Thread;
use Illuminate\Http\Request;
use Auth;
use App\Channel;
class ThreadsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct(){
        $this->middleware('auth')->except(['index','show']);
    }



    public function index(Channel $channel, ThreadFilters $filters){

        if (request()->wantsJson()) {
            return $threads;
        }

        $threads = $this->getThreads($channel, $filters);

        return view('threads.index', compact('threads'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */



    public function create()
    {
        return view('threads.create');
    }

    public function store(Request $request)
    {

        $this->validate(request(),[
            'title' => 'required',
            'body' => 'required',
            'channel_id' => 'required|exists:channels,id'
        ]);
        $thread = Thread::create([
           'user_id' => Auth::user()->id,
           'channel_id' => request('channel_id'),
           'title' => request('title'),
           'body' => request('body')
        ]);
        return redirect($thread->path());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Thread  $thread
     * @return \Illuminate\Http\Response
     */
    public function show($channel,Thread $thread)
    {

        return view('threads.show',compact('thread'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Thread  $thread
     * @return \Illuminate\Http\Response
     */
    public function edit(Thread $thread)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Thread  $thread
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Thread $thread)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Thread  $thread
     * @return \Illuminate\Http\Response
     */
    public function destroy($channel, Thread $thread)
    {
      $this->authorize('update', $thread);


      $thread->delete();

      if(request()->wantsJson()) {
          return response([],204);
      }
      return redirect('/threads');

    }

    protected function getThreads(Channel $channel, ThreadFilters $filters)
    {
        $threads = Thread::latest()->filter($filters);

        if ($channel->exists) {
            $threads->where('channel_id', $channel->id);
        }

        return $threads->get();
    }


}
