<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use App\Models\User;
use App\Models\Article;
use App\Models\Follower;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(User $user)
    {
      $all_users = $user->getAllUsers(auth()->user()->id);
//      \Debugbar::addMessage(auth()->user());
      return view('users.index', [
        'all_users' => $all_users
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
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
  
    public function follow(User $user)
    {
      $follower = auth()->user();
      // フォローしているか
      $is_following = $follower->isFollowing($user->user_id);
      if(!$is_following) {
        // フォローしていなければフォローする
        $follower->follow($user->user_id);
        return back();
      }
    }
  
    public function unfollow(User $user)
    {
      $follower = auth()->user();
      // フォローしているか
      $is_following = $follower->isFollowing($user->user_id);
      if($is_following) {
        // フォローしていればフォローを解除する
        $follower->unfollow($user->id);
        return back();
      }
    }
}
