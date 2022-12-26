<?php

namespace App\Http\Controllers;

use App\Page;
use App\Content;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Storage;

class NewsController extends Controller
{
    protected $page;

    public function __construct(){
        $this->page = Page::where('name', 'novedades')->first();
    }

    public function content()
    {
        return view('administrator.news.content');
    }
    
    public function createInfo(Request $request)
    {
        $data = $request->all();

        if($request->hasFile('image'))            
            $data['image'] = $request->file('image')->store('images/news','public');

        if($request->hasFile('image2'))            
            $data['image2'] = $request->file('image2')->store('images/news','public');
        
        $data['content_5'] = ($request->has('content_5')) ? '1' : '0';
        Content::create($data);

        return back()->with('mensaje', 'creado con exito');
    }

    public function updateInfo(Request $request)
    {
        $element= Content::find($request->input('id'));
        $data   = $request->all();
        
        if($request->hasFile('image')){
            if(Storage::disk('public')->exists($element->image))
                Storage::disk('public')->delete($element->image);
            
            $data['image'] = $request->file('image')->store('images/news','public');
        } 

        if($request->hasFile('image2')){
            if(Storage::disk('public')->exists($element->image2))
                Storage::disk('public')->delete($element->image2);
            
            $data['image2'] = $request->file('image2')->store('images/news','public');
        } 
        
        $data['content_5'] = ($request->has('content_5')) ? '1' : '0';
        $element->update($data);

        return back()->with('mensaje', 'Contenido actualizado con exito');
    }


    public function destroySlider($id)
    {
        $element = Content::find($id);
        
        if(Storage::disk('public')->exists($element->image))
            Storage::disk('public')->delete($element->image);

        if(Storage::disk('public')->exists($element->image2))
            Storage::disk('public')->delete($element->image2);
        
        $element->delete();

        return response()->json([], 200);
    }

    public function sliderGetList()
    {
        $sectionSlider = $this->page->sections()->where('name', 'section_1')->first();

        $sliders = $sectionSlider->contents()->orderBy('order', 'ASC');

        return DataTables::of($sliders)
        ->editColumn('image', function($slider){
            return '<img src="'.asset($slider->image).'" class="img-fluid" style="max-width:100px">';
        })
        ->editColumn('content_2', function($slider){
            return Str::of($slider->content_2)->limit(300);
        })
        ->addColumn('actions', function($slider) {
            return '<button type="button" class="btn btn-sm btn-primary rounded-pill far fa-edit" data-toggle="modal" data-target="#modal-update-element" onclick="findContent('.$slider->id.')"></button><button class="btn btn-sm btn-danger rounded-pill" onclick="modalDestroy('.$slider->id.')" title="Eliminar slider"><i class="far fa-trash-alt"></i></button>';
        })
        ->rawColumns(['actions', 'image', 'content_2'])
        ->make(true);
    }
}
