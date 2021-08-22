<?php

namespace App\Http\Controllers;

use App\Models\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FileController extends Controller
{


    public function store(Request $request)
    {


        $nameFile = null;

        if ($request->hasFile($request->nome) && $request->file($request->nome)->isValid()) {

            $descricao = $request->file($request->nome)->getClientOriginalName();

            $upload = $request->file($request->nome)->storeAs('/', $descricao,['disk'=>'ftp']);

            if (!$upload)
                return response()->json($upload, 401);

            return response()->json(['msg' => 'Upload realizado com sucesso'], 201);
        }
    }


    public function download($id)
    {
        $files = Storage::disk('ftp')->files('/', true);
        return  Storage::disk('ftp')->download('/'.$files[$id]);
    }



    public function destroy($id)
    {
        $file = Storage::disk('ftp')->files('/', true);
        Storage::disk('ftp')->delete($file[$id]);
        
        return \redirect()->route('home');
    }
}
