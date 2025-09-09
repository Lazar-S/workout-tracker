<?php

namespace App\Console\Commands;

use App\Models\Workout;
use Illuminate\Console\Command;

class PopulateWorkouts extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:populate-workouts';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Populates the "workouts" table with data.';

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        $workouts = [
            [
                'name' => 'Push ups',
                'muscle_group' => 'Chest',
            ],
            [
                'name' => 'Pull ups',
                'muscle_group' => 'Back',
            ],
            [
                'name' => 'Bicep curls',
                'muscle_group' => 'Biceps',
            ],
            [
                'name' => 'Squats',
                'muscle_group' => 'Legs',
            ],
            [
                'name' => 'Bench press',
                'muscle_group' => 'Chest',
            ],
            [
                'name' => 'Tricep pull downs',
                'muscle_group' => 'Triceps',
            ],
            [
                'name' => 'Chest flys',
                'muscle_group' => 'Chest',
            ],
            [
                'name' => 'Preacher curls',
                'muscle_group' => 'Biceps',
            ],
            [
                'name' => 'Deadlifts',
                'muscle_group' => 'Back'
            ],
            [
                'name' => 'Leg press',
                'muscle_group' => 'Legs'
            ]
        ];
        $this->info('Inserting workouts...');
        Workout::insert($workouts);
        $this->info('Finished inserting workouts!');

        return 0;
    }
}
