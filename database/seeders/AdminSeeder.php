<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new User;
 
        $user->name = "Dje Bi Jean-Marc";

        $user->email = "jeanmarcdjebi@gmail.com";

        $user->password = Hash::make('admin');
 
        $user->save();
    }
}
