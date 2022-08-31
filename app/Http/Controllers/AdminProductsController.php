<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductAddRequest;
use App\Models\Product;
use App\Models\ProductImages;
use App\Models\ProductTag;
use App\Models\Tag;
use App\Traits\DeleteModelTrait;
use App\Traits\StorageImageTrait;

use App\Components\Recusive;
use App\Models\Category;
use Illuminate\Http\Request;
use Log;
use Storage;
use DB;


class AdminProductsController extends Controller
{
    use StorageImageTrait;
    use DeleteModelTrait;
    private $category;
    private $product;
    private $productImages;
    private $tag;
    private $productTag;
    public function __construct(Category $category, Product $product, ProductImages $productImages, Tag $tag, ProductTag $productTag)
    {
        $this->category = $category;
        $this->product = $product;
        $this->productImages = $productImages;
        $this->tag = $tag;
        $this->productTag = $productTag;
    }
    public function index(){
        $products = $this->product->latest()->paginate(5);
        return view('admin.products.index', compact('products'));
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
    public function store(ProductAddRequest $request){

        try{
            DB::beginTransaction();  // Vẫn không hoạt động: product vẫn được thêm mặc dù quá trình lỗi => sử lý sau:
            $dataProductCreate = [
                'name' => $request->name,
                'price' => $request->price,
                'content' => $request->contents,
                'user_id' => auth()->id(),
                'category_id' => $request->category_id
            ];
            $dataUploadFeatureImage = $this->storageTraitUpload($request, 'feature_image_path', 'product');
            if (!empty($dataUploadFeatureImage)) {
                $dataProductCreate['feature_image_name'] = $dataUploadFeatureImage['file_name'];
                $dataProductCreate['feature_image_path'] = $dataUploadFeatureImage['file_path'];
            }
            $product = $this->product->create($dataProductCreate);
            // Insert data to product_images
            if ($request->hasFile('image_path')) {
                foreach ($request->image_path as $fileItem) {
                    $dataProductImageDetail = $this->storageTraitUploadMultiple($fileItem, 'product');
                    $product->images()->create([
                        'image_path' => $dataProductImageDetail['file_path'],
                        'image_name' => $dataProductImageDetail['file_name']
                    ]);
                }
            }
            // Insert tags for product

            if (!empty($request->tags)) {
                foreach ($request->tags as $tagItem) {
                    // Insert to tags
                    $tagInstance = $this->tag->firstOrCreate(['name' => $tagItem]);
                    $tagIds[] = $tagInstance->id;
                }
                $product->tags()->attach($tagIds);  // có thì mới attach, không thì thôi.
            }

            DB::commit();
            return redirect()->route('products.index');

        } catch (\Exception $exception) {
            DB::rollBack();
            Log::error('Message: ' . $exception->getMessage() . ' --- Line : ' . $exception->getLine()); // có xuất được lỗi mà không rollback được;
        }
    }

    public function edit($id){
        $product = $this->product->find($id);

        //Test eloquent:
        /*DB::connection()->enableQueryLog();
        $product->productImages;
        $queries = DB::getQueryLog();
        dd($queries);*/


        $htmlOption = $this->getCategory($product->category_id);
        return view('admin.products.edit', compact('htmlOption','product'));
    }
    public function update(Request $request, $id){
        // đã thành công phần update: 16/08/2022
        try{
            DB::beginTransaction();  // Vẫn không hoạt động: product vẫn được thêm mặc dù quá trình lỗi => sử lý sau:
            $dataProductUpdate = [
                'name' => $request->name,
                'price' => $request->price,
                'content' => $request->contents,
                'user_id' => auth()->id(),
                'category_id' => $request->category_id
            ];
            $dataUploadFeatureImage = $this->storageTraitUpload($request, 'feature_image_path', 'product');
            if (!empty($dataUploadFeatureImage)) {
                $dataProductUpdate['feature_image_name'] = $dataUploadFeatureImage['file_name'];
                $dataProductUpdate['feature_image_path'] = $dataUploadFeatureImage['file_path'];
            }
            $this->product->find($id)->update($dataProductUpdate); // trả về giá trị true/false
            $product = $this->product->find($id);  //ok

            // Update data to product_images
            if ($request->hasFile('image_path')) {
                $this->productImages->where('product_id', $id)->delete(); // xóa trước khi update
                foreach ($request->image_path as $fileItem) {
                    $dataProductImageDetail = $this->storageTraitUploadMultiple($fileItem, 'product');
                    $product->images()->create([
                        'image_path' => $dataProductImageDetail['file_path'],
                        'image_name' => $dataProductImageDetail['file_name']
                    ]);
                }
            }
            // Update tags for product
            $tagIds = [];
            if (!empty($request->tags)) {
                foreach ($request->tags as $tagItem) {
                    // Insert to tags
                    $tagInstance = $this->tag->firstOrCreate(['name' => $tagItem]);
                    $tagIds[] = $tagInstance->id;
                }
            }
            $product->tags()->sync($tagIds);// tính năng đồng bộ, nếu đã có tags rồi thì giữ nguyên, còn không thì thêm mới.

            DB::commit();
            return redirect()->route('products.index');

        } catch (\Exception $exception) {
            DB::rollBack();
            Log::error('Message: ' . $exception->getMessage() . ' --- Line : ' . $exception->getLine()); // có xuất được lỗi mà không rollback được;
        }
    }
    // Tối ưu code : Traits: ok
    public function delete($id){
        return $this->deleteModelTrait($id, $this->product);
    }
}
