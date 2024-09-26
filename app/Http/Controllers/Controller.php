<?php

namespace App\Http\Controllers;
/**
 * @OA\Info(
 *     title="Ticket API",
 *     version="1.0.0",
 *     description="API документация для управления билетами и мероприятиями."
 * )
 *
 * @OA\Server(
 *     url=L5_SWAGGER_CONST_HOST,
 *     description="API Gateway"
 * )
 *
 * @OA\SecurityScheme(
 *     securityScheme="bearerAuth",
 *     type="http",
 *     scheme="bearer",
 *     bearerFormat="JWT",
 *     in="header",
 *     name="Authorization"
 * )
 */
abstract class Controller
{
    //
}
