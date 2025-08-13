<?php

namespace App\Http\Controllers;

use App\Traits\HttpResponse;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Interfaces\AuthServiceInterface;
use App\Interfaces\LoginRequestInterface;
use App\Interfaces\AuthRepositoryInterface;
use App\Interfaces\RegisterRequestInterface;
use Illuminate\Http\Response;

class AuthController extends Controller
{

    use HttpResponse;

    public function __construct(private readonly AuthServiceInterface $authService) {}

    /**
     * @OA\Post(
     *      path="/auth/register",
     *      tags={"Authentication"},
     *      summary="Add new user",
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\MediaType(mediaType="application/json",
     *              @OA\Schema(
     *                 required={"name", "email", "password", "password_confirmation"},
     *                 @OA\Property(
     *                     property="name",
     *                     type="string",
     *                     description="Name of user"
     *                 ),
     *                 @OA\Property(
     *                     property="email",
     *                     type="email",
     *                     description="User email"
     *                 ),
     *                 @OA\Property(
     *                     property="password",
     *                     type="string",
     *                     description="User password"
     *                 ),
     *                 @OA\Property(
     *                     property="password_confirmation",
     *                     type="string",
     *                     description="User password confirmation"
     *                 ),
     *                 example={"name": "Johnny Bravo", "email": "email@email.com", "password": "123456", "password_confirmation": "123456"}
     *             )
     *         )
     *      ),
     *      @OA\Response(response=201, description="Successful registered", @OA\JsonContent()),
     *      @OA\Response(response=422, description="Validation errors", @OA\JsonContent()),
     *  )
     */
    public function register(RegisterRequestInterface $request, AuthRepositoryInterface $authRepository): JsonResponse
    {
        $user = $this->authService->register($request, $authRepository);

        return HttpResponse::success($user, Response::HTTP_CREATED);
    }

    /**
     * @OA\Post(
     *      path="/auth/login",
     *      tags={"Authentication"},
     *      summary="Starts user session",
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\MediaType(mediaType="application/json",
     *              @OA\Schema(
     *                 required={"email", "password"},
     *                 @OA\Property(
     *                     property="email",
     *                     type="email",
     *                     description="User email"
     *                 ),
     *                 @OA\Property(
     *                     property="password",
     *                     type="string",
     *                     description="User password"
     *                 ),
     *                 example={"email": "email@email.com", "password": "123456"}
     *             )
     *         )
     *      ),
     *      @OA\Response(response=200, description="Successful", @OA\JsonContent()),
     *      @OA\Response(response=422, description="Validation errors", @OA\JsonContent()),
     *      @OA\Response(response=401, description="Unauthorized", @OA\JsonContent()),
     *  )
     */
    public function login(LoginRequestInterface $request): JsonResponse
    {
        $token = $this->authService->login($request);

        if (empty($token)) {
            return HttpResponse::error('Unauthorized', Response::HTTP_UNAUTHORIZED);
        }

        return HttpResponse::success($token);
    }

    /**
     * @OA\Post(
     *      path="/auth/me",
     *      tags={"Authentication"},
     *      summary="Return logged in user",
     *      security={{"bearerAuth":{}}},
     *      @OA\Response(response=200, description="Successful", @OA\JsonContent()),
     *      @OA\Response(response=401, description="Unauthorized", @OA\JsonContent()),
     *  )
     */
    public function me(): JsonResponse
    {
        $user = $this->authService->me();

        return HttpResponse::success($user);
    }

    /**
     * @OA\Post(
     *      path="/auth/refresh",
     *      tags={"Authentication"},
     *      summary="Refresh user session",
     *      security={{"bearerAuth":{}}},
     *      @OA\Response(response=200, description="Successful", @OA\JsonContent()),
     *      @OA\Response(response=401, description="Unauthorized", @OA\JsonContent()),
     *  )
     */
    public function refresh(): JsonResponse
    {
        $token = $this->authService->refresh();

        return HttpResponse::success($token);
    }

    /**
     * @OA\Post(
     *      path="/auth/logout",
     *      tags={"Authentication"},
     *      summary="Ends the user session",
     *      security={{"bearerAuth":{}}},
     *      @OA\Response(response=200, description="Successful", @OA\JsonContent()),
     *      @OA\Response(response=401, description="Unauthorized", @OA\JsonContent()),
     *  )
     */
    public function logout(): JsonResponse
    {
        $this->authService->logout();

        return HttpResponse::success();
    }
}
