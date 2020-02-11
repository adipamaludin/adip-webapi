<?php

use Illuminate\Database\Seeder;
use App\Student;

class StudentsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i=0; $i < 20; $i++) {
            $nama   = 'Adip-';
            $jk     = 'L';
            if ($i > 10) {
                $nama   = 'Rini-';
                $jk     = 'P';
            }
            Student::create([
            'nama'  => $nama . $i,
            'jk'    => $jk
        ]);
        }
    }
}
