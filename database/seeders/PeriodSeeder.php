<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PeriodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $period = \App\Models\Period::firstOrCreate(
            ['name' => 'Kabinet Reboot'],
            [
                'academic_year' => '2025/2026',
                'description' => 'Kabinet Kepengurusan HMIF ITATS Periode 2025/2026',
                'is_active' => true,
            ]
        );

        // Assign existing members without period to Kabinet Reboot
        \App\Models\OrgMember::whereNull('period_id')->update([
            'period_id' => $period->id,
        ]);
    }
}
