<?php

namespace App\Http\Controllers;

use App\Page;
use App\Image;
use App\Content;
use App\Category;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\CategoryRequest;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Response;

class CategoryController extends Controller
{
    public function content()
    {
        return view('administrator.category.content');
    }

    public function create()
    {
        return view('administrator.category.create');
    }

    public function store(CategoryRequest $request)
    {
        $data = $request->all();
        
        if($request->hasFile('image'))
            $data['image'] = $request->file('image')->store('images/category','public');

        $category = Category::create($data);
        
        return redirect()->route('category.content.edit', ['id' => $category->id])->with('message', 'Categoría creada');
    }

    public function edit($id)
    {
        $category = Category::findOrFail($id);
        return view('administrator.category.edit', compact('category'));
    }

    public function update(CategoryRequest $request, $id)
    {
        $element = Category::find($id);
        $data = $request->all();
        
        $data['has_subcategory'] = ($request->has('has_subcategory')) ? '1' : '0';

        if($request->hasFile('image')){
            if(Storage::disk('public')->exists($element->image))
                Storage::disk('public')->delete($element->image);
            
            $data['image'] = $request->file('image')->store('images/category','public');
        }   

        $element->update($data);

        return redirect()->route('category.content.edit', ['id' => $element->id])->with('message', 'Actualizada');
    }

    public function find($id)
    {
        $content = Category::find($id);
        return response()->json(['content' => $content]);
    }

    public function destroy($id)
    {
        $element = Category::find($id);
        
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
        $categories = Category::orderBy('order', 'ASC');
        return DataTables::of($categories)
        ->editColumn('image', function($category) {
            return '<img src="'.asset($category->image).'" width="150" height="50">';
        })
        ->addColumn('actions', function($category) {
            return '<a href="'. route('category.content.edit', ['id' => $category->id]) .'" class="btn btn-sm btn-primary rounded-pill far fa-edit"></a><button class="btn btn-sm btn-danger rounded-pill" onclick="modalDestroy('.$category->id.')" title="Eliminar slider"><i class="far fa-trash-alt"></i></button>';
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
        $category   = Category::find($request->input('category_id'));
        $data       = $request->all();

        if($request->hasFile('image'))
            $data['image'] = $request->file('image')->store('images/category/images','public');
        
        unset($data['category_id']);
        $category->images()->create($data);

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
        $category = Category::find($id)->images()->orderBy('order', 'ASC');
        return DataTables::of($category)
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
