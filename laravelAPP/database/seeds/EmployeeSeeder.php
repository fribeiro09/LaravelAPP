<?php

use App\Models\Employee;
use Illuminate\Database\Seeder;

class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Employee::create([
            'name' => 'Funcionário MODELO',
            'document_number' => '01234567890',
            'zipcode' => '15015015',
            'address' => 'Rua Rubião Jr, 11111',
            'complement' => 'Ap 9999',
            'district' => 'Centro',
            'city' => 'São José do Rio Preto',
            'state' => 'SP',
            'cellular' => '17999998888',
            'email' => 'email@hotmail.com',
            'status' => 'A'
        ]);
    }
}
