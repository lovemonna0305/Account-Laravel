<?php

namespace App\Http\Controllers\Api\V2;

use App\Http\Controllers\Controller;
use App\Http\Resources\V2\ClassifiedProductDetailCollection;
use App\Http\Resources\V2\ClassifiedProductMiniCollection;
use App\Models\CustomerProduct;
use Illuminate\Http\Request;

class CustomerProductController extends Controller
{
    //


    public function all()
    {
        $products = CustomerProduct::where('status', '1')->where('published', '1')->paginate(10);
        return new ClassifiedProductMiniCollection($products);
    }

    
    public function ownProducts()
    {
        $products = CustomerProduct::where('user_id', auth()->user()->id)->paginate(20);
        return new ClassifiedProductMiniCollection($products);
    }


    public function relatedProducts($id)
    {
        $product =   CustomerProduct::where('id', $id)->first();
        $products =   CustomerProduct::where('category_id', $product->category_id)->where('id', '!=', $product->id)->where('status', '1')->where('published', '1')->paginate(10);
        return new ClassifiedProductMiniCollection($products);
    }


    public function productDetails($id)
    {
        return new ClassifiedProductDetailCollection(CustomerProduct::where('id', $id)->get());
        // if (Product::findOrFail($id)->digital==0) {
        //     return new ProductDetailCollection(Product::where('id', $id)->get());
        // }elseif (Product::findOrFail($id)->digital==1) {
        //     return new DigitalProductDetailCollection(Product::where('id', $id)->get());
        // }
    }

    public function delete($id)
    {
        $product = CustomerProduct::where("id",$id)->where('user_id', auth()->user()->id)->delete();

        if($product)
        return response()->json([
            'result' => true,
            'message' => translate('Product delete successfully')
        ]);
        else
        return response()->json([
            'result' => false,
            'message' => translate('Product delete failed')
        ]);
    }

    public function changeStatus(Request $req, $id)
    {
        $product = CustomerProduct::where("id",$id)->where('user_id', auth()->user()->id)->first();

        $product->status = $req->status;
        $product->save();
        return response()->json([
            'result' => true,
            'message' => translate('Product has updated successfully')
        ]);
    }

}
