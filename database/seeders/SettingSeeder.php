<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        Schema::disableForeignKeyConstraints();
        Setting::truncate();
        Schema::enableForeignKeyConstraints();

        $data = [
            ['type' => 'saving_destinations', 'description' => false],
            ['type' => 'app_email', 'description' => 'safiri.@twm.com'],
            ['type' => 'app_phone', 'description' => '12345678'],
            ['type' => 'app_address', 'description' => 'Nairobi, Kenya 1st Block 1st Cross, Rammurthy nagar, Bangalore-560016'],
            ['type' => 'default_user_password', 'description' => '$afiri.'],
        ];

        Setting::insert($data);
    }
}
