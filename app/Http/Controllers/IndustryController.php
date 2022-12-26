<?php

namespace App\Http\Controllers;

use App\Page;
use App\Image;
use App\Client;
use App\Content;
use App\Industry;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Response;

class IndustryController extends Controller
{
    public function content()
    {
        return view('administrator.industry.content');
    }

    public function create()
    {
        return view('administrator.industry.create');
    }

    public function store(Request $request)
    {
        $data = $request->all();
        
        if($request->hasFile('image'))
            $data['image'] = $request->file('image')->store('images/industry','public');

        $data['outstanding'] = ($request->has('outstanding')) ? '1' : '0';

        $industry = Industry::create($data);
        
        return redirect()->route('industry.content.edit', ['id' => $industry->id])->with('message', 'Industria creada');
    }

    public function edit($id)
    {
        $industry = Industry::findOrFail($id);
        $clients  = Client::orderBy('content_1', 'ASC')->get();
        return view('administrator.industry.edit', compact('industry', 'clients'));
    }

    public function update(Request $request, $id)
    {
        $element = Industry::find($id);
        $data = $request->all();
        
        $data['outstanding'] = ($request->has('outstanding')) ? '1' : '0';

        if($request->hasFile('image')){
            if(Storage::disk('public')->exists($element->image))
                Storage::disk('public')->delete($element->image);
            
            $data['image'] = $request->file('image')->store('images/industry','public');
        }   

        $element->update($data);

        $clients = $element->clients;
        if ($request->has('clients_id')) {
            if($request->input('clients_id')){
                $element->clients()->wherePivotNotIn('client_id', $request->input('clients_id'))->detach();
    
                foreach ($request->input('clients_id') as $client_id) {
                    if(! in_array($client_id, $clients->pluck('id')->toArray()))
                        $element->clients()->attach($client_id);
                }
            }else{
                $element->clients()->detach();
            }
        }else{
            $element->clients()->detach();
        }

        return redirect()->route('industry.content.edit', ['id' => $element->id])->with('message', 'Actualizada');
    }


    public function destroy($id)
    {
        $element = Industry::find($id);
        
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
        $industries = Industry::orderBy('order', 'ASC');
        return DataTables::of($industries)
        ->editColumn('image', function($industry) {
            return '<img src="'.asset($industry->image).'" width="150" height="50">';
        })
        ->addColumn('actions', function($industry) {
            return '<a href="'. route('industry.content.edit', ['id' => $industry->id]) .'" class="btn btn-sm btn-primary rounded-pill far fa-edit"></a><button class="btn btn-sm btn-danger rounded-pill" onclick="modalDestroy('.$industry->id.')" title="Eliminar slider"><i class="far fa-trash-alt"></i></button>';
        })
        ->rawColumns(['actions', 'image', 'content_2'])
        ->make(true);
    }

    public function findImageCategory($id)
    {
        $image = Image::find($id);
        return response()->json(['content' => $image]);
    }

    public function imagesStore(Request $request)
    {
        $industry   = Industry::find($request->input('industry_id'));
        $data       = $request->all();

        if($request->hasFile('image'))
            $data['image'] = $request->file('image')->store('images/industry/images','public');
        
        unset($data['industry_id']);
        $industry->images()->create($data);

        return response()->json([], 201); 
    }

    public function imagesUpdate(Request $request)
    {
        $element = Image::find($request->input('id'));
        $data    = $request->all();

        if($request->hasFile('image')){
            if(Storage::disk('public')->exists($element->image))
                Storage::disk('public')->delete($element->image);
            
            $data['image'] = $request->file('image')->store('images/industry/images','public');
        }   
        
        $element->update($data);
        return response()->json([], 200);
    }

    public function imagesCategory($id)
    {
        $industry = Industry::find($id)->images()->orderBy('order', 'ASC');
        return DataTables::of($industry)
        ->editColumn('image', function($element) {
            return '<img src="'.asset($element->image).'" width="150" height="160">';
        })
        ->addColumn('actions', function($element) {
            return '<button type="button" class="btn btn-sm btn-primary rounded-pill far fa-edit" data-toggle="modal" data-target="#modal-update-element" onclick="findContentImageCategory('.$element->id.')"></button><button class="btn btn-sm btn-danger rounded-pill" onclick="modalDestroy2('.$element->id.')" title="Eliminar slider"><i class="far fa-trash-alt"></i></button>';
        })
        ->rawColumns(['actions', 'image'])
        ->make(true);
    }
}
