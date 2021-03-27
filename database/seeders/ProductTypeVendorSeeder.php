<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ProductTypeVendorSeeder extends Seeder
{
    use CsvSeederTrait;

    private $tableName = 'product_type_vendors';
    private $csvName = 'product_type_vendors.csv';

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->csvSeed();
    }
}
