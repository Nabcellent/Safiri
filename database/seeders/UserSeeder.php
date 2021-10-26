<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;

class UserSeeder extends Seeder {
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        Schema::disableForeignKeyConstraints();
        User::truncate();
        Schema::enableForeignKeyConstraints();

        User::create([
            "first_name"              => "Re.d",
            "last_name"              => "_Beard",
            "phone"             => 110039317,
            "is_admin"         => 7,
            "email"             => 'nabcellent.dev@gmail.com',
            "password"          => Hash::make("M1gu3l.!"),
            "email_verified_at" => now(),
        ]);
    }
}
