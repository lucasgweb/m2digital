<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\GroupCollection;
use App\Http\Resources\GroupResource;
use App\Models\Group;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class GroupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return GroupCollection
     */
    public function index()
    {
        return new GroupCollection(Group::paginate(10));
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
            'campaign_id' => 'nullable|exists:App\Models\Campaign,id'
        ]);

        $group = Group::create($validated);

        return response()->json([
            'message' => 'Grupo cadastrado com sucesso.',
            'data' => $group
        ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return GroupResource|JsonResponse
     */
    public function show($id)
    {
        $group = Group::find($id);

        if (!empty($group)) {
            return new GroupResource(Group::find($id));
        } else {

            return response()->json([
                "message" => 'Nenhum grupo encontrado.'
            ], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param  int  $id
     * @return JsonResponse
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'campaign_id' => 'nullable|exists:App\Models\Campaign,id'
        ]);

        $group = Group::find($id);

        if (!empty($group)) {
            $group->update($validated);
            return response()->json([
                "message" => 'Grupo atualizado com sucesso.',
                'data' => $group
            ]);
        } else {
            return response()->json([
                "message" => 'Nenhum grupo encontrado.'
            ], 404);
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
        $group = Group::find($id);
        if (!empty($group)) {
            $group->delete();
            return response()->json([
                "message" => "Grupo deletado com sucesso."
            ], 200);
        } else {
            return response()->json([
                "message" => "Nenhum grupo encontrado."
            ], 404);
        }
    }
}
