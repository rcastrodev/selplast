<?php

namespace App\Http\Controllers;

use SEO;
use App\Car;
use App\Data;
use App\Page;
use App\Client;
use App\Content;
use App\Product;
use App\Service;
use App\Category;
use App\Document;
use App\Industry;
use App\Certificate;
use App\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Response;

class PagesController extends Controller
{
    private $data;

    public function __construct()
    {
        $this->data = Data::first();
    }

    public function home()
    {
        $page = Page::where('name', 'home')->first();
        SEO::setTitle('home');
        SEO::setDescription(strip_tags($this->data->description)); 
        $sections   = $page->sections;
        $sliders    = Content::where('section_id', 1)->orderBy('order', 'ASC')->get();
        $categories = Category::orderBy('order', 'ASC')->get();
        $section2   = Content::where('section_id', 2)->first();
        $industries = Industry::where('outstanding', '1')->orderBy('order', 'ASC')->get();
        $clients    = Client::where('outstanding', '1')->orderBy('order', 'ASC')->take(6)->get();
        $news       = Content::where('section_id', 8)->where('content_5', '1')->orderBy('order', 'ASC')->get();
        $popup      = Content::where('section_id', 9)->first();
        return view('paginas.index', compact('sliders', 'categories', 'section2', 'industries', 'clients', 'news', 'popup'));
    }

    public function empresa()
    {
        SEO::setTitle('empresa');
        SEO::setDescription(strip_tags($this->data->description)); 
        $section1  = Content::where('section_id', 3)->first();
        $sections2 = Content::where('section_id', 4)->orderBy('order', 'ASC')->get();
        $clients   = Client::orderBy('order', 'ASC')->get();
        SEO::setDescription(strip_tags($this->data->description));

        return view('paginas.empresa', compact('section1', 'sections2', 'clients'));
    }

    public function categorias()
    {
        SEO::setTitle('produtos');
        SEO::setDescription(strip_tags($this->data->description)); 
        $categorias = Category::orderBy('order', 'ASC')->get();
        return view('paginas.categorias', compact('categorias'));
    }

    public function categoria($id)
    {
        $categoria = Category::findOrFail($id);
        SEO::setDescription(strip_tags($this->data->description)); 
        SEO::setTitle($categoria->name);
        SEO::setDescription(strip_tags($categoria->description)); 
        return view('paginas.categoria', compact('categoria'));
    }

    public function subCategoria($id)
    {
        $subCategoria = SubCategory::findOrFail($id);
        SEO::setDescription(strip_tags($this->data->description)); 
        SEO::setTitle($subCategoria->name);
        return view('paginas.subcategoria', compact('subCategoria'));
    }

    public function aplicaciones()
    {
        SEO::setTitle('aplicaciones');
        SEO::setDescription(strip_tags($this->data->description)); 
        $aplicaciones = Content::where('section_id', 5)->orderBy('order', 'ASC')->get();
        return view('paginas.aplicaciones', compact('aplicaciones'));
    }

    public function industrias()
    {
        SEO::setTitle('industrias');
        SEO::setDescription(strip_tags($this->data->description)); 
        $industrias = Industry::orderBy('order', 'ASC')->get();
        
        return view('paginas.industrias', compact('industrias'));    
    }

    public function industria($id)
    {
        $industria = Industry::find($id);
        SEO::setTitle($industria->content_1);
        SEO::setDescription(strip_tags($industria->content_2)); 
        return view('paginas.industria', compact('industria'));  
    }

    public function calidad()
    {
        $calidad        = Content::where('section_id', 6)->first();
        $certificados   = Content::where('section_id', 7)->orderBy('order', 'ASC')->get();
        SEO::setTitle($calidad->content_1);
        SEO::setDescription(strip_tags($calidad->content_2)); 
        return view('paginas.calidad', compact('calidad', 'certificados'));    
    }

    public function novedades()
    {
        SEO::setTitle('novedades');
        SEO::setDescription(strip_tags($this->data->description)); 
        $news = Content::where('section_id', 8)->orderBy('order', 'ASC')->get();
        return view('paginas.novedades', compact('news'));
    }

    public function novedad($id)
    {
        $new = Content::findOrFail($id);
        SEO::setTitle($new->content_1);
        SEO::setDescription(strip_tags($new->content_2)); 
        return view('paginas.novedad', compact('new'));
    }

    public function presupuesto()
    {
        SEO::setTitle('presupuesto');
        SEO::setDescription(strip_tags($this->data->description)); 
        return view('paginas.presupuesto');
    }

    public function contacto()
    {
        $content = Content::where('section_id', 9)->where('content_1', 'Contacto')->first();
        $page = Page::where('name', 'contacto')->first();
        SEO::setTitle("contacto");
        return view('paginas.contacto', compact('content'));
    }

    public function descargas()
    {
        SEO::setTitle('descargas');
        SEO::setDescription(strip_tags($this->data->description)); 
        $elements = Content::where('section_id', 9)->orderBy('order', 'ASC')->get();
        return view('paginas.descargas', compact('elements'));
    }

    public function certificados()
    {
        SEO::setTitle('certificados');
        SEO::setDescription(strip_tags($this->data->description)); 
    
        $client = Client::find(session('user_id'));
        
        if($client) 
            $certificates = $client->certificates;
        else
            $certificates = [];
        
        return view('paginas.certificados', compact('certificates'));
    }
}
