<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;
    protected $guarded=[];
    public function images(){
        return $this->hasMany(ProductImages::class, 'product_id');
    }
    // eloquent relationship: many to many:
    public function tags() {
        return $this
            ->belongsToMany(Tag::class, 'product_tags', 'product_id', 'tag_id')
            ->withTimestamps();
    }
    // Thiết lập quan hệ 1 nhiều :: 1 Category có nhiều products;
    public function category() {
        return $this->belongsTo(Category::class, 'category_id');
    }

    // Thiết lập phương thức lấy dữ liệu: productimage:
    public function productImages() {
        return $this->hasMany(ProductImages::class, 'product_id');
    }



}
