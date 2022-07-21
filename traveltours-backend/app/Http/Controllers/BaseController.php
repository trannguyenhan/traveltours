<?php

namespace App\Http\Controllers;

use App\Http\Requests\Base\IdRequest;
use Illuminate\Http\Request;

class BaseController extends Controller
{
    /**
     * @param Request $request
     * @return mixed
     */
    public function listing(Request $request)
    {
        $keyword = $request->query('keyword');
        $page = $this->getPage($request);
        $pageSize = $this->getPageSize($request);
        $orderType = $this->getOrderTypes($request);
        $orderBy = $this->getSortBy($request);

        $filter = [];

        return $this->repository->doList($keyword, $page, $pageSize, $orderBy, $orderType, $filter);
    }

    public function detail(Request $request, $id)
    {
        return $this->repository->detail($id);
    }

    /**
     * Get list sort key
     * @param $request
     * @return array
     */
    protected function getSortBy($request): array
    {
        $orderBy = [];
        if ($request->query('sort_by') != null) {
            if (is_array($request->query('sort_by'))) {
                $orderBy = $request->query('sort_by');
            } else {
                $orderBy = [$request->query('sort_by')];
            }
        }

        return $orderBy;
    }

    /**
     * Get list sort type, default is asc
     * @param $request
     * @return array|string[]
     */
    protected function getOrderTypes($request): array
    {
        $orderType = [];
        if ($request->query('desc') != null) {
            if (is_array($request->query('desc'))) {
                $orderType = array_map(function ($e) {
                    return (($e === true || $e === "true") ? 'desc' : 'asc');
                }, $request->query('desc'));
            } else {
                $orderType = [($request->query('desc') === 'true' || $request->query('desc') === true) ? 'desc' : 'asc'];
            }
        }
        return $orderType;
    }

    /**
     * Current page, default is 1
     * @param $request
     * @return int
     */
    protected function getPage($request): int
    {
        $page = $request->query('page') != null ? intval($request->query('page')) : 1;
        if ($page < 1) {
            $page = 1;
        }
        return $page;
    }

    /**
     * Number of item in page, default is 10
     * @param $request
     * @return int
     */
    protected function getPageSize($request): int
    {
        return $request->query('page_size') != null ? intval($request->query('page_size')) : 10;
    }
}
