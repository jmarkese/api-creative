<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    use CsvSeederTrait;

    private $tableName = 'users';
    private $csvName = 'users.csv';

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
