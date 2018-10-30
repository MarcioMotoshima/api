<?php
/**
 * Created by PhpStorm.
 * User: marcelmelo
 * Date: 10/29/18
 * Time: 10:23 PM
 */

namespace App\Traits;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Validator;

trait ApiResponser{

    private function successResponse($data, $code){
        return response()->json($data, $code);
    }

    protected function errorResponse($message, $code){
        return response()->json(array(
            'error' => $message,
            'code' => $code
        ), $code);
    }

    protected function printData($message, $code = 200){
        return response()->json(array(
            'data' => $message,
            'code' => $code
        ), $code);
    }

    protected function printAll(Collection $collection, $code = 200){

        if($collection->isEmpty()){
            return $this->successResponse(array('data' => $collection), $code);
        };

        $collection = $this->paginate($collection);
        return $this->successResponse($collection, $code);
    }

    protected function printSingle(Model $model, $code=200){
        return $this->successResponse(array(
            'data' => $model,
        ), $code);
    }

    protected function paginate(Collection $collection){

        $rules = [
            'per_page' => 'integer|min:2|max:50',
        ];
        Validator::validate(request()->all(), $rules);

        $page = LengthAwarePaginator::resolveCurrentPage();
        $perPage = 15;

        if(request()->has('per_page')){
            $perPage = (int) request()->per_page;
        };

        $results = $collection->slice( ($page - 1) * $perPage, $perPage )->values();

        $paginated = new LengthAwarePaginator($results, $collection->count(), $perPage, $page, [
            'path' => LengthAwarePaginator::resolveCurrentPath(),
        ]);

        $paginated->appends( request()->all());

        return $paginated;
    }

    protected function cacherResponse($data){
        $url = request()->url();

        $queryParams = request()->query();
        ksort($queryParams);
        $queryString = http_build_query($queryParams);
        $fullUrl = "{$url}?{$queryString}";


        return Cache::remember($fullUrl, 30/60, function () use($data){
            return $data;
        });
    }

}