<?php

namespace App\Http\Controllers;

use App\Page;
use App\Content;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\CompanyInfoRequest;

class CompanyController extends Controller
{
    protected $page;

    public function __construct(){
        $this->page = Page::where('name', 'empresa')->first();
    }

    public function content()
    {
        $section1 = Content::where('section_id', 3)->first();
        $section3s = Content::where('section_id', 5)->get();
        return view('administrator.company.content', compact('section1', 'section3s'));
    }
    
    public function storeSlider(Request $request)
    {
        $data = $request->all();

        if($request->hasFile('image'))
            $data['image'] = $request->file('image')->store('images/company','public');
        

        Content::create($data);
        return back()->with('mensaje', 'Creado con exito');
    }

    public function updateSlider(Request $request)
    {
        $data       = $request->all();
        $element    = Content::find($request->input('id'));

        if($request->hasFile('image')){

            if(Storage::disk('public')->exists($element->image))
                Storage::disk('public')->delete($element->image);
            
            $data['image'] = $request->file('image')->store('images/company','public');
        } 

        $element->update($data);

        return back()->with('mensaje', 'Actualizado con exito');
    }

    public function updateInfo(CompanyInfoRequest $request)
    {
        $element= Content::find($request->input('id'));
        $data   = $request->all();

        if($request->hasFile('image')){
            if(Storage::disk('public')->exists($element->image))
                Storage::disk('public')->delete($element->image);
            
            $data['image'] = $request->file('image')->store('images/company','public');
        } 

        $element->update($data);

        return back()->with('mensaje', 'Actualizado con exito');
    }


    public function destroySlider($id)
    {
        $element = Content::find($id);
        if(Storage::disk('public')->exists($element->image))
            Storage::disk('public')->delete($element->image);
        
        $element->delete();
        return response()->json([], 200);
    }

    public function sliderGetList()
    {
        $sectionSlider = $this->page->sections()->where('name', 'section_2')->first();
        $sliders = $sectionSlider->contents()->orderBy('order', 'ASC');

        return DataTables::of($sliders)
        ->editColumn('image', function($slider){
            return '<img src="'.asset($slider->image).'" class="img-fluid" style="max-width:100px">';
        })
        ->addColumn('actions', function($slider) {
            return '<button type="button" class="btn btn-sm btn-primary rounded-pill far fa-edit" data-toggle="modal" data-target="#modal-update-element" onclick="findContent('.$slider->id.')"></button><button class="btn btn-sm btn-danger rounded-pill" onclick="modalDestroy('.$slider->id.')" title="Eliminar slider"><i class="far fa-trash-alt"></i></button>';
        })
        ->rawColumns(['actions', 'content_1', 'image', 'content_2'])
        ->make(true);
    }
}
