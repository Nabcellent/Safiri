<?php

namespace Database\Seeders;

use App\Models\PaymentMethod;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

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
        ]);
    }
}
