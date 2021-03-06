<?php

namespace App\Http\Controllers\User;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Inertia\Inertia;



class FriendCtl extends Controller
{
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Inertia::render('User/Friends/Index',[
            'friends' =>auth()->user()->friends(),
            'requests' => auth()->user()->pending_friend_requests(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User $user
     * 
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, User $user)
    {
        if (!$user) {
            return back()->withErrors(['message' => '사용자를 찾을 수 없습니다']);
        }
        
        auth()->user()->add_friend($user->id);
        
        // event(new FriendRequestReceivedEvent($user));
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        // dd($user);
        if (!$user) {
            return back()->withErrors(['message' => '사용자를 찾을 수 없습니다']);
        }
        auth()->user()->accept_friend($user->id);
        
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        if (!$user) {
            return back()->withErrors(['message' => '사용자를 찾을 수 없습니다']);
        }
        auth()->user()->delete_friend($user->id);
        return back();
    
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User $user
     * @return \Illuminate\Http\Response
     */
    public function deny(User $user)
    {
        if (!$user) {
            return back()->withErrors(['message' => '사용자를 찾을 수 없습니다']);
        }
        auth()->user()->deny_friend($user->id);
        return back();
    }

   
}
