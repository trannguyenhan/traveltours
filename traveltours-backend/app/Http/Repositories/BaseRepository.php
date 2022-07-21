<?php

namespace App\Http\Repositories;

use App\Models\User;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

abstract class BaseRepository
{
    protected $_model;
    protected $_relationships = [];
    protected $modelName;

    /**
     * Return model will use in repository
     * \App\Models\Name::class
     * @return string
     */
    abstract public function getModel(): string;

    /**
     * @throws BindingResolutionException
     */
    public function __construct()
    {
        $this->_model = app()->make($this->getModel());
        $tableName = (new $this->_model)->getTable(); // ex: pages, sub_pages, attributes
        $this->modelName = Str::singular($tableName); // ex: page, sub_page, attribute
    }

    /**
     * @param $keyword
     * @param $page
     * @param $pageSize
     * @param array $orderBy
     * @param array $orderType
     * @param $filter
     * @return JsonResponse
     */
    public function doList($keyword,
                           $page,
                           $pageSize,
                           $orderBy = ['created_at'],
                           $orderType = ['desc'],
                           $filter): JsonResponse
    {
        $query = (new $this->_model)->query(); // create new query

        $query = $this->search($query, $keyword);
        $total = $query->count();

        $query = $query->skip(($page-1) * $pageSize)->take($pageSize);

        $cnt = 0;
        $lengthType = count($orderType);
        foreach ($orderBy as $key){
            if(Schema::hasColumn($this->_model->getTable(), $key)){
                if($cnt < $lengthType){
                    $query->orderBy($key, $orderType[$cnt]);
                } else {
                    $query->orderBy($key, 'asc');
                }
            }
            $cnt++;
        }

        $query = $this->relationships($query);
        $result = $this->modifyResult($query->get()->toArray());

        return \App\Helper::successResponseList($result, $total);
    }

    public function detail($id): JsonResponse
    {
        $query = (new $this->_model)->query(); // create new query
        $query = $this->relationships($query);
        $modelDetail = $query->find($id);

        return \App\Helper::successResponse($modelDetail);
    }

    // filter by keyword
    public function search($query, $keyword){
        if($keyword == null) {
            return $query;
        }

        return $query->where('name', 'LIKE', "%$keyword%");
    }

    // override if modify response content
    // suggest: use for in array
    public function modifyResult($collection){
        return $collection;
    }

    // get with relationships
    public function relationships($query){
        if(count($this->_relationships) != 0){
            foreach ($this->_relationships as $relationship){
                $query = $query->with($relationship);
            }
        }

        return $query;
    }

    /**
     * @param $arr
     * @return JsonResponse
     */
    public function doStore($arr): JsonResponse
    {
        $model = new $this->_model;

        $model->fill($arr);
        if($model->save()){
            return \App\Helper::successResponse($model);
        } else {
            return \App\Helper::errorResponse();
        }
    }

    /**
     * @param $arr
     * @return JsonResponse
     */
    public function doUpdate($arr): JsonResponse
    {
        $class = get_class($this->_model);
        $id = defined("$class::PRIMARY_KEY")? $arr[$class::PRIMARY_KEY] : $arr['id'];

        $model = $this->_model->query()->find($id);

        if($model != null){
            $model->fill($arr);
            if($model->save()){
                return \App\Helper::successResponse($model);
            }
        }

        return \App\Helper::errorResponse("update fail!");
    }

    /**
     * @param $id
     * @return JsonResponse
     * @throws ValidationException
     */
    public function doDelete($id): JsonResponse
    {
        if($id == auth()->id() && $this->_model instanceof User){
            throw ValidationException::withMessages([
                'user' => 'Không thể tự xóa tài khoản của mình'
            ]);
        }

        $model = (new $this->_model)->query()->find($id);

        if($model != null && $model->deleted_at == null){
            if($model->delete()){
                return \App\Helper::successResponse("Delete successfully!");
            } else {
                return \App\Helper::errorResponse("Delete error!");
            }
        }

        return \App\Helper::errorResponse("Object not exists!");
    }

    /**
     * Multi delete with list id
     * @param $ids
     * @return JsonResponse
     * @throws ValidationException
     */
    public function doMultiDelete($ids): JsonResponse
    {
        DB::beginTransaction();

        foreach ($ids as $id){
            if($id == auth()->id() && $this->_model instanceof User){
                DB::rollBack();
                throw ValidationException::withMessages([
                    'message' => 'Không thể tự xóa tài khoản của mình'
                ]);
            }

            $model = (new $this->_model)->query()->find($id); // find object
            if($model != null && $model->deleted_at == null){
                if(!$model->delete()){
                    DB::rollBack();
                    return \App\Helper::errorResponse("Delete error");
                }

            } // pass if not find object
        }

        DB::commit();
        return \App\Helper::successResponse("Delete success!");
    }

    /**
     * @param $arrs
     * @return JsonResponse
     */
    public function doMultiStore($arrs): JsonResponse
    {
        DB::beginTransaction();

        $data = [];
        $cnt = 0;
        foreach ($arrs as $arr){
            $cnt++;
            $model = new $this->_model;

            $model->fill($arr);
            if(!$model->save()){
                return \App\Helper::errorResponse("Store error");
            }

            $data[] = $model->toArray();
        }

        DB::commit();
        return \App\Helper::successResponse($data);
    }

    /**
     * @param $arrs
     * @return JsonResponse
     */
    public function doMultiUpdate($arrs): JsonResponse
    {
        DB::beginTransaction();

        $data = [];
        foreach ($arrs as $arr){
            $id = $arr['id'];

            $model = (new $this->_model)->query()->find($id);
            if($model != null){
                $model->fill($arr);
                if(!$model->save()){
                    return \App\Helper::errorResponse("Update error");
                }

                $data[] = $model;
            }
        }

        DB::commit();
        return \App\Helper::successResponse($data);
    }
}
