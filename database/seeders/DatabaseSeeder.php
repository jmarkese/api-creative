<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // Disable FK constraints
        Schema::disableForeignKeyConstraints();

        $this->call(UserSeeder::class);
        $this->call(CreativeSeeder::class);
        $this->call(OrderLineItemSeeder::class);
        $this->call(OrderSeeder::class);
        $this->call(ProductSeeder::class);
        $this->call(ProductTypeSeeder::class);
        $this->call(ProductTypeVendorSeeder::class);
        $this->call(VendorSeeder::class);

        // Enable FK constraints
        Schema::enableForeignKeyConstraints();
    }
}
