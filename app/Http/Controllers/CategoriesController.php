<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use App\Models\Category;

class CategoriesController extends Controller
{
      public function index(Request $request)
    {
            if ($request->ajax()) {
                $name =  (!empty($_GET["name"])) ? ($_GET["user_name"]) : ('');


                $result =  Category::query();
                if ($name != "") {
                    $result = $result->where('name', 'ilike', '%' . $name . '%');
                }


                if(!empty($request->retailcategory)){
                    $result = $result->whereNotIN('id',[15]);
                }
                $result = $result->get();
                return DataTables::of($result)
                    ->make(true);
            }
            return view('categories.index');

    }
}
