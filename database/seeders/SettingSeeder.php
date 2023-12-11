<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Setting;
class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $setting = new Setting();
        $setting->company = 'New Kanak Hosiery & Garments (N.K)';
        $setting->logo = 'asset/images/logo.png';
        $setting->address = 'Narayanganj 1400, Bangladesh';
        $setting->email = '#';
        $setting->phone = '#';
        $setting->save();
    }
}
