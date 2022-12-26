<?php

namespace App\Http\Controllers;

use App\Content;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Response;

class ContentController extends Controller
{
    public function content()
    {
        return null;
    }

    public function findContent($id)
    {
        $content = Content::find($id);
        return response()->json(['content' => $content]);
    }

    public function destroyImage($id, $reg)
    {
        $element = Content::find($id);
        if(Storage::disk('public')->exists($element->$reg))
            Storage::disk('public')->delete($element->$reg);

        $element->$reg = null;
        $element->save();

        return response()->json([], 200);
    }

    public function descargarArchivo($id, $reg)
    {
        $content = Content::findOrFail($id);  
        if (Storage::disk('public')->exists($content->$reg)) {
            return Response::download($content->$reg);  
        }else{
            return back();  
        }
        
    }

    public function descargarArchivo2($id)
    {
        $content = Content::findOrFail($id);  
        if (Storage::disk('public')->exists($content->image)) {
            return Response::download($content->image);  
        }else{
            return back();  
        }
    }
}
