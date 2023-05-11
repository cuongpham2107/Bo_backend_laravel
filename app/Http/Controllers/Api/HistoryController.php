<?php

namespace App\Http\Controllers\Api;

use App\History;
use App\Player;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HistoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $per_page = $request->input('per_page',20);
        $player_id = auth()->user()->id;
        $results = History::with('player')->where('player_id',$player_id)->orderBy('created_at','DESC')->paginate($per_page);
        if($results->count() > 0){
            return response([
                'error_code' => 0,
                'results' =>$results,
            ],200);
        }
        else{
            return response([
                'error_code' => 1,
                'message' =>'Chưa có lịch sử giao dịch',
            ],200);
        }
    }
    public function get_all()
    {
      
        $results = History::orderBy('created_at','DESC')->where('status','success')->get();
        return response([
            'error_code' => 0,
            'results' =>$results ?? [],
        ],200);
      
    }
    public function new_history(Request $request)
    {
        // dd(1);
        list($day,$month,$year,$hour,$min,$sec) = explode("/",date('d/m/Y/H/i/s'));
        $time_now = $year.''.$month.''.$day.''.$hour.''.$min;
        // dd($time_now);
        $player_id = auth()->user()->id;
        if($request->bet_id){
            $results = History::orderBy('created_at','DESC')
            ->where('bet_id', $request->bet_id)
            ->where('player_id', $player_id)
            ->where('status', '!=' , 'success')
            ->get();
        }
        else{
            $results = History::orderBy('created_at','DESC')
            ->where('bet_id', $time_now)
            ->where('player_id', $player_id)
            ->where('status', '!=' , 'success')
            ->get();
        }

        if($results->count() > 0){
            $total_play = $results->sum('price');
            $total_win = 0;
            $total_loss = 0;
            foreach ($results as $key => $value) {
                    if($value->status == 'win'){
                        $total_win += $value->total_price;  
                    
                    }
                    elseif($value->status == 'loss'){
                        $total_loss += $value->total_price;
                    }
            }
            return response([
                'error_code' => 0,
                'results' =>$results,
                'total_play' => number_format($total_play),
                'total_win'=>number_format($total_win),
                'total_loss'=> number_format($total_loss),
                'sum'=> number_format($total_play + $total_win + $total_loss)
            ],200);
        }
        else{
            return response([
                'error_code' => 1,
                'message' =>'Chưa có lịch sử giao dịch phiên này',
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
            'bet_id' => 'required',
            'price' => 'required',
            'command_bet'=> 'required',
        ],
        [
            'price.required'=>'Số tiền đặt lệnh phải có',
            'command_bet.required'=> 'Lệnh đặt phải có',
        ]
        );
        
        $player = Player::where('id',auth()->user()->id)->where('status','unlock')->first();
        if($player && $player->money >= $fields['price']){
            $results = new History();
            $results->player_id = auth()->user()->id;
            $results->bet_id = $fields['bet_id'];
            $results->price = $fields['price'];
            $results->price_start = $player->money;
            $player->money = $player->money - $fields['price'];
            $player->save();
            $results->command_bet = $fields['command_bet'];
            $results->status = 'success';
            $results->updated_at = null;
            $results->period = date('Y-m-d H:i:s');
            $results->save();
            return response([
                'error_code' => 0,
                'results' =>$results,
                'player'=> $player,
            ],200);
        }
        else{
            return response([
                'error_code' => 1,
                'message' =>'Số dư trong tài khoản của bạn không đủ',
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
        $player_id = auth()->user()->id;
        $results = History::where('id',$id)->where('player_id',$player_id)->first();
        if($results){
            return response([
                'error_code' => 0,
                'results' =>$results,
            ],200);
        }
        else{
            return response([
                'error_code' => 1,
                'message' =>'Chưa có lịch sử giao dịch',
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
       
        $fields = $request->validate([
            'point_end'=> 'required',
        ]);
        $player = Player::where('id',auth()->user()->id)->where('status','unlock')->first();
        
        $results =  History::where('bet_id',$id)->whereBetween('created_at', [now()->subMinutes(10), now()])->first();
       
        if($results != null && $results->point_end == null){
            if($results->point_start > $fields['point_end'] && $results->command_bet == 'down'){
                $results->status = 'win';
                $results->total_price = $results->price;
                $player->money = $player->money + (2 * $results->price);
                $results->point_end = $fields['point_end'];
                $player->save();
                $results->save();
                return response([
                    'error_code' => 0,
                    'results' =>$results,
                    'player'  =>$player
                ],200);
            }
            elseif($results->point_start > $fields['point_end'] && $results->command_bet == 'up'){
                $results->status = 'loss';
                $results->total_price = $results->price;
                $results->point_end = $fields['point_end'];
                $player->save();
                $results->save();
                return response([
                    'error_code' => 0,
                    'results' =>$results,
                    'player'  =>$player
                ],200);
            }
            elseif($results->point_start < $fields['point_end'] && $results->command_bet == 'down'){
                $results->status = 'loss';
                $results->total_price = $results->price;
                $results->point_end = $fields['point_end'];
                $player->save();
                $results->save();
                return response([
                    'error_code' => 0,
                    'results' =>$results,
                    'player'  =>$player
                ],200);
            }
            elseif($results->point_start < $fields['point_end'] && $results->command_bet == 'up'){
                $results->status = 'win';
                $results->total_price = $results->price;
                $player->money = $player->money + (2 * $results->price);
                $results->point_end = $fields['point_end'];
                $player->save();
                $results->save();
                return response([
                    'error_code' => 0,
                    'results' =>$results,
                    'player'  =>$player
                ],200);
            }
            elseif($results->point_start == $fields['point_end']){
                $results->status = 'restore';
                $results->total_price = 0;
                $player->money = $player->money + $results->price;
                $results->point_end = $fields['point_end'];
                $player->save();
                $results->save();
                return response([
                    'error_code' => 0,
                    'results' =>$results,
                    'player'  =>$player
                ],200);
            }
            else{
                return response([
                    'error_code' => 1,
                    'message' =>'Giao dịch không thành công',
                ],200);
            }
        }
        else{
            return response([
                'error_code' => 1,
                'message' =>'Không tồn tại phiên giao dịch hoặc phiên giao dịch đã kết thúc',
            ],200);
        }
        
        
    }
    public function update_history(Request $request)
    {
        $fields = $request->validate([
            'eventTime' => 'required',
            'command' => 'required',
        ],
        [
            'eventTime.required'=>'Kỳ chơi phải có ',
            'command.required'=>'Giá trị phải có',
        ]);
        $results = History::where('bet_id',$fields['eventTime'])
        ->where('status','success')
        ->select('id','player_id','command_bet')
        ->get();
        if($results){
            $group_player_history = $results->groupBy('player_id');
            foreach ($group_player_history as $key => $value) {
                $player = Player::find($key);
                $total_price_command = 0;
                $total_win = 0;
                foreach ($value as $item) {
                    $history = History::find($item->id);
                    if($item->command_bet == $fields['command']){
                        $history->status = 'win';
                        $tt_price = $history->price * 0.9;

                        $total_price_command += $history->price;
                        $total_win += $tt_price;

                        $price_ed = $player->money + $total_price_command + $total_win;
                        $history->price_end = $price_ed;

                    }else{
                        $history->status = 'loss';
                        $leftprice = $history->price;
                        $tt_price = -$leftprice;
                        $history->price_end = $player->money;
                    }
                    $history->total_price = $tt_price;
                    $history->save();

                    prepare_bill(
                        $history->player_id,
                        "<p>*Lịch sử giao dịch</p>
                        <p>- Số tiền ban đầu: ". number_format($history->price_start) ."</p>
                        <p>- Tổng tiền đặt: ". number_format($history->price) ."</p>
                        <p>- Tổng tiền thắng/ thua: ". number_format($tt_price) ."</p>
                        <p>- Số tiền còn lại: ". number_format($history->price_end) ."</p>"
                        ,null);
                }
                $player_money = $player->money + $total_price_command + $total_win;
                $player->money = $player_money;
                $player->save();
            }
            return response([
                'error_code' => 0,
                'message' =>'Cập nhập lịch sử thành công',
                'player'  =>$player
            ],200);
        }
        else{
            return response([
                'error_code' => 0,
                'message' =>'Chưa có lịch sử nào trong phiên giao dịch này',
            ],200);
        }
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $results = History::find($id);
        if($results){
            $results->delete();
            return response([
                'error_code' => 0,
                'message' => 'Xoá lịch sử thành công'
            ],200);
        }
        else{
            return response([
                'error_code' => 1,
                'message' => 'Xoá lịch sử thất bại'
            ],200);
        }
    }
    
}
