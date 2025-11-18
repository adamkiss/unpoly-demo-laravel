<?php

namespace Database\Seeders;

use App\Models\Company;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Project;
use App\Models\Task;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder {
	/**
	 * Seed the application's database.
	 */
	public function run(): void {
		Company::factory(5)->create();
		for ($i = 1; $i <= 5; $i++) {
			Project::factory(4)->create([
				'company_id' => $i,
			]);
		}

		for ($i=1; $i <= 20; $i++) {
            $t = Task::factory()->create();
            $t->created_at = now()
                ->subHours(20 - $i)
                ->subMinutes(rand(0,59))
                ->subSeconds(rand(0,59));
            $t->position = $i;
            $t->save();
        }
	}
}
