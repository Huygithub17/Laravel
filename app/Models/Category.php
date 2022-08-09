<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = ['name', 'parent_id', 'slug'];
}

//Thêm các dòng kia để có thể chỉnh sửa được dữ liệu;
//Thêm Softdelete để thực hiện được xóa mềm;
