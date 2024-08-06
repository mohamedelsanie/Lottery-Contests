<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = [
        'title',
        'name',
        'phone',
        'adress',
        'contest_id',
        'user_name',
        'img',
        'invoice_id',
        'win_type',
        'fin_price',
        'user_id',
        'status',
    ];

    public function contest(){
        return $this->belongsTo(Contest::class,'contest_id');
    }
    
    public function Win()
    {
        if($this->win_type == "winner"){
            return "فائز";
        }else{
            return "خاسر";
        }
    }
    
    public function St()
    {
        if($this->status == "payed"){
            return "مدفوع";
        }elseif($this->status == "not_payed"){
            return "غير مدفوع";
        }else{
            return "ملغى";
        }
    }

}
