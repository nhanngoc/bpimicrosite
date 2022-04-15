<?php

use Illuminate\Database\Seeder;

use App\Models\CompanyCode;

class CompanyCodeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        CompanyCode::create([
            'code'           => 3310,
            'plant'          => 3311,
            'purchasing_org' => 3311,
            'name'           => 'CJ Gemadept Logistics Holdings Co., Ltd',
            'params'         => []
        ]);

        CompanyCode::create([
            'code'           => 3320,
            'plant'          => 3321,
            'purchasing_org' => 3321,
            'name'           => 'Gemadept Logistics One member Co., Ltd',
            'params'         => []
        ]);

        CompanyCode::create([
            'code'           => 3330,
            'plant'          => 3331,
            'purchasing_org' => 3331,
            'name'           => 'Gemadept Hai Phong One member Co., Ltd',
            'params'         => []
        ]);

        CompanyCode::create([
            'code'           => 3340,
            'plant'          => 3341,
            'purchasing_org' => 3341,
            'name'           => 'Mekong Logistic Joint stock Company',
            'params'         => []
        ]);

        CompanyCode::create([
            'code'           => 3350,
            'plant'          => 3351,
            'purchasing_org' => 3351,
            'name'           => 'CJ Gemadept Shipping Holdings Co., Ltd',
            'params'         => []
        ]);

        CompanyCode::create([
            'code'           => 3360,
            'plant'          => 3361,
            'purchasing_org' => 3361,
            'name'           => 'Gemadept Shipping Limited Company',
            'params'         => []
        ]);

        CompanyCode::create([
            'code'           => 3370,
            'plant'          => 3371,
            'purchasing_org' => 3371,
            'name'           => 'Gemadept Shipping Singapore Pte. Ltd.',
            'params'         => []
        ]);

        CompanyCode::create([
            'code'           => 3380,
            'plant'          => 3381,
            'purchasing_org' => 3381,
            'name'           => 'Gemadept Shipping Malaysia SDN. BHD.',
            'params'         => []
        ]);

        CompanyCode::create([
            'code'           => 3390,
            'plant'          => 3391,
            'purchasing_org' => 3391,
            'name'           => 'Gemadept Cambodia branch.',
            'params'         => []
        ]);
    }
}
