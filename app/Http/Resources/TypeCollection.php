<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class TypeCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
//        return parent::toArray($request);
        return [
            'data'=>$this->collection->transform(function ($type){
                return [
                  'id'=>$type->id,
                  'name'=>$type->name,
                  'sort'=>$type->sort
                ];
            })
        ];
    }
}
