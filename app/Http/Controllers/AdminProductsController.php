<?php

namespace App\Http\Controllers;

use App\Components\Recusive;
use App\Models\Category;
use Illuminate\Http\Request;

class AdminProductsController extends Controller
{
    private $category;
    public function __construct(Category $category)
    {
        $this->category = $category;
    }

    public function index(){
        return(view('admin.products.index'));
    }
    public function create(){
        $htmlOption = $this->getCategory($parent_id = '');
        return(view('admin.products.add', compact('htmlOption')));
    }
    public function getCategory($parent_id){
        $data = $this->category->all();
        $recusive = new Recusive($data);
        $htmlOption = $recusive->categoryRecusive($parent_id);
        return $htmlOption; // ok
    }
}
