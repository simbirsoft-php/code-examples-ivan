<?php

namespace App\Http\Controllers\Api;

use App\Models\Station;
use App\Http\Requests\StationRequest;
use App\Http\Resource\StationResource;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\Auth;

class StationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @OA\Get(
     *     path="/stations",
     *     tags={"stations"},
     *     summary="Список СТОА",
     *     operationId="index",
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Unauthenticated"
     *     ),
     *     security={
     *         {"basic": {}}
     *     }
     * )
     */
    public function index(): AnonymousResourceCollection
    {
        return StationResource::collection(Station::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StationRequest $request
     *
     * @return StationResource
     *
     * @OA\Post(
     *     path="/stations",
     *     tags={"stations"},
     *     summary="Добавление новой СТОА",
     *     operationId="store",
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *         @OA\JsonContent(ref="#/components/schemas/Station")
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Unauthenticated"
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Validation failed",
     *     ),
     *     security={
     *         {"basic": {}}
     *     },
     *     requestBody={"$ref": "#/components/requestBodies/Station"}
     * )
     */
    public function store(StationRequest $request): StationResource
    {
        $station = new Station();
        $station->fill($request->request->all());
        $station['user_id'] = Auth::user()->id;
        $station->save();

        return new StationResource($station);
    }

    /**
     * Display the specified resource.
     *
     * @param Station $station
     *
     * @return StationResource
     *
     * @OA\Get(
     *     path="/stations/{id}",
     *     tags={"stations"},
     *     summary="Информация о СТОА",
     *     operationId="show",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="",
     *         required=true,
     *         @OA\Schema(
     *             type="integer",
     *             format="int64"
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Unauthenticated"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Company not found",
     *     ),
     *     security={
     *         {"basic": {}}
     *     }
     * )
     */
    public function show(Station $station): StationResource
    {
        return new StationResource($station);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param StationRequest $request
     * @param Station        $station
     *
     * @return StationResource
     *
     * @OA\Put(
     *     path="/stations/{id}",
     *     tags={"stations"},
     *     summary="Редактирвоание информации о СТОА",
     *     operationId="update",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="",
     *         required=true,
     *         @OA\Schema(
     *             type="integer",
     *             format="int64"
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *         @OA\JsonContent(ref="#/components/schemas/Station")
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Unauthenticated"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Company not found",
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Validation failed",
     *     ),
     *     security={
     *         {"basic": {}}
     *     },
     *     requestBody={"$ref": "#/components/requestBodies/Station"}
     * )
     */
    public function update(StationRequest $request, Station $station): StationResource
    {
        $station->update($request->request->all());

        return new StationResource($station);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Station $station
     *
     * @return JsonResponse
     * @throws \Exception
     *
     * @OA\Delete(
     *     path="/stations/{id}",
     *     tags={"stations"},
     *     summary="Удаление СТОА",
     *     operationId="destroy",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="",
     *         required=true,
     *         @OA\Schema(
     *             type="integer",
     *             format="int64"
     *         )
     *     ),
     *     @OA\Response(
     *         response=204,
     *         description="Successful operation"
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Unauthenticated"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Company not found"
     *     ),
     *     security={
     *         {"basic": {}}
     *     }
     * )
     */
    public function destroy(Station $station): JsonResponse
    {
        $station->schedules()->delete();
        $station->delete();

        return new JsonResponse('', 204);
    }
}
