<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\DiscountCollection;
use App\Http\Resources\DiscountResource;
use App\Models\Discount;
use Illuminate\Http\Request;

class DiscountController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return new DiscountCollection(Discount::paginate());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'string|required',
            'value' => 'required',
            'campaign_id' => "nullable|exists:campaigns,id",
            'product_id' => "nullable|exists:products,id"
        ]);

        $exists = Discount::where('campaign_id',$validated['campaign_id'])->where('product_id',$validated['product_id'])->get();

        if ($exists->count() > 0)
        {
            return response()->json([
                'message' => 'Ja exite um desconto para o produto dessa campanha, exclua para adicionar um novo desconto.'
            ],404);

        }

        $discount = Discount::create($validated);

        return response()->json([
            'message' => 'Desconto cadastrado com sucesso.',
            'data' => $discount
        ],200);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return DiscountResource|\Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $discount = Discount::find($id);

        if (!empty($discount))
        {
            return new DiscountResource(Discount::find($id));
        } else {

            return response()->json([
                "message" => 'Nenhum desconto encontrado.'
            ],404);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'title' => 'required|string',
            'value' => 'required|numeric',
            'campaign_id' => 'nullable|exists:App\Models\Campaign,id',
            'product_id'   => 'nullable|exists:App\Models\Product,id'
        ]);

        $discount = Discount::find($id);

        if (!empty($discount)) {
            $discount->update($validated);
            return response()->json([
                "message" => 'Desconto atualizado com sucesso.',
               'data'=> $discount
            ]);
        } else {
            return response()->json([
                "message" => 'Nenhum desconto encontrado.'
            ],404);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $discount = Discount::find($id);
        if (!empty($discount)) {
            $discount->delete();
            return response()->json([
               "message" => "Desconto deletado com sucesso."
            ],200);
        } else {
            return response()->json([
                "message" => "Nenhum desconto encontrado."
            ],404);
        }
    }
}
