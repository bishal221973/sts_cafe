<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        settings()->set([
            'app_name' => 'STS Entertainment',
            'print_app_name' => 'STS Entertainment Pvt. Ltd',
            'address' => 'Dhangadhi, Kailali',
            'vat' => '300224685',
            'sn_prefix' => 'AFT 030',
         ]);
    }
}
