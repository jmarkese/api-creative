<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class OrderLineItemSeeder extends Seeder
{
    use CsvSeederTrait;

    private $tableName = 'order_line_items';
    private $csvName = 'order_line_items.csv';

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
