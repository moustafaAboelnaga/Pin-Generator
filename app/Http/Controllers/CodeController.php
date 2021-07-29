<?php

namespace App\Http\Controllers;

use App\Http\RandomPinGenerator;
use App\Models\Code;
use Illuminate\Http\Request;

class CodeController extends Controller
{
    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function generateCode()
    {

        $generator = new RandomPinGenerator(new Code());

        $token = $generator->generate();

        return response()->json(['code'=>$token]);
    }
}
