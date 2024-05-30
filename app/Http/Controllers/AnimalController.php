<?php

namespace App\Http\Controllers;

use App\Models\Animal;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Cache;
class AnimalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //查詢關鍵字
        $query = Animal::query();
        $limit=$request->limit ?? 10;

        if (isset($request->filters)){
            $filters = explode(',',$request->filters);
            foreach ($filters as $key=>$filter){
                list($key,$value) = explode(':',$filter);
                $query->where($key,'like','%'.$value.'%');
            }
        }
        //查詢資源列表::  需要優化分頁機制
//        $animals=Animal::get();
//        return \response(['data'=>$animals],Response::HTTP_OK);


        //資源列表排序
        if (isset($request->sorts)){
            $sorts = explode(',',$request->sorts);
            foreach ($sorts as $key=>$sort){
                list($key,$value) = explode(':',$sort);
                if ($value=='asc' || $value=='desc'){
                    $query->orderBy($key,$value);
                }else{
                    $query->orderBy('id','desc');
                }
            }

        }
        $url=$request->url();
        $queryParams=$request->query();
        Ksort($queryParams);
        $queryString=http_build_query($queryParams);
        $fullUrl="{$url}?{$queryString}";
        if (Cache::has($fullUrl)){
            return Cache::get($fullUrl);
        }
        $animals=$query->paginate($limit)->appends($request->query());
        return Cache::remember($fullUrl,60,function ()use($animals){
            return \response($animals,Response::HTTP_OK);
        });
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
        //
        $animal=Animal::create($request->all());
        $animal=$animal->refresh();
        return \response($animal,Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Animal  $animal
     * @return \Illuminate\Http\Response
     */
    public function show(Animal $animal)
    {
        //查詢單一資源
        return \response($animal,Response::HTTP_OK);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Animal  $animal
     * @return \Illuminate\Http\Response
     */
    public function edit(Animal $animal)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Animal  $animal
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Animal $animal)
    {
        //
        $animal->update($request->all());
        return \response($animal,Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Animal  $animal
     * @return \Illuminate\Http\Response
     */
    public function destroy(Animal $animal)
    {
        //
        $animal->delete();
        return \response(null,Response::HTTP_NO_CONTENT);
    }
}
