<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\SystemSetting;

class SystemSettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        SystemSetting::updateOrCreate(
            ['key' => 'agent_commission_percent'],
            ['value' => 6]
        );

        SystemSetting::updateOrCreate(
            ['key' => 'point_rate_rm'],
            ['value' => 1]
        );
    }
}
