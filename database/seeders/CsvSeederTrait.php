<?php


namespace Database\Seeders;


use Illuminate\Support\Facades\DB;

trait CsvSeederTrait
{
    private function csvSeed()
    {
        $csv = fopen(__DIR__."/data/$this->csvName", 'r');
        $header = null;
        while (($row = fgetcsv($csv, 0, ',')) != false) {
            if (is_null($header)) {
                $header = $row;
                continue;
            }
            $insert = array_combine($header, $row);
            unset($insert['id']);
            $insert = array_map(function($item){
                if ($item === "") {
                    return null;
                }
                return $item;
            },$insert);
            DB::table($this->tableName)->insert(
                $insert
            );
        }
    }
}
