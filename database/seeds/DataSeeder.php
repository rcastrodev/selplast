<?php

use App\Data;
use App\Company;
use Illuminate\Database\Seeder;

class DataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Data::create([
            'company_id'=> Company::first()->id,
            'address'   => 'Riobamba 2857 - Beccar Buenos Aires, Argentina',
            'email'     => 'ventas@rcbalanzas.com.ar',
            'email2'    => 'soportetecnico@rcbalanzas.com.ar',
            'phone1'    => '+5401146822239|(011) 46822239',
            'phone2'    => '+541149186507|6507',
            'instagram' => '#',
            'facebook'  => '#',
            'logo_header'=> 'images/data/LogoSelplast1.png',
            'logo_footer'=> 'images/data/LogoSelplast11.png',
        ]);
    }
}