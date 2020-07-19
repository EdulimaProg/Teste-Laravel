<?php

namespace App\Http\Controllers;

use http\Env\Response;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use mysql_xdevapi\Exception;

class CategoriaController extends Controller
{
    //list all category in add video menu
    public function listar()
    {
        $dbResult = DB::table('category')->select('*')->get();

        return response()->json($dbResult);
    }

    //save new category
    public function cadastro(Request $request)
    {
        //dd($request->all());
        DB::table('category')->insert(
            [
                'categoryname' => $request->categoryname,
                'categoryfav' => $request->fav == "false" ? false : true
            ]
        );

        return redirect()->back();
    }

    //route for list all category
    public function toCategoryList($id)
    {
        $dbResult = DB::table('video')->select('*')
            ->join('category', 'video.category_idcategory', '=', 'category.idcategory')
            ->where('category.idcategory', $id)->get();

        //dd($dbResult);

        return view('category/category',['title'=> $dbResult[0]->categoryname,'list' => $dbResult]);

    }

    //list for list for all favorite category
    public function Categoryget($id)
    {
        $dbResult = DB::table('video')
            ->select('videotitle','videourl')
            ->join('category', 'video.category_idcategory', '=', 'category.idcategory')
            ->where('video.category_idcategory', $id)
            ->get();

        return response()->json($dbResult);
    }

}
