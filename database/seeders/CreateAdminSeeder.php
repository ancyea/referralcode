<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Referral;


class CreateAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    { 
        $user = [
            
               'name'=>'Admin User',
               'email'=>'ancyeaji@gmail.com',
               'type'=>1, //1= admin 0= user
               'newreferralcode'=>"",
               'password'=> bcrypt('ancyancy'),
        ];        
    
       
            $u = User::create($user);
            $referral = [
                'user_id'=> $u->id,
                'parent_id'=> 0,
                'points' => 0,
            ];
            Referral::create($referral);
      }
}
