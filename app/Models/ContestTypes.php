<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\SoftDeletes;

class ContestTypes extends Model implements TranslatableContract
{
    use HasFactory;
    use SoftDeletes;
    use Translatable;
    protected $table = 'contest_types';
    public $translatedAttributes = ['title', 'descraption'];

    protected $fillable = [
        'slug',
        'parent',
        'img',
        'status',
    ];
    protected $translationForeignKey = 'contest_type_id';

    public function parents(){
        return $this->belongsTo(ContestTypes::class,'parent');
    }

    public function childs(){
        return $this->hasMany(ContestTypes::class,'parent');
    }

    public static function tree(){
        $allCategories = ContestTypes::get();
        $rootCategories = $allCategories->where('parent','0');
        self::formatTree($rootCategories, $allCategories);
        return $rootCategories;
    }

    private static function formatTree($categories, $allCategories){
        foreach ($categories as $category) {
            $category->children = $allCategories->where('parent', $category->id)->values();
            if ($category->children->isNotEmpty()) {
                self::formatTree($category->children, $allCategories);
            }
        }
    }

    public function isChild(): bool
    {
        return $this->parent_id !== null;
    }

}
