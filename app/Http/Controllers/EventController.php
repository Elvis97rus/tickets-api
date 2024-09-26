<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Services\TicketProviderInterface;

/**
 * @OA\Tag(
 *     name="Events",
 *     description="API Endpoints для просмотра и резерва мест"
 * )
 */
class EventController extends Controller
{
    protected TicketProviderInterface $ticketProvider;

    public function __construct(TicketProviderInterface $ticketProvider)
    {
        $this->ticketProvider = $ticketProvider;
    }

    /**
     * @OA\Get(
     *     path="/events/{id}",
     *     summary="Список мест события {id}",
     *     description="Возвращает данные о местах события {id}.",
     *     tags={"Events"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Event details",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="id", type="integer", example=1, description="ID места"),
     *             @OA\Property(property="x", type="float", example=0, description="Координата X"),
     *             @OA\Property(property="y", type="float", example=0, description="Координата Y"),
     *             @OA\Property(property="width", type="float", example=20, description="Ширина"),
     *             @OA\Property(property="height", type="float", example=20, description="Высота"),
     *             @OA\Property(property="is_available", type="boolean", example=true, description="Место доступно")
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Event not found"
     *     ),
     *     security={{"bearerAuth":{}}}
     * )
     */
    public function show(int $id): JsonResponse
    {
        $event = $this->ticketProvider->getEventDetails($id);
        return response()->json($event);
    }

    /**
     * @OA\Post(
     *     path="/events/{id}/book",
     *     summary="Резервация места",
     *     description="Позволяет резервировать указанное количество мест.",
     *     tags={"Events"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID события",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="places", type="array", description="Список ID мест",
     *                 @OA\Items(type="integer", example=3)
     *             ),
     *             @OA\Property(property="name", type="string", example="John Doe", description="Имя покупателя")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Результат резервации мест и ид_резерва",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="success", type="boolean", example=true, description="Результат бронирования"),
     *             @OA\Property(property="reservation_id", type="string", example="confirmed", description="ID резерва")
     *         )
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Bad request"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Event not found"
     *     ),
     *     security={{"bearerAuth":{}}}
     * )
     */
    public function book(Request $request, int $id): JsonResponse
    {
        $validated = $request->validate([
            'places' => 'required|array',
            'name' => 'required|string|max:255',
        ]);

        $booking = $this->ticketProvider->bookSeats($id, $validated['places'], $validated['name']);
        return response()->json($booking);
    }
}
