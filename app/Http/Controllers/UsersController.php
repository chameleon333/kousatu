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
    public function index(User $user, Request $request)
    {
      if(auth()->user()){
        //ログインしている場合、自分以外のユーザー情報を取得
        $all_users = $user->getAllUsers(auth()->user()->id);
        return view('users.index', [
          'all_users' => $all_users
        ]);  
      } else {
        //ログインしていない場合、全てのユーザー情報を取得
        $all_users = $user->getAllUsers(auth()->user());
        return view('users.index', [
          'all_users' => $all_users
        ]);  
      }
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
    public function show(User $user, Article $article, Follower $follower, Request $request)
    {
      if(!isset($request["status"])) {
        $request["status"] = 0;
      }

      $timelines = $article->getUserTimeLine($user->id,$request["status"]);
      $user_info_list = $user->getUserInfoList();
      $user_info_list["timelines"] = $timelines;
      $user_info_list["article_status_list"] = ['公開中','下書き'];
      $user_info_list["request_status_id"] = $request["status"];

      return view('users.show', $user_info_list);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
      return view('users.edit', ['user'=>$user]);
    }
  
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
      $user = auth()->user();
      $data = $request->all();
      $validator = Validator::make($data, [
        #0-9,英数字,記号の_のみだけ登録できるよう設定
        'screen_name' => ['required', 'regex:/^(\w)+$/', 'max:50', Rule::unique('users')->ignore($user->id)],
        'name' => ['required', 'string', 'max:255'],
        'profile_image' => ['file', 'image', 'mimes:jpeg,png,jpg', 'max:2048'],
        'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($user->id)]
      ]);
      $validator->validate();
      $user->updateProfile($data);
      
      return redirect('users/'.$user->id);
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
      $is_following = $follower->isFollowing($user->id);
      if(!$is_following) {
        // フォローしていなければフォローする
        $follower->follow($user->id);
        return back();
      }
    }
  
    public function unfollow(User $user)
    {
      $follower = auth()->user();
      // フォローしているか
      $is_following = $follower->isFollowing($user->id);
      if($is_following) {
        // フォローしていればフォローを解除する
        $follower->unfollow($user->id);
        return back();
      }
    }
    
    public function following(User $user)
    {
      $following_users = $user->getFollowingUsers($user->id);
      $user_info_list = $user->getUserInfoList();
      $user_info_list["all_users"] = $following_users;
      return view('users.follow', $user_info_list);
    }

    public function followers(User $user) 
    {
      $followers = $user->getFollowers($user->id);
      $user_info_list = $user->getUserInfoList();
      $user_info_list["all_users"] = $followers;
      return view('users.follow', $user_info_list);

    }

    public function favorite(User $user, Article $article) 
    {
      $timelines = $article->getFavoriteArticles($user->id);
      $user_info_list = $user->getUserInfoList();
      $user_info_list["timelines"] = $timelines;
      return view('users.favorite', $user_info_list);
    }

    public function favorited(User $user, Article $article) 
    {
      $timelines = $article->getFavoritedArticles($user->id);
      $tab_info_list = $user->getTabInfoList($follower);
      $follow_count = $follower->getFollowCount($user->id);
      $follower_count = $follower->getFollowerCount($user->id);

      return view('users.show', [
        'user' => $user,
        'timelines' => $timelines,
        'follow_count' => $follow_count,
        'follower_count' => $follower_count,
        'tab_info_list' => $tab_info_list,
        ]);
    }


}
