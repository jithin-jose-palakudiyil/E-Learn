<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class UserAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
           if(DB::table('admin_users')->get()->count() == 0){
             $tasks =  [
                            [
                                'name'      =>  'admin',
                                'email'     =>  'admin@admin.com',
                                'status'    =>  '1',
                                'password'  =>  bcrypt('password'),
                            ],

                        ];
             
             DB::table('admin_users')->insert($tasks);
         }
    }
}
