<?php

namespace Database\Seeders;

use App\Models\Type;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Remove all the existing data
        Type::truncate();

        // Open the file for reading
        $dataFile = fopen(base_path("database/data/types.csv"), "r");
        $firstLine = true;

        // Loop through the file, create a new record for each line
        // Except the first line, which is the header
        while (($data = fgetcsv($dataFile)) !== false) {
            if (!$firstLine) {
                Type::create([
                    'identifier' => $data[1],
                    'generation_id' => $data[2],
                    'damage_class_id' => $data[3],
                ]);
            }

            $firstLine = false;
        }

        // Close the file
        fclose($dataFile);
    }
}
