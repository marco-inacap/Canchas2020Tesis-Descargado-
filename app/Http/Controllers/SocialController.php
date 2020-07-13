<?php
 
namespace App\Http\Controllers;
 
use Illuminate\Http\Request;
use Validator,Redirect,Response,File;
use Laravel\Socialite\Facades\Socialite;
/* use Socialite; */
use App\User;
use Spatie\Permission\Models\Role;
class SocialController extends Controller
{
public function redirect($provider)
{
    /* dd($provider); */
    return Socialite::driver($provider)->redirect();
}
 
public function callback($provider)
{
           
    $getInfo = Socialite::driver($provider)->user();
     
    $user = $this->createUser($getInfo,$provider);
 
    auth()->login($user);
 
    return redirect()->to('/');
 
}
function createUser($getInfo,$provider){
 
 $user = User::where('provider_id', $getInfo->id)->first();
 
 if (!$user) {
     $user = User::create([
        'name'     => $getInfo->name,
        'email'    => $getInfo->email,
        'provider' => $provider,
        'provider_id' => $getInfo->id
    ]);
    $user->assignRole('Cliente');
  }
  return $user;
}
}