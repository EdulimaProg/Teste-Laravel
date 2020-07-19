<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class VideoController extends Controller
{
    public function index()
    {

        $categoria = DB::table('category')->select('*')->get();

        $categoriafav = DB::table('category')->select('*')->where('categoryfav',1)->get();

        $cntctgfav = count($categoriafav);

        $arr =[];

        for ($i = 0; $i < $cntctgfav; $i++){

            $dbresult = DB::table('video')
                ->select('*')
                ->where('category_idcategory', $categoriafav[$i]->idcategory)
                ->get();

            array_push($arr, ['namecategoria' => $categoriafav[$i]->categoryname, 'videos' => $dbresult]);
        }

        //dd($arr[0]);

        return view('index', ['category' => $categoria, 'favs' => $arr]);
    }

    //list video by category
    public function listVideoByCategory($category)
    {
        $dbresult = DB::table('video')
            ->select('*')
            ->where('category_idcategory', $category)
            ->get();

        return response()->json($dbresult);
    }

    //route for video player
    public function toViewVideo($id)
    {

        $dbResult = DB::table('video')
            ->select('*')
            ->where('idvideo', $id)
            ->get();

        //dd($dbResult[0]);
        return view('video/videoview', ['video' => $dbResult[0]]);
    }

    //video comentary add
    public function addComentary(Request $request)
    {

        $data = date('Y-m-d h:i:s');


        $author = $request->author == null ? 'anonymous' : $request->author;

        DB::table('comentario')->insert(
            [
                'author' => $author,
                'data' => $data,
                'coments' => $request->usercoment,
                'video_idvideo' => $request->videoid
            ]
        );
    }

    //video comentary list
    public function listComentary($id)
    {
        $dbresult = DB::table('comentario')
            ->select('*')
            ->where('video_idvideo',$id)
            ->orderBy('data', 'desc')
            ->get();


        return response()->json($dbresult);
    }

    //function for save new video
    public function save(Request $request)
    {

        $urlParts = explode('/', $request->url);
        $vidid = explode('&', str_replace('watch?v=', '', end($urlParts)));

        $url = 'https://www.youtube.com/embed/' . $vidid[0];

        //dd($url);
        DB::table('video')->insert(
            [
                'videotitle' => $request->title,
                'videourl' => $url,
                'category_idcategory' => $request->category
            ]
        );
        return redirect()->back();
    }
}
