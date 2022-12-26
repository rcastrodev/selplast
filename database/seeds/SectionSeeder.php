<?php

use App\Page;
use App\Section;
use Illuminate\Database\Seeder;

class SectionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /** Home */
        Section::create(['page_id' => Page::where('name', 'home')->first()->id, 'name' => 'section_1']);
        Section::create(['page_id' => Page::where('name', 'home')->first()->id, 'name' => 'section_2']);

        /** Empresa */
        Section::create(['page_id' => Page::where('name', 'empresa')->first()->id, 'name' => 'section_1']);
        Section::create(['page_id' => Page::where('name', 'empresa')->first()->id, 'name' => 'section_2']);

        /** Aplicaciones */
        Section::create(['page_id' => Page::where('name', 'aplicaciones')->first()->id, 'name' => 'section_1']);

        /** Calidad */
        Section::create(['page_id' => Page::where('name', 'calidad')->first()->id, 'name' => 'section_1']);

        /** Novedades */
        Section::create(['page_id' => Page::where('name', 'novedades')->first()->id, 'name' => 'section_1']);
    }
}
