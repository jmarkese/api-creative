<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class VendorSeeder extends Seeder
{
    use CsvSeederTrait;

    private $tableName = 'vendors';
    private $csvName = 'vendors.csv';

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
