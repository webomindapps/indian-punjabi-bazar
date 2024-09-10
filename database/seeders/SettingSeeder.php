<?php

namespace Database\Seeders;

use App\Models\HomeSetting;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        HomeSetting::create([
            'name' => ' Indian Punjabi Bazaar',
            'contact_email' => 'info@indianpunjabi.ca',
            'admin_mails' => 'info@indianpunjabi.ca',
            'logo' => '',
            'phone' => '905-451-5756',
            'address' => '115 Father Tobin Rd, Brampton, ON L6R 0W9, Canada',
        ]);
    }
}
