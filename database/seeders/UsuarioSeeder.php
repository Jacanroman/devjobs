<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsuarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name'=> 'Javi',
            'email'=>'javier@javier.com',
            'email_verified_at'=>Carbon::now(),
            'password'=>Hash::make('12345678'),
            'created_at'=> Carbon::now(),
            'updated_at'=> Carbon::now(),
        ]);
        DB::table('users')->insert([
            'name'=> 'Stamatia',
            'email'=>'stamatia@javier.com',
            'email_verified_at'=>Carbon::now(),
            'password'=>Hash::make('12345678'),
            'created_at'=> Carbon::now(),
            'updated_at'=> Carbon::now(),
        ]);
    }
}
