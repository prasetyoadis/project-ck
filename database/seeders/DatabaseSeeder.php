<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Order;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        User::create([
            'name' => 'Super CeritaKita',
            'username' => 'ceritakita',
            'password' => Hash::make("admin"),
            'email' => 'ceritakita2509@gmail.com',
            'no_hp' => '85135052210',
            'gender' => 'l',
            'foto' => 'img/users/default_profile_male.png',
            'role' => 'kaadmin',
            'isactive' => '1',
            'email_verified_at' => Carbon::now(),
        ]);

        User::create([
            'name' => 'Prasetyo Adi Saputra',
            'username' => 'prasetyoadi',
            'password' => Hash::make("admin"),
            'email' => 'prasetyoadi522@gmail.com',
            'no_hp' => '89622539826',
            'gender' => 'l',
            'foto' => 'img/users/default_profile_male.png',
            'role' => 'staff',
            'isactive' => '1',
            'email_verified_at' => Carbon::now(),
        ]);
        
        User::create([
            'name' => 'Fathurrahman A.B Syuaib',
            'username' => 'fathur',
            'password' => Hash::make("admin"),
            'email' => 'fatur@gmail.com',
            'no_hp' => '85159692090',
            'gender' => 'l',
            'foto' => 'img/users/default_profile_male.png',
            'role' => 'staff',
            'isactive' => '1',
            'email_verified_at' => Carbon::now(),
        ]);
        
        User::create([
            'name' => 'Lidya Nurmala Eva',
            'username' => 'eva',
            'password' => Hash::make("admin"),
            'email' => 'eva@gmail.com',
            'no_hp' => '81228256709',
            'gender' => 'l',
            'foto' => 'img/users/default_profile_female.png',
            'role' => 'staff',
            'isactive' => '1',
            'email_verified_at' => Carbon::now(),
        ]);

        Order::create([
            'uuid' => substr(strtoupper(uniqid('CKOI')), 0,16),
            'user_id' => '2',
            'nama' => 'Herni Dwi Kristanti',
            'email' => 'herni@gamail.com',
            'no_hp' => '089554455593',
            'tgl_order' => date('Y-m-d H:i:s'),
            'status' => 'dp'
        ]);
        Order::create([
            'uuid' => substr(strtoupper(uniqid('CKOI')), 0,16),
            'user_id' => '2',
            'nama' => 'Prasetyo Adi Saputra',
            'email' => 'prasetyo@gamail.com',
            'no_hp' => '08955463635593',
            'tgl_order' => date('Y-m-d H:i:s'),
            'status' => 'dp'
        ]);
        Order::create([
            'uuid' => substr(strtoupper(uniqid('CKOI')), 0,16),
            'user_id' => '2',
            'nama' => 'Faturahman AB Syuaib',
            'email' => 'fatur@gamail.com',
            'no_hp' => '089554455593',
            'tgl_order' => date('Y-m-d H:i:s'),
            'status' => 'dp'
        ]);
        Order::create([
            'uuid' => substr(strtoupper(uniqid('CKOI')), 0,16),
            'user_id' => '2',
            'nama' => 'Lidya Nurmala Eva',
            'email' => 'Nurmala@gamail.com',
            'no_hp' => '08955433555593',
            'tgl_order' => date('Y-m-d H:i:s'),
            'status' => 'dp'
        ]);
        Order::create([
            'uuid' => substr(strtoupper(uniqid('CKOI')), 0,16),
            'user_id' => '2',
            'nama' => 'Agus Suhendar',
            'email' => 'agus@gamail.com',
            'no_hp' => '0895445456593',
            'tgl_order' => date('Y-m-d H:i:s'),
            'status' => 'dp'
        ]);
        Order::create([
            'uuid' => substr(strtoupper(uniqid('CKOI')), 0,16),
            'user_id' => '2',
            'nama' => 'Bagus Sunarto',
            'email' => 'bagus@gamail.com',
            'no_hp' => '0895413456593',
            'tgl_order' => date('Y-m-d H:i:s'),
            'status' => 'dp'
        ]);
    }
}
