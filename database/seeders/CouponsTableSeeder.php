<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Coupon;

class CouponsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $coupon = [
            [
                'code' => 'FA222',
                'type' => 'fixed',
                'value' => 50000,
                
            ],
            [
                'code' => 'FA111',
                'type' => 'fixed',
                'percent_off' => 10,
            ],
            [
                'code' => 'FA333',
                'type' => 'fixed',
                'percent_off' => 6,
            ],
            [
                'code' => 'FA444',
                'type' => 'fixed',
                'percent_off' => 5,
            ]
        ];
  
        foreach ($coupon as $key => $value) {
            Coupon::create($value);
        }
    }
}