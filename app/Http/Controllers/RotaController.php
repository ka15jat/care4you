<?php

namespace App\Http\Controllers;

use App\Models\rotaUpload;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class RotaController extends Controller
{
    public function handleRota(Request $request){
        $path = Storage::disk('s3')->put('images', $request->file('rotaimage'));
        $rota = rotaUpload::where('companyCode', Auth::guard('Owner')->user()->companyCode);
        $rotaCheck = $rota->first();
        if(is_null($rotaCheck)){
            //create rota record
            $rotaRecord = new rotaUpload;
            $rotaRecord->userID = Auth::guard('Owner')->user()->id;
            $rotaRecord->path = $path;
            $rotaRecord->companyCode = Auth::guard('Owner')->user()->companyCode;
            $rotaRecord->save();
        }else{
            //update record
            $rota->update([
                'path' => $path
            ]);
        }
        return redirect()->route('staffView')->with('success', 'Rota has been uploaded.');
    }

    public function index(){
        if(Auth::guard('Staff')->check()){
            $companyCode = Auth::guard('Staff')->user()->companyCode;
        }else if(Auth::guard('Owner')->check()){
            $companyCode = Auth::guard('Owner')->user()->companyCode;
        }
        $path = rotaUpload::where('companyCode', $companyCode)->first()->path ?? '';
        return view('regular.staffView')->with('path', $path);
    }
}
