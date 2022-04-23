<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class RotaController extends Controller
{
    public function handleRota(Request $request){
        //dd($request);
        Storage::disk('s3')->put('images', $request->file('rotaimage'));
        //$path = Storage::disk('s3')->url($path);
    }
}
