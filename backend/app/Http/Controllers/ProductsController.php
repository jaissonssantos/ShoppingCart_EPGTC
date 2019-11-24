<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Product;

class ProductsController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:api')->except('index', 'show');
    }

    public function index()
    {
        $product = Product::paginate(20);
        return response()->json($product, 200);
    }


    public function store(Request $request)
    {
        // return Product::create($request->all());
        $rules = [
            'name' => 'required|min:3',
            'price' => 'required',
            'stock' => 'required'
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $product = Product::create($request->all());
        return response()->json($product, 201);
    }

    public function show($id)
    {
        // return Product::findOrFail($id);
        $product = Product::find($id);
        if (is_null($product)) {
            return response()->json(
                [
                    'response' => 'error',
                    'error' => 'Record not found'
                ],
                404
            );
        }

        return response()->json(['data' => $product], 200);
    }

    public function update(Request $request, $id)
    {
        // $data = Product::findOrFail($id);
        // $data->update($request->all());

        $product = Product::find($id);
        if (is_null($product)) {
            return response()->json(
                [
                    'response' => 'error',
                    'error' => 'Record not found'
                ],
                400
            );
        }

        $rules = [
            'name' => 'required|min:3',
            'price' => 'required',
            'stock' => 'required'
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $product->update($request->all());

        return response()->json(['data' => $product], 200);
    }

    public function destroy($id)
    {
        $data = Product::findOrFail($id);
        $data->delete();

        return response()->json(null, 204);
    }
}
