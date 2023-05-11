<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Control;
use DateTime;

class ControlController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $results = Control::where('status','active')->orderBy('created_at','DESC')->get();
        if($results){
            return response([
                'error_code' => 0,
                'results'=>$results,
            ],200);
        }else{
            return response([
                'error_code' => 1,
                'message' => 'Không có bản ghi nào',
            ],200);
        }
    }
    public function show_new()
    {
        $results = Control::where('status','active')->where('created_at',date('Y-m-d H:i'))->select('period','command','type')->first();
        if($results){
            return response([
                'error_code' => 0,
                'results'=>$results,
            ],200);
        }else{
            return response([
                'error_code' => 1,
                'message' => 'Không có bản ghi nào',
            ],200);
        }
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
        $fields = $request->validate([
            'eventTime' => 'required',
            'close' => 'required',
        ],
        [
            'eventTime.required'=>'Kỳ chơi phải có ',
            'close.required'=>'Giá trị phải có',
        ]);
        
        $check = Control::where('period',$fields['eventTime'])->first();
        if($check == null){
            $results = new Control(); 
            $results->period = $fields['eventTime'];
            $results->status = 'active';
            $results->value = $fields['close'];
            $results->description = $request->description;
            $results->type = "Auto Binance";
            $data = Control::where('period',(string)((int)$fields['eventTime']-1))->first();
            if($data){
                if($data->value > $fields['close']){
                    $results->command = 'down';
                }
                elseif($data->value < $fields['close']){
                    $results->command = 'up';
                }
                else{
                    if(rand(1,2) == 1){
                        $results->command = 'up';
                    }
                    else{
                        $results->command = 'down';
                    }
                }
                
            }else{
                if(rand(1,2) == 1){
                    $results->command = 'up';
                }
                else{
                    $results->command = 'down';
                }
            }
            
            $results->save();
            return response([
                'error_code' => 0,
                'results' =>$results
            ],200);
        }
        else{
            return response([
                'error_code' => 0,
                'results' => $check
            ],200); 
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
        $results = Control::where('id',$id)->first();
        if($results){
            return response([
                'error_code' => 0,
                'results'=>$results,
            ],200);
        }else{
            return response([
                'error_code' => 1,
                'message' => 'Không có bản ghi nào',
            ],200);
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
