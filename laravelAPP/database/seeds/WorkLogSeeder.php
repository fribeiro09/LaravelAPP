<?php

use App\Models\Employee;
use App\Models\WorkLog;
use Illuminate\Database\Seeder;

class WorkLogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $employee = Employee::first();

        $employee->worklogs()->create([
            'date' => '2021-07-08',
            'time' => '06:00:00',
            'description' => 'WorkLog Teste',
        ]);
    }
}
