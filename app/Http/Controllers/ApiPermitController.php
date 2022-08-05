<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Permit_date;
use App\Permit;
use App\Http\Requests\PermitStoreRequest;
use App\Http\Requests\PermitGetDetailRequest;
use App\Repository\PermitRepository;
use Illuminate\Support\Facades\Validator;

class ApiPermitController extends Controller
{

    public function store(PermitStoreRequest $request){
       // form validation
        //$validated = $request->validated();
        
        $validator = Validator::make($request->all(), [
          'user_id'   => 'required|numeric',
          'type'      => 'required|in:full time,part time',
          'desc'      => 'required',
          'status'      => 'required|in:pending,approved'
        ]);

        $permit = Permit::create([
                'user_id' => $request->user_id,
                'type' => $request->type,
                'desc' => $request->desc,
                'status' => $request->status
            ]);
        $permit_id = $permit->id;

        $permit_dates = $request->permit_date;
        if(is_numeric($permit_id) AND !empty($permit_dates)){
            foreach($permit_dates as $key => $permit_date){
                $pd_date = $permit_date['date'];
                $pd_start = $permit_date['start_at'];
                $pd_end = $permit_date['end_at'];
                $pd_create = Permit_date::create([
                  'permit_id' => $permit_id,
                  'date' => $pd_date,
                  'start_at' => $pd_start,
                  'end_at' => $pd_end
                ]);
              }
            }
        $res['message'] = "Success!";
        $res['values'] = $permit_id;
        return response($res);
    }

    public function index(){
      $repo = new PermitRepository();
      $permits = $repo->getAll();

      if(count($permits) > 0){
            $res['message'] = "Success!";
            $res['values'] = $permits;
        }else{
            $res['message'] = "Empty!";
        }
        return response($res);
    }

    public function detail(Request $request){
      $id = $request->id;
      if(!empty($id) && is_numeric($id)){
        $repo = new PermitRepository();
        $permit = $repo->getById($id);
        if(count($permit) > 0){
          $res['message'] = "Success!";
          $res['values'] = $permit;
        }else{
          $res['message'] = "data is empty!";
        }
      }else{
          $res['message'] = "data is not valid!";
      }
      return response($res);
    }
}
