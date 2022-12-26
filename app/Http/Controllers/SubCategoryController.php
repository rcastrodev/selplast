<?php

namespace App\Http\Controllers;

use App\Page;
use App\Image;
use App\Category;
use App\SubCategory;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Response;

class SubCategoryController extends Controller
{
    public function content()
    {
        return view('administrator.subcategory.content');
    }

    public function create()
    {
        $categories = Category::where('has_subcategory', '1')->orderBy('order', 'ASC')->get();
        return view('administrator.subcategory.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $data = $request->all();

        if($request->hasFile('image'))
            $data['image'] = $request->file('image')->store('images/subcategory','public');
        
        $subCategory = SubCategory::create($data);
        
        return redirect()->route('subcategory.content.edit', ['id' => $subCategory->id])->with('message', 'Subcategoría creada');
    }

    public function edit($id)
    {
        $subCategory = SubCategory::findOrFail($id);
        $categories = Category::where('has_subcategory', '1')->orderBy('order', 'ASC')->get();
        return view('administrator.subcategory.edit', compact('subCategory', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $element = SubCategory::find($id);
        $data = $request->all();
    
        if($request->hasFile('image')){
            if(Storage::disk('public')->exists($element->image))
                Storage::disk('public')->delete($element->image);
            
            $data['image'] = $request->file('image')->store('images/subcategory','public');
        }   

        $element->update($data);

        return redirect()->route('subcategory.content.edit', ['id' => $element->id])->with('message', 'Actualizada');
    }


    public function destroy($id)
    {
        $element = SubCategory::find($id);

        if(Storage::disk('public')->exists($element->image))
            Storage::disk('public')->delete($element->image);

        $element->delete();
        
        return response()->json([$element], 200);
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
        $subCategories = SubCategory::orderBy('order', 'ASC');
        return DataTables::of($subCategories)
        ->editColumn('image', function($subcategory) {
            return '<img src="'.asset($subcategory->image).'" width="150" height="50">';
        })
        ->editColumn('category', function($subcategory) {
            return $subcategory->category->name;
        })
        ->addColumn('actions', function($subcategory) {
            return '<a href="'. route('subcategory.content.edit', ['id' => $subcategory->id]) .'" class="btn btn-sm btn-primary rounded-pill far fa-edit"></a><button class="btn btn-sm btn-danger rounded-pill" onclick="modalDestroy('.$subcategory->id.')" title="Eliminar slider"><i class="far fa-trash-alt"></i></button>';
        })
        ->rawColumns(['actions', 'image'])
        ->make(true);
    }

    public function findImageCategory($id)
    {
        $image = Image::find($id);
        return response()->json(['content' => $image]);
    }

    public function imagesStore(Request $request)
    {
        $subCategory   = SubCategory::find($request->input('sub_category_id'));
        $data       = $request->all();

        if($request->hasFile('image'))
            $data['image'] = $request->file('image')->store('images/subcategory/images','public');
        
        unset($data['sub_category_id']);

        $subCategory->images()->create($data);

        return response()->json([], 201);
        
    }

    public function imagesUpdate(Request $request)
    {
        $element = Image::find($request->input('id'));
        $data    = $request->all();

        if($request->hasFile('image')){
            if(Storage::disk('public')->exists($element->image))
                Storage::disk('public')->delete($element->image);
            
            $data['image'] = $request->file('image')->store('images/category/images','public');
        }   
        
        $element->update($data);
        return response()->json([], 200);
    }

    public function imagesCategory($id)
    {
        $subCategory = SubCategory::find($id)->images()->orderBy('order', 'ASC');
        return DataTables::of($subCategory)
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
