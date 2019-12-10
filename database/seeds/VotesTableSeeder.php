<?php

use Illuminate\Database\Seeder;

class VotesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 0; $i < 1000; $i++) {
            $start_date = "-2 Months";
            $end_date = date("Y-m-d H:i:s");

            DB::table('votes')->insert([
                'mood_id' => rand(1, 3),
                'datetime' => $this->random_date($start_date, $end_date)
            ]);
        }
    }

    /**
     * Returns a random datetime based on a start- and end-date
     *
     * @return random datetime
     */
    private function random_date($start_date, $end_date)
    {
        // Convert to timetamps
        $min = strtotime($start_date);
        $max = strtotime($end_date);

        // Generate random number using above bounds
        $val = rand($min, $max);

        // Convert back to desired date format
        return date('Y-m-d H:i:s', $val);
    }
}
