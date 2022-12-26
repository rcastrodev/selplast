<?php

use App\Content;
use Illuminate\Database\Seeder;

class ContentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /** Home  */
        Content::create([
            'section_id'=> 1,
            'order'     => 'AA',
            'image'     => 'images/home/imagerobot1.png',
            'content_1' => 'Soluciones en insumos no productivos',
            'content_2' => 'Acompañamos a la industria con propuestas personalizadas basadas en nuestra experiencia y conocimiento.'
        ]);

        Content::create([
            'section_id'=> 2,
            'image'     => 'images/home/atelierCouture21.png',
            'content_1' => 'Calidad y excelencia en todos nuestros productos',
            'content_2' => '<p>Acompañamos a la industria con propuestas personalizadas basadas en nuestro conocimiento de materiales.</p>',
            'image2'     => 'images/home/Group2.png',
        ]);
        
        /** Empresa */
        Content::create([
            'section_id'=> 3,
            'image'     => 'images/company/Rectangle205.png',
            'content_1' => 'Sobre nosotros',
            'content_2' => '<p>Selplast S.A. es una empresa de origen familiar fundada en 1976. Desde sus comienzos mantiene la premisa de “solucionar problemas específicos en insumos no productivos para la industria”. La constante investigación de mercados a nivel mundial le brinda a Selplast S.A. una herramienta única: el conocimiento de nuevas propuestas y/o materiales, buscando implementarlas a nivel local.</p>
            <p>Por esta razón Selplast S.A., desde sus comienzos, trabaja con empresas que desean mejorar su calidad y eficiencia a nivel productivo con ideas innovadoras y prácticas.</p>',
        ]);

        Content::create([
            'section_id'=> 4,
            'order'     => 'A1',
            'image'     => 'images/company/noun-graphic3586153.png',
            'content_1' => 'Mejora continua',
            'content_2' => '<p>Somos un grupo de profesionales con una clara visión: satisfacer a nuestros clientes, crear oportunidades, innovar continuamente y ser líderes en el área.</p>',
        ]);

        Content::create([
            'section_id'=> 4,
            'order'     => 'A2',
            'image'     => 'images/company/noun-quality3320903.png',
            'content_1' => 'Calidad',
            'content_2' => '<p>Estamos principalmente enfocados en la confianza y especialmente comprometidos con el desarrollo de una actividad que logre satisfacer siempre.</p>',
        ]);

        Content::create([
            'section_id'=> 4,
            'order'     => 'A3',
            'image'     => 'images/company/noun-fast195788.png',
            'content_1' => 'Just in time',
            'content_2' => '<p>La disponibilidad permanente de nuestros variados productos, permite enviar en forma rápida y precisa a todos los centros de comercialización.</p>',
        ]);

        Content::create([
            'section_id'=> 5,
            'order'     => 'A1',
            'content_1' => 'Ropa Antiestatica',
            'content_2' => '<p>Fabricamos y diseñamos ropa antiestatica para todos los diversos usos que su industria requiera. Garantizamos excelencia y calidad en nuestros desarrollos</p>',
        ]);

        Content::create([
            'section_id'=> 5,
            'order'     => 'A2',
            'content_1' => 'Protección de piezas',
            'content_2' => '<p>Fabricamos y diseñamos textiles para protección de cualquier tipo de pieza industrial. Garantizamos excelencia y calidad en nuestros desarrollos</p>',
        ]);

        Content::create([
            'section_id'=> 5,
            'order'     => 'A3',
            'content_1' => 'Funda de robots',
            'content_2' => '<p>Fabricamos y diseñamos fundas para robots industriales. Nos adaptamos a las necesidades de tus equipos. Garantizamos excelencia y calidad en nuestros desarrollos</p>',
        ]);

        Content::create([
            'section_id'=> 5,
            'order'     => 'A4',
            'content_1' => 'Areas Limpias',
            'content_2' => '<p>Fabricamos y diseñamos fundas para robots industriales. Nos adaptamos a las necesidades de tus equipos. Garantizamos excelencia y calidad en nuestros desarrollos</p>',
        ]);

        Content::create([
            'section_id'=> 6,
            'image'     => 'images/quality/ISO-9001-ISO-14001_col1.png',
            'content_1' => 'Política Integral de Gestión',
            'content_2' => '<p>Somos una empresa certificada en busqueda de mejora permanente. La constante investigación de mercados a nivel mundial le brinda a Selplast S.A. una herramienta única: el conocimiento de nuevas propuestas y/o materiales, buscando implementarlas a nivel local.</p>
            <p>Creemos en la importancia de una comunicación fluida, fortaleciendo el crecimiento mutuo y sustentable.</p>
            ',
        ]);

        Content::create([
            'section_id'=> 7,
            'order'     => 'A1',
            'image'     => 'images/news/image76.png',
            'content_1' => 'Inversión en nuevos equipos de costura',
            'content_2' => '<p>En SelPlast creemos en la innovación constante y mejora de la producción para alcanzar los más altos estanderes. Fue por eso que adquirimos nueva máquinaria para nuestra fabrica.</p>
            <p>Asi es como logramos cumplir con nuestros objetivos de excelencia y calidad en el menor tiempo posible, sin comprometer los resultados finales.</p>',
            'content_3' => 'Equipos',
        ]);
    }
}






