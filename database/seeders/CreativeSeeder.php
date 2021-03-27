<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CreativeSeeder extends Seeder
{
    use CsvSeederTrait;

    private $tableName = 'creatives';
    private $csvName = 'creatives.csv';

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
