<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductCollection;
use App\Http\Resources\ProductResource;
use App\Models\Campaign;
use App\Models\Product;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return ProductCollection
     */
    public function index()
    {
        return new ProductCollection(Product::paginate());
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'string|required',
            'price' => 'required|numeric',
            'campaign_id' => 'exists:App\Models\Campaign,id'
        ]);

        $procuct = Product::create($validated);

        if(!empty($validated['campaign_id'])){
         $campaign = Campaign::find($validated['campaign_id']);
        $procuct->campaign()->save($campaign);
        }
        

        return response()->json([
            'message' => 'Produto cadastrado com sucesso.',
            'data' => $procuct
        ],200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return ProductResource|JsonResponse
     */
    public function show($id)
    {
        $product = Product::find($id);

        if (!empty($product))
        {
            return new ProductResource(Product::find($id));
        } else {

            return response()->json([
                "message" => 'Nenhum produto encontrado.'
            ],404);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param  int  $id
     * @return JsonResponse|Response
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'price' => 'required|numeric'
        ]);

        $product = Product::find($id);

        if (!empty($product)) {
            $product->update($validated);
            return response()->json([
                "message" => 'Produto atualizado com sucesso.',
               'data'=>$product
            ]);
        } else {
            return response()->json([
                "message" => 'Nenhum produto encontrado.'
            ],404);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return JsonResponse
     */
    public function destroy($id)
    {
        $product = Product::find($id);
        if (!empty($product)) {
            $product->delete();
            return response()->json([
                "message" => "Produto deletado com sucesso."
            ],200);
        } else {
            return response()->json([
                "message" => "Nenhum produto encontrado."
            ],404);
        }
    }
}
