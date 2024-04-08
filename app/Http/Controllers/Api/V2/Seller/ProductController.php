<?php

namespace App\Http\Controllers\Api\V2\Seller;

use App\Http\Requests\ProductRequest;
use App\Http\Resources\V2\Seller\AttributeCollection;
use App\Http\Resources\V2\Seller\BrandCollection;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

use App\Http\Resources\V2\Seller\CategoriesCollection;
use App\Http\Resources\V2\Seller\ColorCollection;
use App\Http\Resources\V2\Seller\ProductCollection;
use App\Http\Resources\V2\Seller\ProductDetailsCollection;
use App\Http\Resources\V2\Seller\ProductReviewCollection;
use App\Http\Resources\V2\Seller\TaxCollection;
use App\Models\Attribute;
use App\Models\Brand;
use App\Models\Cart;
use App\Models\Category;
use App\Models\Color;
use App\Models\Product;
use App\Models\ProductTax;
use App\Models\ProductTranslation;
use App\Models\Review;
use App\Models\Tax;
use Artisan;

use App\Services\ProductFlashDealService;
use App\Services\ProductService;
use App\Services\ProductStockService;
use App\Services\ProductTaxService;

class ProductController extends Controller
{
    protected $productService;
    protected $productTaxService;
    protected $productFlashDealService;
    protected $productStockService;

    public function __construct(
        ProductService $productService,
        ProductTaxService $productTaxService,
        ProductFlashDealService $productFlashDealService,
        ProductStockService $productStockService
    ) {
        $this->productService = $productService;
        $this->productTaxService = $productTaxService;
        $this->productFlashDealService = $productFlashDealService;
        $this->productStockService = $productStockService;
    }

    public function index()
    {
        $products = Product::with('category')->where('user_id', auth()->user()->id)->paginate(10);
        return new ProductCollection($products);
    }

    public function getCategory(){
        $categories = Category::where('parent_id', 0)
        ->where('digital', 0)
        ->with('childrenCategories')
        ->get();
        return CategoriesCollection::collection($categories);
    }

    public function getBrands(){
        $brands = Brand::all();

        return BrandCollection::collection($brands);

    }
    public function getTaxes(){
        $taxes =Tax::where('tax_status', 1)->get();

        return TaxCollection::collection($taxes);

    }
    public function getAttributes(){
        $attributes =Attribute::with('attribute_values')->get();

        return AttributeCollection::collection($attributes);

    }    
    public function getColors(){
        $colors =Color::orderBy('name', 'asc')->get();

        return ColorCollection::collection($colors);

    }


    public function store(ProductRequest $request)
    {
        if (addon_is_activated('seller_subscription')) {
            if (!seller_package_validity_check(auth()->user()->id)) {
                return $this->failed(translate('Please upgrade your package.'));
            }
        }

        if(auth()->user()->user_type != 'seller'){
            return $this->failed(translate('Unauthenticated User.'));
        }

        $request->merge(['added_by' => 'seller']);
        $product = $this->productService->store($request->except([
            '_token', 'sku', 'choice', 'tax_id', 'tax', 'tax_type', 'flash_deal_id', 'flash_discount', 'flash_discount_type'
        ]));
        $request->merge(['product_id' => $product->id]);
        
        //VAT & Tax
        if($request->tax_id) {
            $this->productTaxService->store($request->only([
                'tax_id', 'tax', 'tax_type', 'product_id'
            ]));
        }

        //Product Stock
        $this->productStockService->store($request->only([
            'colors_active', 'colors', 'choice_no', 'unit_price', 'sku', 'current_stock', 'product_id'
        ]), $product);

        // Product Translations
        $request->merge(['lang' => env('DEFAULT_LANGUAGE')]);
        ProductTranslation::create($request->only([
            'lang', 'name', 'unit', 'description', 'product_id'
        ]));

        return $this->success(translate('Product has been inserted successfully'));
    }

    public function edit(Request $request, $id)
    {
        
        if(auth()->user()->user_type != 'seller'){
            return $this->failed(translate('Unauthenticated User.'));
        }

        $product = Product::where('id',$id)->with('stocks')->first();

        if (auth()->user()->id != $product->user_id) {
            return $this->failed(translate('This product is not yours.'));
        }
        $product->lang =  $request->lang==null?env("DEFAULT_LANGUAGE"):$request->lang;

        return new ProductDetailsCollection($product);
       /* $data = response()->json([
            'lang'          => $lang,
            'product'       => $product,
            'product_name'  => $product->getTranslation('name',$lang),
            'product_unit'  => $product->getTranslation('unit',$lang),
            'description'   => $product->getTranslation('description',$lang),
        ]);
        return $data;*/
    }

    public function update(ProductRequest $request, Product $product)
    {
        //Product
        $product = $this->productService->update($request->except([
            '_token', 'sku', 'choice', 'tax_id', 'tax', 'tax_type', 'flash_deal_id', 'flash_discount', 'flash_discount_type'
        ]), $product);

        //Product Stock
        foreach ($product->stocks as $key => $stock) {
            $stock->delete();
        }
        $request->merge(['product_id' => $product->id]);
        $this->productStockService->store($request->only([
            'colors_active', 'colors', 'choice_no', 'unit_price', 'sku', 'current_stock', 'product_id'
        ]), $product);

        //VAT & Tax
        if ($request->tax_id) {
            ProductTax::where('product_id', $product->id)->delete();
            $request->merge(['product_id' => $product->id]);
            $this->productTaxService->store($request->only([
                'tax_id', 'tax', 'tax_type', 'product_id'
            ]));
        }

        // Product Translations
        ProductTranslation::updateOrCreate(
            $request->only([
                'lang', 'product_id'
            ]),
            $request->only([
                'name', 'unit', 'description'
            ])
        );

        return $this->success(translate('Product has been updated successfully'));
    }

    public function change_status(Request $request)
    {
        $product = Product::where('user_id', auth()->user()->id)
            ->where('id', $request->id)
            ->update([
                'published' => $request->status
            ]);

        if ($product == 0) {
            return $this->failed(translate('This product is not yours'));
        }
        return ($request->status == 1) ?
            $this->success(translate('Product has been published successfully')) :
            $this->success(translate('Product has been unpublished successfully'));
    }

    public function change_featured_status(Request $request)
    {
        $product = Product::where('user_id', auth()->user()->id)
            ->where('id', $request->id)
            ->update([
                'seller_featured' => $request->featured_status
            ]);

        if ($product == 0) {
          return  $this->failed(translate('This product is not yours'));
        }

        return ($request->featured_status == 1) ?
            $this->success(translate('Product has been featured successfully')) :
            $this->success(translate('Product has been unfeatured successfully'));
    }

    public function duplicate($id)
    {
        $product = Product::findOrFail($id);
        
        if (auth()->user()->id != $product->user_id) {
            return $this->failed(translate('This product is not yours'));
        }
        if (addon_is_activated('seller_subscription')) {
            if (!seller_package_validity_check(auth()->user()->id)) {
                return $this->failed(translate('Please upgrade your package'));
            }
        }

        if (auth()->user()->id == $product->user_id) {
            $product_new = $product->replicate();
            $product_new->slug = $product_new->slug . '-' . Str::random(5);
            $product_new->save();

            //Store in Product Stock Table
            (new ProductStockService)->product_duplicate_store($product->stocks, $product_new);

            //Store in Product Tax Table
            (new ProductTaxService)->product_duplicate_store($product->taxes, $product_new);

            return $this->success(translate('Product has been duplicated successfully'));
        }
    }

    public function destroy($id)
    {
        $product = Product::findOrFail($id);

        if (auth()->user()->id != $product->user_id) {
            return $this->failed(translate('This product is not yours'));
        }

        $product->product_translations()->delete();
        $product->stocks()->delete();
        $product->taxes()->delete();

        if (Product::destroy($id)) {
            Cart::where('product_id', $id)->delete();

            return $this->success(translate('Product has been deleted successfully'));

            Artisan::call('view:clear');
            Artisan::call('cache:clear');
        }
    }

    public function product_reviews()
    {
        $reviews = Review::orderBy('id', 'desc')
            ->join('products', 'reviews.product_id', '=', 'products.id')
            ->join('users','reviews.user_id','=','users.id')
            ->where('products.user_id', auth()->user()->id)
            ->select('reviews.id','reviews.rating','reviews.comment','reviews.status','reviews.updated_at','products.name as product_name','users.id as user_id','users.name','users.avatar')
            ->distinct()
            ->paginate(1);
        
       return new ProductReviewCollection($reviews);
    }

    public function remainingUploads(){
        
        $remaining_uploads=(max(0, auth()->user()->shop->product_upload_limit - auth()->user()->products()->count()) );
        return response()->json([
            'ramaining_product'=> $remaining_uploads,
        ]);
    }

}
