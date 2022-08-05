<?php

//interface TaskRepository TaskRepository.php
namespace App\Repository;
use App\Permit;
use App\Permit_date;

class PermitRepository{

  public function getAll(){
    $permits = Permit::join('permit_date','permit_date.permit_id', '=', 'permit.id')
    ->join('users', 'users.id', '=', 'permit.user_id')
    ->select('users.name','permit.*', 'permit_date.*')
    ->orderBy('permit.created_at', 'DESC')->get();

    return $permits;
  }

  public function getById($id){
    $permit = Permit::join('permit_date','permit_date.permit_id', '=', 'permit.id')
    ->join('users', 'users.id', '=', 'permit.user_id')
    ->select('users.name','permit.*', 'permit_date.*')
    ->where('permit.id',$id)->get();
    return $permit;
  }
    /*
    public function updateTask(Request $request, $id)
    {
       $task = Task::whereId($id)->first();
        if ($task != null) {
            $task->update([
                'name' => $request->name,
                'description' => $request->description,
            ]);
            return $task;
        }
        return null;
    }
    */
}
