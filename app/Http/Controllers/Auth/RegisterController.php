<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
//use App\User;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/articles';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'screen_name' => ['required', 'regex:/^(\w)+$/', 'max:50', 'unique:users'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {

        #base64でエンコードされた画像データを画像ファイルとして保存する
        $img = $data["binary_image"];
        if(!isset($img)) {
            $image_path = "/images/profile_image/etc.png";
        } else {
            $fileData = base64_decode($img);
            $fileName = '/tmp/profile_image.png';
            file_put_contents($fileName, $fileData);
    
            $image = Storage::disk('s3')->putFile('/profile_images', $fileName, 'public');
            $image_path = Storage::disk('s3')->url($image);
        }


        return User::create([
            'screen_name' => $data['screen_name'],
            'name' => "",
            'email' => $data['email'],
            'profile_image' => $image_path,
            'password' => Hash::make($data['password']),
        ]);
    }
}
