<?php

namespace Database\Seeders;

use App\Models\PaymentMethod;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class PaymentMethodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        Schema::disableForeignKeyConstraints();
        PaymentMethod::truncate();
        Schema::enableForeignKeyConstraints();

        PaymentMethod::insert([
            ['name' => 'mpesa', 'description' => json_encode(['icon' => 'bi bi-cash-coin'])],
            ['name' => 'paypal', 'description' => json_encode(['icon' => ""])],
            ['name' => 'cash', 'description' => json_encode(['icon' => ""])],
        ]);
    }
}
