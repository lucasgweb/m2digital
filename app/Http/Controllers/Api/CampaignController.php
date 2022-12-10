<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CampaignCollection;
use App\Http\Resources\CampaignResource;
use App\Models\Campaign;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CampaignController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return CampaignCollection
     */
    public function index()
    {
        return new CampaignCollection(Campaign::paginate());
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
            'group_id' => 'exists:App\Models\Group,id'
        ]);

        $campaign = Campaign::create($validated);

        return response()->json([
            'message' => 'Campanha cadastrada com sucesso.',
            'data' => $campaign
        ],200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return CampaignResource|JsonResponse
     */
    public function show($id)
    {
        $city = Campaign::find($id);

        if (!empty($city))
        {
            return new CampaignResource(Campaign::find($id));
        } else {

            return response()->json([
                "message" => 'Nenhuma campanha encontrada.'
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
            'name' => 'required|string'
        ]);

        $campaign = Campaign::find($id);

        if (!empty($campaign)) {
            $campaign->update($validated);
            return response()->json([
                "message" => 'Campanha atualizada com sucesso.',
               'data'=>$campaign 
            ]);
        } else {
            return response()->json([
                "message" => 'Nenhuma campanha encontrada.'
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
        $campaign = Campaign::find($id);
        if (!empty($campaign)) {
            $campaign->delete();
            return response()->json([
                 "message" => "Campanha deletada com sucesso."
                ],200);
        } else {
            return response()->json([
                "message" => "Nenhuma campanha encontrada."
            ],404);
        }
    }
}
