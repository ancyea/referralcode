<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use App\Models\Referral;
use App\Models\Points;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Session;
use Redirect;

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
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        if($data['referralcode'] == null)
        {
            $pool = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $refercode = substr(str_shuffle(str_repeat($pool, 5)), 0, 16);
            $u = User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'newreferralcode' => $refercode,
                'password' => Hash::make($data['password']),
            ]);
           $r = Referral::create([
                'user_id' => $u->id,
                'parent_id' => 0,
                'points' => 0,
            ]); 
            return $u;
        }
       else
        { // has referral code
          
           $userid = User::where('newreferralcode', $data['referralcode'])->value('id');
            if($userid != null) // valid referral code
            {
                
                    $d = Referral::where('user_id',$userid)->first();
                    // echo "<pre>";
                    // echo $d->points;die;
                    $d->points = $d->points + 10;
                    $d->save();
                    $p_id = $d->parent_id;
                    $level = 2;
                    while($p_id > 0)
                    {
                       
                      //  echo $p_id;
                        $k = Referral::where('user_id',$p_id)->first();
                        $p_id = $k->parent_id;
                      //  echo "<pre>";
                  //  echo $k->points;
                        $l = Points::where('level',$level)->first();
                        $k->points = $k->points + $l->points;
                        $k->save();
                        $level = $level + 1;
                        if($level == 11)
                        {
                            break; 
                        }
                       
                    }
               
                        $pool = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
                        $refercode = substr(str_shuffle(str_repeat($pool, 5)), 0, 16);
                        $u = User::create([
                            'name' => $data['name'],
                            'email' => $data['email'],
                            'newreferralcode' => $refercode,
                            'password' => Hash::make($data['password']),
                        ]);
                    $r = Referral::create([
                            'user_id' => $u->id,
                            'parent_id' => $userid,
                            'points' => 0,
                        ]); 
                        return $u;
            }else{
                $pool = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
                $refercode = substr(str_shuffle(str_repeat($pool, 5)), 0, 16);
                $u = User::create([
                    'name' => $data['name'],
                    'email' => $data['email'],
                    'newreferralcode' => $refercode,
                    'password' => Hash::make($data['password']),
                ]);
            $r = Referral::create([
                    'user_id' => $u->id,
                    'parent_id' => 0,
                    'points' => 0,
                ]); 
                return $u;
            }
            
        }
        
        
    }
}
