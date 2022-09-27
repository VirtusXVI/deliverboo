<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\User;

use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

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
    protected $redirectTo = RouteServiceProvider::HOME;

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
            'restaurant_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'address' => ['required','string'],
            'p_iva' => ['required','max:11'],
            'restaurant_image' => ['nullable','file','mimes:jpeg,jpg,bmp,png']
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
        if (!empty($data['restaurant_image'])) {
            $restaurant_image = Storage::put('restaurant_image', $data['restaurant_image']);
            $data['restaurant_image'] = $restaurant_image;
        }
        return User::create([
            'password' => Hash::make($data['password']),
            'email' => $data['email'],
            'restaurant_name' => $data['restaurant_name'],
            'address' => $data['address'],
            'p_iva' => $data['p_iva'],
            'slug' => $this->slugControls($data['restaurant_name']),
            // 'restaurant_image' => Storage::put('restaurant_image', $data['restaurant_image'], 'public'),
            'restaurant_image' => isset($data['restaurant_image']) ? $data['restaurant_image'] : null,
        ]);
    }

    protected function slugControls($title){
        $slug_to_save = Str::slug($title, '-');
        $slug_base = $slug_to_save;
        $existing_slug_post = User::where('slug','=', $slug_to_save)->first();
        $i = 1;
        while($existing_slug_post){
            $slug_to_save = $slug_base . '-' . $i;

            $existing_slug_post = User::where('slug', '=', $slug_to_save)->first();

            $i++;
        }
        return $slug_to_save;
    }
}
