<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ContestComment extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = 'contests_comments';
    protected $fillable = [
        'name',
        'comment',
        'status',
        'parent',
        'contest_id',
        'user_id',
        'comment_stars',
    ];

    public function user(){
        return $this->belongsTomany(User::class,'users');
    }

    public function contest(){
        return $this->belongsTo(Contest::class,'contest_id');
    }
    public function children() {
        return $this->hasMany(ContestComment::class, 'parent', 'id');
    }
}
