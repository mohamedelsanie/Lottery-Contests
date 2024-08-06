<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;

class Contest extends Model implements TranslatableContract
{
    use HasFactory;
    use SoftDeletes;
    use Translatable;

    public $translatedAttributes = ['title', 'content', 'description', 'label_text', 'to_place'];

    protected $fillable = [
        'slug',
        'image',
        'from_date',
        'to_date',
        'price',
        'label_color',
        'status',
        'contest_type_id',
        'comments_status',
        'num_of',
        'admin_id',
    ];

    public function admin(){
        return $this->belongsTomany(Admin::class,'admins');
    }

    public function category(){
        return $this->belongsTo(ContestTypes::class,'contest_type_id');
    }

}
