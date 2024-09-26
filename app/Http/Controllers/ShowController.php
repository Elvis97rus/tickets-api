<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\TicketProviderInterface;
use Illuminate\Http\JsonResponse;

/**
 * @OA\Tag(
 *     name="Shows",
 *     description="API Endpoints для управления мероприятиями"
 * )
 */
class ShowController extends Controller
{
    protected TicketProviderInterface $ticketProvider;

    public function __construct(TicketProviderInterface $ticketProvider)
    {
        $this->ticketProvider = $ticketProvider;
    }

    /**
     * @OA\Get(
     *     path="/shows",
     *     summary="Список мероприятий",
     *     description="Возвращает список доступных мероприятий.",
     *     tags={"Shows"},
     *     @OA\Response(
     *         response=200,
     *         description="Список мероприятий",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(
     *                 type="object",
     *                 @OA\Property(property="id", type="integer", description="ID мероприятия"),
     *                 @OA\Property(property="name", type="string", description="Название мероприятия")
     *             )
     *         )
     *     )
     * )
     */
    public function index(): JsonResponse
    {
        $shows = $this->ticketProvider->getShows();
        return response()->json($shows);
    }

    /**
     * @OA\Get(
     *     path="/shows/{id}",
     *     summary="Получение детальной информации по конкретному События",
     *     description="Возвращает подробную информацию о События.",
     *     tags={"Shows"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID мероприятия",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Детальная страница События",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="id", type="integer", example=1, description="ID события"),
     *             @OA\Property(property="showId", type="integer", example=1, description="ID мероприятия"),
     *             @OA\Property(property="date", type="string", example="2019-08-22 20:26:38", description="Дата события"),
     *         )
     *     )
     * )
     */
    public function show(int $id): JsonResponse
    {
        $show = $this->ticketProvider->getShowDetails($id);
        return response()->json($show);
    }
}
