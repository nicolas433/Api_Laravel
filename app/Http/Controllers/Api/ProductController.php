<?php

namespace App\Http\Controllers\Api;

use App\Product;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    private $product;

    public function __construct(Product $product){
        $this->product = $product;
    }

    public function index(){
        $data = ['data' => $this->product->paginate(5)];

        return response()->json($data);
    }

    public function show(Product $id){
        $data = ['data' => $id];
        return response()->json($data);
    }

    public function store(Request $request){
        try {
            $productData = $request->all();
            $this->product->create($productData);
            
            return response()->json(['msg' => 'Product created with sucess!'], 201);

        }catch(\Exception $e) {
            if(config('app.debug')){
                return response()->json(ApiError::errorMessage($e->getMessage(), 1010));
            }
            return response()->json(ApiError::errorMessage('Error'), 1010);
        }
    }

    public function update(Request $request, $id){
        try {
            $productData = $request->all();
            $product     = $this->product->find($id);
            $product->update($productData);

            return response()->json(['msg' => 'Product updated with sucess!'], 201);

        }catch(\Exception $e) {
            if(config('app.debug')){
                return response()->json(ApiError::errorMessage($e->getMessage(), 1010));
            }
            return response()->json(ApiError::errorMessage('Error'), 1010);
        }
    }
    
    public function delete(Product $id){
        try {
            $id->delete();
            return response()->json(['msg' => 'Product removed with sucess!'], 201);

        }catch(\Exception $e) {
            if(config('app.debug')){
                return response()->json(ApiError::errorMessage($e->getMessage(), 1010));
            }
            return response()->json(ApiError::errorMessage('Error'), 1010);
        }
    }
}
