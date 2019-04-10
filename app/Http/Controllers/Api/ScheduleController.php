<?php

namespace App\Http\Controllers\Api;

use App\Contracts\ScheduleDataProvider;
use App\Contracts\ScheduleService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;

class   ScheduleController extends Controller
{
    /**
     * Import a schedule of the company
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  ScheduleService $scheduleService
     * @param  ScheduleDataProvider $scheduleDataProvider
     * @return Response
     *
     * @OA\Post(
     *     path="/schedules/import",
     *     tags={"schedules"},
     *     summary="Импортирование расписания",
     *     operationId="import",
     *     requestBody={"$ref": "#/components/requestBodies/Import"},
     *     @OA\Response(
     *         response=201,
     *         description="Successful operation",
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Bad request",
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
    public function import(Request $request, ScheduleService $scheduleService, ScheduleDataProvider $scheduleDataProvider): Response
    {
        try {
            $filePath = $request->file('file')->getRealPath();

            $sheduleItems = $scheduleDataProvider->getData($filePath);
            $scheduleService->import($sheduleItems);
        } catch (\Exception $exception) {
            return new Response($exception->getMessage(), 400);
        }

        return new Response('', 201);
    }
}
