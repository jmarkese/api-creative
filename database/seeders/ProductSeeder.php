<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    use CsvSeederTrait;

    private $tableName = 'products';
    private $csvName = 'products.csv';

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
