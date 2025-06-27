<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CustomerSurveyFormsController extends Controller
{
    public function create()
    {
        return view("customersurveyforms.create");
    }
}
