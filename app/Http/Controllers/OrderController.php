<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Order;
use App\Picker;
use Config;
use DateTime;
use Session;
use DB;

class OrderController extends Controller
{
    public function __construct()
    {
      if(!Session::has('update_interval')){
        Session::put('update_interval', Config::get('app.updateInterval'));
      }
      $this->middleware('auth', ['except'=>['fetchdata', 'getOrders', 'statistics']]);
    }

    public function fetchdata(){
      $api_url = \env("ERP_API_URL", "");
      $api_input_json = \env("ERP_PARAM_JSON", "");
      $api_input = str_replace('"', '%22', $api_input_json);
      $api_url = $api_url + "?" + $api_input;
      print_r($api_url);exit;
      $curl = \curl_init();
      curl_setopt_array($curl, [
        CURLOPT_RETURNTRANSFER => 1,
        CURLOPT_URL => $api_url
      ]);
      $response_json = \curl_exec($curl);
      // $response_json = '[{"ReserveHeaderID":"07a966cf-94d8-4081-b20d-ab0c00437240","ProcessCode":"WS","CurrAccCode":"000997","ReserveNumber":"1-WS-3-69835","ReserveDate":"\/Date(1574283600000)\/","WarehouseCode":"MUH","CustomerName":"DENEME VADELİ","RemainingReserveQty":null,"CostofRemainigReserveQty":null},
      //                    {"ReserveHeaderID":"e0468a41-a070-46dd-b5df-ab0f0098e2b7","ProcessCode":"WS","CurrAccCode":"000997","ReserveNumber":"1-WS-3-70023","ReserveDate":"\/Date(1574542800000)\/","WarehouseCode":"MUH","CustomerName":"DENEME VADELİ","RemainingReserveQty":64,"CostofRemainigReserveQty":1314.1440000000002},
      //                    {"ReserveHeaderID":"e0468a22-a070-46dd-b5df-ab0f0098e2b7","ProcessCode":"WS","CurrAccCode":"000997","ReserveNumber":"1-WS-3-70023","ReserveDate":"\/Date(1574542800000)\/","WarehouseCode":"MUH","CustomerName":"DENEME VADELİ","RemainingReserveQty":64,"CostofRemainigReserveQty":1314.1440000000002},
      //                    {"ReserveHeaderID":"e0468a24-a070-46dd-b5df-ab0f0098e2b7","ProcessCode":"WS","CurrAccCode":"000997","ReserveNumber":"1-WS-3-70023","ReserveDate":"\/Date(1574542800000)\/","WarehouseCode":"MUH","CustomerName":"DENEME VADELİ","RemainingReserveQty":64,"CostofRemainigReserveQty":1314.1440000000002},
      //                    {"ReserveHeaderID":"e0468ae3-a070-46dd-b5df-ab0f0098e2b7","ProcessCode":"WS","CurrAccCode":"000997","ReserveNumber":"1-WS-3-70023","ReserveDate":"\/Date(1574542800000)\/","WarehouseCode":"MUH","CustomerName":"DENEME VADELİ","RemainingReserveQty":64,"CostofRemainigReserveQty":1314.1440000000002},
      //                    {"ReserveHeaderID":"e0468a3e-a070-46dd-b5df-ab0f0098e2b7","ProcessCode":"WS","CurrAccCode":"000997","ReserveNumber":"1-WS-3-70023","ReserveDate":"\/Date(1574542800000)\/","WarehouseCode":"MUH","CustomerName":"DENEME VADELİ","RemainingReserveQty":64,"CostofRemainigReserveQty":1314.1440000000002},
      //                    {"ReserveHeaderID":"e0468a66-a070-46dd-b5df-ab0f0098e2b7","ProcessCode":"WS","CurrAccCode":"000997","ReserveNumber":"1-WS-3-70023","ReserveDate":"\/Date(1574542800000)\/","WarehouseCode":"MUH","CustomerName":"DENEME VADELİ","RemainingReserveQty":64,"CostofRemainigReserveQty":1314.1440000000002},
      //                    {"ReserveHeaderID":"e0468a71-a070-46dd-b5df-ab0f0098e2b7","ProcessCode":"WS","CurrAccCode":"000997","ReserveNumber":"1-WS-3-70023","ReserveDate":"\/Date(1574542800000)\/","WarehouseCode":"MUH","CustomerName":"DENEME VADELİ","RemainingReserveQty":64,"CostofRemainigReserveQty":1314.1440000000002},
      //                    {"ReserveHeaderID":"e0468a99-a070-46dd-b5df-ab0f0098e2b7","ProcessCode":"WS","CurrAccCode":"000997","ReserveNumber":"1-WS-3-70023","ReserveDate":"\/Date(1574542800000)\/","WarehouseCode":"MUH","CustomerName":"DENEME VADELİ","RemainingReserveQty":64,"CostofRemainigReserveQty":1314.1440000000002},
      //                    {"ReserveHeaderID":"e0463441-a070-46dd-b5df-ab0f0098e2b7","ProcessCode":"WS","CurrAccCode":"000997","ReserveNumber":"1-WS-3-70023","ReserveDate":"\/Date(1574542800000)\/","WarehouseCode":"MUH","CustomerName":"DENEME VADELİ","RemainingReserveQty":64,"CostofRemainigReserveQty":1314.1440000000002},
      //                    {"ReserveHeaderID":"e046f341-a070-46dd-b5df-ab0f0098e2b7","ProcessCode":"WS","CurrAccCode":"000997","ReserveNumber":"1-WS-3-70023","ReserveDate":"\/Date(1574542800000)\/","WarehouseCode":"MUH","CustomerName":"DENEME VADELİ","RemainingReserveQty":64,"CostofRemainigReserveQty":1314.1440000000002},
      //                    {"ReserveHeaderID":"e00d8a41-a070-46dd-b5df-ab0f0098e2b7","ProcessCode":"WS","CurrAccCode":"000997","ReserveNumber":"1-WS-3-70023","ReserveDate":"\/Date(1574542800000)\/","WarehouseCode":"MUH","CustomerName":"DENEME VADELİ","RemainingReserveQty":64,"CostofRemainigReserveQty":1314.1440000000002},
      //                    {"ReserveHeaderID":"e0648a41-a070-46dd-b5df-ab0f0098e2b7","ProcessCode":"WS","CurrAccCode":"000997","ReserveNumber":"1-WS-3-70023","ReserveDate":"\/Date(1574542800000)\/","WarehouseCode":"MUH","CustomerName":"DENEME VADELİ","RemainingReserveQty":64,"CostofRemainigReserveQty":1314.1440000000002},
      //                    {"ReserveHeaderID":"b6f5aa7c-2b09-4f51-ac19-ab0f00b1ffb5","ProcessCode":"S","CurrAccCode":"M02","ReserveNumber":"1-S-3-40358","ReserveDate":"\/Date(1574542800000)\/","WarehouseCode":"MUH","CustomerName":"Avantaj","RemainingReserveQty":20,"CostofRemainigReserveQty":null}]';
      $response = \json_decode($response_json);
      $timestring = $response[0]->ReserveDate;
      list($timestamp) = sscanf($timestring, "/Date(%d)/");
      $datetime = date('Y-m-d H:i:s', $timestamp/1000);
      foreach($response as $val) {
        $exist = Order::where('reserve_header_id', $val->ReserveHeaderID)->count();
        if($exist) continue;
        $mdl_order = new Order();
        $mdl_order->reserve_header_id = $val->ReserveHeaderID;
        $mdl_order->process_code = $val->ProcessCode;
        $mdl_order->reserve_number = $val->ReserveNumber;
        $mdl_order->reserve_date = $datetime;
        $mdl_order->curr_acc_code = $val->CurrAccCode;
        $mdl_order->warehouse_code = $val->WarehouseCode;
        $mdl_order->customer_name = $val->CustomerName;
        $mdl_order->quantity = $val->RemainingReserveQty;
        $mdl_order->total_cost = $val->CostofRemainigReserveQty;
        $mdl_order->save();
      }
      return "success";
    }

    public function statistics(Request $request) {
      $now = new DateTime();
      $starttime = $now->format('Y-m-d 00:00:00');
      $endtime = $now->format('Y-m-d 23:59:59');
      $quantityToBePicked = DB::table('orders')
          ->where('reserve_date', '>=', $starttime)
          ->where('reserve_date', '<=', $endtime)
          ->sum('quantity');
      $costToBePicked = DB::table('orders')
          ->where('reserve_date', '>=', $starttime)
          ->where('reserve_date', '<=', $endtime)
          ->sum('total_cost');
      $quantityPickedUntilNow = DB::table('orders')
          ->where('reserve_date', '>=', $starttime)
          ->where('reserve_date', '<=', $endtime)
          ->whereNotNull('end_time')
          ->sum('quantity');
      $quantityRemaining = DB::table('orders')
          ->where('reserve_date', '>=', $starttime)
          ->where('reserve_date', '<=', $endtime)
          ->whereNull('end_time')
          ->sum('quantity');
      $remainingPercent = 'inf';
      if($quantityToBePicked != 0) {      
        $remainingPercent = $quantityRemaining / $quantityToBePicked * 100;
      }
      $earliestTime = DB::table('orders')
          ->where('reserve_date', '>=', $starttime)
          ->min('reserve_date');
      list($year, $month, $date, $hour, $minutes, $seconds) = \sscanf($earliestTime, "%d-%d-%d %d:%d:%d");
      $nowHour = $now->format('H');
      $elapsedHours = (int)$nowHour - $hour;
      if($elapsedHours == 0) $elapsedHours = 1;
      $quantityPickedPerHour = number_format($quantityPickedUntilNow / $elapsedHours, 1, ".", "");
      $totalElapsedTime = DB::table('orders')
          ->where('reserve_date', '>=', $starttime)
          ->where('reserve_date', '<=', $endtime)
          ->sum('elapsed_time');
      $totalPickCount = DB::table('orders')
          ->where('reserve_date', '>=', $starttime)
          ->where('reserve_date', '<=', $endtime)
          ->whereNotNull('end_time')
          ->count();
      $averageFinishTime = 'inf';
      if($totalPickCount != 0) {
        $averageFinishTime = round($totalElapsedTime / $totalPickCount);
      }

      $pickerInfoes = array();
      $pickers = Picker::paginate();
      foreach($pickers as $picker) {
        $picker_id = $picker->id;
        $totalQuantity = DB::table('orders')
          ->where('reserve_date', '>=', $starttime)
          ->where('reserve_date', '<=', $endtime)
          ->where('picker_id', '=', $picker_id)
          ->sum('quantity');
        $pickedQuanty = DB::table('orders')
          ->where('reserve_date', '>=', $starttime)
          ->where('reserve_date', '<=', $endtime)
          ->where('picker_id', '=', $picker_id)
          ->whereNotNull('end_time')
          ->sum('quantity');
        $currentlyPicking = DB::table('orders')
          ->where('reserve_date', '>=', $starttime)
          ->where('reserve_date', '<=', $endtime)
          ->where('picker_id', '=', $picker_id)
          ->whereNotNull('start_time')
          ->whereNull('end_time')
          ->sum('quantity');
        $remaining = DB::table('orders')
          ->where('reserve_date', '>=', $starttime)
          ->where('reserve_date', '<=', $endtime)
          ->where('picker_id', '=', $picker_id)
          ->whereNotNull('assign_time')
          ->whereNull('start_time')
          ->sum('quantity');
        $percentRemaining = 'inf';
        if($totalQuantity > 0){
          $percentRemaining = $remaining / $totalQuantity * 100;
        }
        $pickerData = [
          'name' => $picker->name,
          'totalQuantity' => $totalQuantity,
          'pickedQuanty' => $pickedQuanty,
          'currentlyPicking' => $currentlyPicking,
          'remaining' => $remaining,
          'percentRemaining' => $percentRemaining
        ];
        $pickerInfoes[$picker_id] = $pickerData;
      }

      $data = [
        'quantityToBePicked' => $quantityToBePicked,
        'costToBePicked' => $costToBePicked,
        'quantityPickedUntilNow' => $quantityPickedUntilNow,
        'quantityRemaining' => $quantityRemaining,
        'remainingPercent' => $remainingPercent,
        'quantityPickedPerHour' => $quantityPickedPerHour,
        'averageFinishTime' => $averageFinishTime,
        'pickerInfoes' => $pickerInfoes
      ];
      return view('dashboard', ['data' => $data, 'pickers'=>$pickers]);
    }

    public function assign(Request $request){

      $customer_name = $request->input('customer_name', '');
      $picker = $request->input('picker', '');
      $status = $request->input('status', 'all');
      $currPage = $request->input('curr_page', 0);
      if($picker != ''){
        $query = Order::join('pickers', 'pickers.id', '=', 'orders.picker_id')->where(function($q) use ($customer_name, $picker) {
          $q->where('customer_name', 'LIKE', '%'.$customer_name.'%');
          $q->orWhere('pickers.name', 'LIKE', '%'.$picker.'%');
        });
      } else {
        $query = Order::where(function($q) use ($customer_name, $picker) {
          $q->where('customer_name', 'LIKE', '%'.$customer_name.'%');
        });
      }
      switch($status) {
        case 'not_assigned':
          $query = $query->whereNull('picker_id');
          break;
        case 'not_started':
          $query = $query->whereNotNull('picker_id')->whereNull('start_time');
          break;
        case 'picking':
          $query = $query->whereNotNull('start_time')->whereNull('end_time');
          break;
        case 'finished':
          $query = $query->whereNotNull('end_time');
          break;
      }
    //  print_r($query->toSql());exit;
      $pickers = Picker::all();
      $data = [
        'customer_name' => $customer_name,
        'picker' => $picker,
        'status' => $status,
        'pickers' => $pickers,
      ];
      $records = $query->paginate(config('perPage', 10));
      return view('assign', ['records' => $records, 'data' => $data]);
    }

    public function getOrders(Request $request){
      $customer_name = $request->input('customer_name', '');
      $picker = $request->input('picker', '');
      $status = $request->input('status', 'all');
      $currPage = $request->input('curr_page', 0);
      if($picker != ''){
        $query = Order::join('pickers', 'pickers.id', '=', 'orders.picker_id')->where(function($q) use ($customer_name, $picker) {
          $q->where('customer_name', 'LIKE', '%'.$customer_name.'%');
          $q->orWhere('pickers.name', 'LIKE', '%'.$picker.'%');
        });
      } else {
        $query = Order::where(function($q) use ($customer_name, $picker) {
          $q->where('customer_name', 'LIKE', '%'.$customer_name.'%');
        });
      }
      switch($status) {
        case 'not_assigned':
          $query = $query->whereNull('picker_id');
          break;
        case 'not_started':
          $query = $query->whereNotNull('picker_id')->whereNull('start_time');
          break;
        case 'picking':
          $query = $query->whereNotNull('start_time')->whereNull('end_time');
          break;
        case 'finished':
          $query = $query->whereNotNull('end_time');
          break;
      }
      $data = [
        'customer_name' => $customer_name,
        'picker' => $picker,
        'status' => $status,
      ];
      $records = $query->paginate(config('perPage', 10));
      return view('orders', ['records' => $records, 'data' => $data]);
    }

    public function setInterval(Request $request) {
      $interval = $request->input('interval');

      Session::put('update_interval', $interval);
      return response()->json(['interval' => Session::get('update_interval')]);
    }

    public function editOrder(Request $request) {
      $id = $request->input('id');
      $picker_id = $request->input('picker_id');
      $mdl_order = Order::find($id);
      $mdl_order->picker_id = $picker_id;
      $now = new DateTime();
      $datetime = $now->format('Y-m-d H:i:s');
      $mdl_order->assign_time = $datetime;
      $mdl_order->save();
      return redirect()->back();
    }
}
