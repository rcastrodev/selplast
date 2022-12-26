<?php

namespace App\Http\Controllers;

use App\Content;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PopupController extends Controller
{
    public function content(){
        $content = Content::where('section_id', 9)->first();
        return view('administrator.popup.content', compact('content'));
    }

    public function update(Request $request)
    {
        $element = Content::find($request->input('id'));
        $data = $request->all();
        $data['content_3'] = ($request->has('content_3')) ? '1' : '0';
        
        $element->update($data);

        return back()->with('mensaje', 'Actualizado con exito');

    }
}
