<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
class Animal extends Model
{
    use HasFactory;
    /**
     * 可以被批量賦值的屬性。
     *
     * @var array
     */
    protected $fillable = [
        'type_id',
        'name',
        'birthday',
        'area',
        'fix',
        'description',
        'personality',
    ];
    public function type(){
        return $this->belongsTo('App\Models\Type');
    }
    public function getAgeAttribute(){
        $diff=Carbon::now()->diff($this->birthday);
        return "{$diff->y}歲 {$diff->m}月";
    }
}
