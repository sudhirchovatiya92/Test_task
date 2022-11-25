<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class APIController extends Controller
{
    //
    public function add_money(Request $request){
       
        try{
            $validation_rule=[
                "amount" => ["required","min:3","max:100","numeric","regex:/^[0-9]*(\.[0-9]{0,2})?$/"]
            ];
            
            $validator = Validator::make($request->json()->all(), $validation_rule);
            if ($validator->fails()) {
                
                $error_msg="The request could not be understood by the server due to malformed syntax";
                $response = array();
                $response['status'] = 0;
                $response['msg'] = $error_msg;
                $response['statuscode'] = 400;
                $response['data'] = $validator->errors();
                Log::error($error_msg);
                
    
            } else {
               
                DB::table('users')->whereId(Auth::id())->increment('wallet',$request->input('amount'));
                
                $response = array();
                $response['status'] = 1;
                $response['msg'] = "Money added successfully";
                $response['statuscode'] = 200;
                
            }
        }catch (\Exception $ex){
                $response = array();
                $response['status'] = 0;
                $response['msg'] = $ex->getMessage();
                $response['statuscode'] = 400;
                Log::error($ex->getMessage());
        }

		return response()->json($response)->header('Content-Type', 'application/json');
    }

    public function buy_cookie(Request $request){
        
        try{
            $validation_rule=[
                "qty" => "required|numeric|min:1"
            ];
            
            $validator = Validator::make($request->json()->all(), $validation_rule);
            if ($validator->fails()) {
    
                $error_msg="The request could not be understood by the server due to malformed syntax";
                $response = array();
                $response['status'] = 0;
                $response['msg'] = $error_msg;
                $response['statuscode'] = 400;
                $response['data'] = $validator->errors();
                Log::error($error_msg);
    
            } else {
               
                $qty=$request->input('qty');
                if($qty > Auth::user()->wallet){
                    $response = array();
                    $response['status'] = 0;
                    $response['msg'] = "Insufficient wallet balance";
                    $response['statuscode'] = 400;
                    Log::error("Insufficient wallet balance");
                }else{
                    DB::table('users')->whereId(Auth::id())->decrement('wallet',$request->input('qty'));
                
                $response = array();
                $response['status'] = 1;
                $response['msg'] = "Cookie purchased successfully";
                $response['statuscode'] = 200;
                }
                
            }
        }catch (\Exception $ex){
                $response = array();
                $response['status'] = 0;
                $response['msg'] = $ex->getMessage();
                $response['statuscode'] = 400;
                Log::error($ex->getMessage());
        }

		return response()->json($response)->header('Content-Type', 'application/json');
		
		

		return response()->json($response)->header('Content-Type', 'application/json');
    }
    
}
