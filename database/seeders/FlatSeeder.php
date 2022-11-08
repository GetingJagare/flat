<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FlatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $i = 0;

        DB::beginTransaction();

        try {
            $file = fopen(public_path('property-data.csv'), 'r');
            while (($row = fgetcsv($file, 1000, ",")) !== false) {
                if ($i == 0) {
                    $i++;
                    continue;
                }

                DB::table('flats')->insert([
                    'name' => $row[0],
                    'price' => (float)$row[1],
                    'bedrooms' => $row[2],
                    'bathrooms' => $row[3],
                    'storeys' => $row[4],
                    'garages' => $row[5],
                ]);
            }

            fclose($file);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
        }
    }
}
