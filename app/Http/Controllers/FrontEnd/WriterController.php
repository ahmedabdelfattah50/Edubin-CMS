<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;

class WriterController extends Controller
{
    public function show($writerID){
        $writer = User::find($writerID, [
            'id',
            'name',
            'email',
            'about'
        ]);
        return view('frontEnd.writer.writerShow',[
            'writer' => $writer
        ]);
    }
}
