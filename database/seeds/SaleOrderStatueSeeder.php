<?php

use Illuminate\Database\Seeder;
use App\Models\SaleOrderStatus;

class SaleOrderStatueSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        SaleOrderStatus::create([
            'name' => 'New',
            'code' => 'N'
        ]);
        SaleOrderStatus::create([
            'name' => 'Submit',
            'code' => 'S'
        ]);
        SaleOrderStatus::create([
            'name' => 'Invoiced',
            'code' => 'VO'
        ]);
        SaleOrderStatus::create([
            'name' => 'Integrated',
            'code' => 'TE'
        ]);
        SaleOrderStatus::create([
            'name' => 'Cancel',
            'code' => 'C'
        ]);
    }
}
