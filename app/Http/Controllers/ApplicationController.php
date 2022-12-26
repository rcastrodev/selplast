<?php

namespace App\Http\Controllers;

use App\Page;
use App\Image;
use App\Content;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\CategoryRequest;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Response;

class ApplicationController extends Controller
{
    public function content()
    {
        return view('administrator.applications.content');
    }

    public function create()
    {
        return view('administrator.applications.create');
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $content = Content::create($data);
        
        return redirect()->route('application.content.edit', ['id' => $content->id])->with('message', 'Aplicación creada');
    }

    public function edit($id)
    {
        $content = Content::findOrFail($id);
        return view('administrator.applications.edit', compact('content'));
    }

    public function update(Request $request, $id)
    {
        $element = Content::find($id);
        $data = $request->all();
        $element->update($data);

        return redirect()->route('application.content.edit', ['id' => $element->id])->with('message', 'Actualizada');
    }

    public function destroy($id)
    {
        $element = Content::find($id);
        
        if(Storage::disk('public')->exists($element->image))
            Storage::disk('public')->delete($element->image);

        $element->delete();
        return response()->json([], 200);
    }

    public function imageDestroy($id)
    {
        $element = Image::find($id);
        
        if(Storage::disk('public')->exists($element->image))
            Storage::disk('public')->delete($element->image);

        $element->delete();
        return response()->json([], 200);
    }

    public function getList()
    {
        $content = Content::where('section_id', 5)->orderBy('order', 'ASC');

        return DataTables::of($content)
        ->addColumn('actions', function($element) {
            return '<a href="'. route('application.content.edit', ['id' => $element->id]) .'" class="btn btn-sm btn-primary rounded-pill far fa-edit"></a><button class="btn btn-sm btn-danger rounded-pill" onclick="modalDestroy('.$element->id.')" title="Eliminar slider"><i class="far fa-trash-alt"></i></button>';
        })
        ->rawColumns(['actions', 'content_2'])
        ->make(true);
    }

    public function findImageCategory($id)
    {
        $image = Image::find($id);
        return response()->json(['content' => $image]);
    }

    public function imagesStore(Request $request)
    {
        $content   = Content::find($request->input('conten_id'));
        $data      = $request->all();

        if($request->hasFile('image'))
            $data['image'] = $request->file('image')->store('images/applications/images','public');
        
        unset($data['conten_id']);

        $content->images()->create($data);

        return response()->json([], 201);
        
    }

    public function imagesUpdate(Request $request)
    {
        $element = Image::find($request->input('id'));
        $data    = $request->all();

        if($request->hasFile('image')){
            if(Storage::disk('public')->exists($element->image))
                Storage::disk('public')->delete($element->image);
            
            $data['image'] = $request->file('image')->store('images/applications/images','public');
        }   
        
        $element->update($data);
        return response()->json([], 200);
    }

    public function imagesCategory($id)
    {
        $content = Content::find($id)->images()->orderBy('order', 'ASC');
        return DataTables::of($content)
        ->editColumn('image', function($element) {
            return '<img src="'.asset($element->image).'" width="240" height="180" style="object-fit: contain;">';
        })
        ->addColumn('actions', function($element) {
            return '<button type="button" class="btn btn-sm btn-primary rounded-pill far fa-edit" data-toggle="modal" data-target="#modal-update-element" onclick="findContentImageCategory('.$element->id.')"></button><button class="btn btn-sm btn-danger rounded-pill" onclick="modalDestroy2('.$element->id.')" title="Eliminar slider"><i class="far fa-trash-alt"></i></button>';
        })
        ->rawColumns(['actions', 'image'])
        ->make(true);
    }
}
