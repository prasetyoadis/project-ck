<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Order;
use App\Models\User;
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
            'name' => 'Prasetyo Adi Saputra',
            'username' => 'prasetyoadi',
            'password' => Hash::make("admin"),
            'role' => 'staff',
            'isadmin' => '1',
        ]);

        Order::create([
            'uuid' => substr(strtoupper(uniqid('CKOI')), 0,16),
            'user_id' => '1',
            'nama' => 'Herni Dwi Kristanti',
            'email' => 'herni@gamail.com',
            'no_hp' => '089554455593',
            'tgl_order' => date('Y-m-d H:i:s'),
            'status' => 'dp'
        ]);
        Order::create([
            'uuid' => substr(strtoupper(uniqid('CKOI')), 0,16),
            'user_id' => '1',
            'nama' => 'Prasetyo Adi Saputra',
            'email' => 'prasetyo@gamail.com',
            'no_hp' => '08955463635593',
            'tgl_order' => date('Y-m-d H:i:s'),
            'status' => 'dp'
        ]);
        Order::create([
            'uuid' => substr(strtoupper(uniqid('CKOI')), 0,16),
            'user_id' => '1',
            'nama' => 'Faturahman AB Syuaib',
            'email' => 'fatur@gamail.com',
            'no_hp' => '089554455593',
            'tgl_order' => date('Y-m-d H:i:s'),
            'status' => 'dp'
        ]);
        Order::create([
            'uuid' => substr(strtoupper(uniqid('CKOI')), 0,16),
            'user_id' => '1',
            'nama' => 'Lidya Nurmala Eva',
            'email' => 'Nurmala@gamail.com',
            'no_hp' => '08955433555593',
            'tgl_order' => date('Y-m-d H:i:s'),
            'status' => 'dp'
        ]);
        Order::create([
            'uuid' => substr(strtoupper(uniqid('CKOI')), 0,16),
            'user_id' => '1',
            'nama' => 'Agus Suhendar',
            'email' => 'agus@gamail.com',
            'no_hp' => '0895445456593',
            'tgl_order' => date('Y-m-d H:i:s'),
            'status' => 'dp'
        ]);
        Order::create([
            'uuid' => substr(strtoupper(uniqid('CKOI')), 0,16),
            'user_id' => '1',
            'nama' => 'Bagus Sunarto',
            'email' => 'bagus@gamail.com',
            'no_hp' => '0895413456593',
            'tgl_order' => date('Y-m-d H:i:s'),
            'status' => 'dp'
        ]);
    }
}
