<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Result;

class ResultController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try{
            $data = $request->all();
            $value = '';

            for($i = 0; $i < count($request['action_result']); $i++) {
                if($i == 0){
                    $value = $request['action_result'][$i];  
                }
                else{
                    $value = $value.','.$request['action_result'][$i];
                }
            }

            $result = Result::create([
                'action_result' => $value,
                'id_petition'=>$data['id_petition']
            ]);

            return response()->json(['data'=>$result, 'status'=>true]);
        }catch(Exception $e){
            return response()->json(['data'=>'Could not create a Result', 'status'=>true]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try{
            $results = DB::table('results')->where('id_petition', $id)->get()->toArray();
            $actions = explode(',',$results[0]->action_result);

            return response()->json($actions, 200);
        }catch(Exception $e){
            return $e;
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
