<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected $repository;

    /**
     * @param $request
     * @param $storeFields
     * @return mixed
     */
    public function storeTemplate($request, $storeFields){
        $arr = $request->only($storeFields);
        return $this->repository->doStore($arr);
    }

    /**
     * @param $request
     * @param $updateFields
     * @return mixed
     */
    public function updateTemplate($request, $updateFields){
        $arr = $request->only($updateFields);
        return $this->repository->doUpdate($arr);
    }

    /**
     * Delete object with id, override method if you want to delete with other attribute
     * @param $request
     * @return mixed
     */
    public function deleteTemplate($request){
        $id = $request->input('id');
        return $this->repository->doDelete($id);
    }
}
