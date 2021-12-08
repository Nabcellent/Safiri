<?php

namespace Database\Seeders;

use App\Models\PaymentMethod;
use Illuminate\Database\Seeder;

class PaymentMethodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        PaymentMethod::insert([
            ['name' => 'mpesa', 'description' => json_encode(['icon' => 'bi bi-cash-coin'])],
            ['name' => 'paypal', 'description' => json_encode(['icon' => ""])],
            ['name' => 'cash', 'description' => json_encode(['icon' => ""])],
        ]);
    }
}
