<?php

namespace App\Http\Controllers;

use http\Env\Response;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use mysql_xdevapi\Exception;

class CategoriaController extends Controller
{
    public function cadastro(Request $request)
    {
        //dd($request->all());

        $arr = [];
        try {
            DB::table('category')->insert(
                [
                    'categoryname' => $request->categoryname,
                    'categorydesc' => $request->categorydesc,
                    'fav' => $request->fav
                ]
            );
            array_push(
                $arr,
                [
                    'code' => 200,
                    'message' => 'Salvo com sucesso'
                ]
            );

        }catch (QueryException $e){
            if($e->getCode() == 23000){
                array_push(
                    $arr,
                    [
                        'code' => 401,
                        'message' => 'Falha ao Salvar'
                    ]
                );
            };
        }

        return response()->json($arr[0]);
    }
    public function atualizar(Request $request)
    {
        $arr = [];

        try {
            DB::table('category')
                ->where('id', $request->id)
                ->update(
                    [
                        'categoryname' => $request->categoryname,
                        'categorydesc' => $request->categorydesc,
                        'fav' => $request->fav
                    ]
                );
            array_push(
                $arr,
                [
                    'code' => 200,
                    'message' => 'Atualizado com sucesso'
                ]
            );
        }catch (QueryException $e){
            if($e->getCode() == 23000){
                array_push(
                    $arr,
                    [
                        'code' => 401,
                        'message' => 'Falha ao Atualizar'
                    ]
                );
            };
        }

    }
    public function excluir($id)
    {
        $arr = [];
        try {
            $check = DB::table('category')->select('idcategory')->where('idcategory', $id)->get();
            if ($check->isEmpty() == false){
                DB::table('category')->where('idcategory', $id)->delete();
                array_push(
                    $arr,
                    [
                        'code' => 200,
                        'message' => 'Excluido com sucesso'
                    ]
                );
            }else{
                array_push(
                    $arr,
                    [
                        'code' => 400,
                        'message' => 'O Valor Não Existe'
                    ]
                );
            }


        }catch (QueryException $e){
            if($e->getCode() == 23000){
                array_push(
                    $arr,
                    [
                        'code' => 401,
                        'message' => 'Falha ao Excluir'
                    ]
                );
            };
        }
        return response()->json($arr);
    }
}
