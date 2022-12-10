<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CityCollection;
use App\Http\Resources\CityResource;
use App\Models\City;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return CityCollection
     */
    public function index()
    {
        return new CityCollection(City::paginate(10));
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
            'uf' => 'string|required',
            'group_id' => 'exists:App\Models\Group,id'
        ]);

        $city = City::create($validated);

        return response()->json([
            'message' => 'Cidade cadastrada com sucesso.',
            'data' => $city
        ], 200);
    }
    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return CityResource|JsonResponse
     */
    public function show($id)
    {
        $city = City::find($id);

        if (!empty($city)) {
            return new CityResource(City::find($id));
        } else {

            return response()->json([
                "message" => "Nenhuma cidade encontrada."
            ], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @return JsonResponse|Response
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'uf' => 'required|string',
            'group_id' => 'nullable|exists:App\Models\Group,id'
        ]);

        $city = City::find($id);

        if (!empty($city)) {
            $city->update($validated);
            return response()->json([
               "message" => 'Cidade atualizada com sucesso.',
               'data'=> $city
            ]);
        } else {
            return response()->json([
                "message" => "Nenhuma cidade encontrada."
            ], 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function destroy($id)
    {
        $city = City::find($id);
        if (!empty($city)) {
            $city->delete();
            return response()->json([
                "message" => "Cidade deletada com sucesso."
            ], 200);
        } else {
            return response()->json([
                "message" => "Nenhuma cidade encontrada."
            ], 404);
        }
    }
}
