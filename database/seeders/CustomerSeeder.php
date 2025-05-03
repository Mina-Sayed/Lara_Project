<?php

namespace Database\Seeders;

use App\Models\Customer;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create a sample customer
        Customer::create([
            'name' => 'Test Customer',
            'email' => 'test@example.com',
        ]);

        // You can add more customers here if needed
        // Customer::create([...]);
    }
}
