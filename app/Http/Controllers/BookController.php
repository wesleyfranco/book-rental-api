<?php

namespace App\Http\Controllers;

use App\Traits\HttpResponse;
use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;
use App\Interfaces\BookRequestInterface;
use App\Interfaces\BookServiceInterface;

class BookController extends Controller
{

    use HttpResponse;

    /**
     * @OA\Info(
     *    title="Book Rental API",
     *    version="1.0.0",
     * )
     * @OA\SecurityScheme(
     *     type="http",
     *     securityScheme="bearerAuth",
     *     scheme="bearer",
     *     bearerFormat="JWT"
     * )
     *
     */
    public function __construct(private readonly BookServiceInterface $bookService) {}

    /**
     * @OA\Get(
     *     path="/books",
     *     tags={"Books"},
     *     summary="Get a list of books",
     *     @OA\Parameter(
     *          in="query",
     *          name="page",
     *          description="Page number for pagination",
     *          required=false,
     *          @OA\Schema(
     *              type="integer",
     *              default=1
     *          )
     *      ),
     *     security={{"bearerAuth":{}}},
     *     @OA\Response(response=200, description="Successful", @OA\JsonContent()),
     *     @OA\Response(response=401, description="Unauthorized", @OA\JsonContent())
     * )
     */
    public function index(): JsonResponse
    {
        $books = $this->bookService->all();

        return HttpResponse::success($books);
    }

    /**
     * @OA\Post(
     *      path="/books",
     *      tags={"Books"},
     *      summary="Add new book",
     *      security={{"bearerAuth":{}}},
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\MediaType(mediaType="application/json",
     *              @OA\Schema(
     *                 required={"name", "synopsis", "publisher", "edition", "page_number", "isbn", "language", "release_date"},
     *                 @OA\Property(
     *                     property="name",
     *                     type="string",
     *                     description="Book name"
     *                 ),
     *                 @OA\Property(
     *                     property="synopsis",
     *                     type="string",
     *                     description="Book synopsis"
     *                 ),
     *                 @OA\Property(
     *                     property="publisher",
     *                     type="string",
     *                     description="Book publisher"
     *                 ),
     *                 @OA\Property(
     *                     property="edition",
     *                     type="string",
     *                     description="Book edition"
     *                 ),
     *                 @OA\Property(
     *                     property="page_number",
     *                     type="integer",
     *                     description="Number of pages in the book"
     *                 ),
     *                 @OA\Property(
     *                     property="isbn",
     *                     type="string",
     *                     description="Book isbn"
     *                 ),
     *                 @OA\Property(
     *                     property="language",
     *                     type="string",
     *                     description="Book language"
     *                 ),
     *                 @OA\Property(
     *                     property="release_date",
     *                     type="string",
     *                     description="Book release date"
     *                 ),
     *                 example={"name": "Por uma história-mundo", "synopsis": "Na era da mundialização, como escrever uma história aberta sobre o mundo...", "publisher": "Autêntica", "edition": "1", "page_number": 200, "isbn": "9788582176122", "language": "Português", "release_date": "25/07/2015"}
     *             )
     *         )
     *      ),
     *      @OA\Response(response=201, description="Successful created", @OA\JsonContent()),
     *      @OA\Response(response=401, description="Unauthorized", @OA\JsonContent()),
     *      @OA\Response(response=422, description="Validation errors", @OA\JsonContent()),
     *  )
     */
    public function store(BookRequestInterface $request): JsonResponse
    {
        $book = $this->bookService->store($request);

        return HttpResponse::success($book, Response::HTTP_CREATED);
    }

    /**
     * @OA\Get(
     *     path="/books/{id}",
     *     tags={"Books"},
     *     summary="Get a book by id",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="Book id",
     *         required=true,
     *      ),
     *     security={{"bearerAuth":{}}},
     *     @OA\Response(response=200, description="Successful", @OA\JsonContent()),
     *     @OA\Response(response=401, description="Unauthorized", @OA\JsonContent()),
     *     @OA\Response(response=404, description="Book not found", @OA\JsonContent()),
     * )
     */
    public function show(string $id): JsonResponse
    {
        $book = $this->bookService->show($id);

        if (empty($book)) {
            return HttpResponse::error('Book not found', Response::HTTP_NOT_FOUND);
        }

        return HttpResponse::success($book);
    }

    /**
     * @OA\Put(
     *      path="/books/{id}",
     *      tags={"Books"},
     *      summary="Update book",
     *      security={{"bearerAuth":{}}},
     *      @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="Book id",
     *         required=true,
     *      ),
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\MediaType(mediaType="application/json",
     *              @OA\Schema(
     *                 required={"name", "synopsis", "publisher", "edition", "page_number", "isbn", "language", "release_date"},
     *                 @OA\Property(
     *                     property="name",
     *                     type="string",
     *                     description="Book name"
     *                 ),
     *                 @OA\Property(
     *                     property="synopsis",
     *                     type="string",
     *                     description="Book synopsis"
     *                 ),
     *                 @OA\Property(
     *                     property="publisher",
     *                     type="string",
     *                     description="Book publisher"
     *                 ),
     *                 @OA\Property(
     *                     property="edition",
     *                     type="string",
     *                     description="Book edition"
     *                 ),
     *                 @OA\Property(
     *                     property="page_number",
     *                     type="integer",
     *                     description="Number of pages in the book"
     *                 ),
     *                 @OA\Property(
     *                     property="isbn",
     *                     type="string",
     *                     description="Book isbn"
     *                 ),
     *                 @OA\Property(
     *                     property="language",
     *                     type="string",
     *                     description="Book language"
     *                 ),
     *                 @OA\Property(
     *                     property="release_date",
     *                     type="string",
     *                     description="Book release date"
     *                 ),
     *                 example={"name": "Por uma história-mundo", "synopsis": "Na era da mundialização, como escrever uma história aberta sobre o mundo...", "publisher": "Autêntica", "edition": "1", "page_number": 200, "isbn": "9788582176122", "language": "Português", "release_date": "25/07/2015"}
     *             )
     *         )
     *      ),
     *      @OA\Response(response=200, description="Successful update", @OA\JsonContent()),
     *      @OA\Response(response=401, description="Unauthorized", @OA\JsonContent()),
     *      @OA\Response(response=422, description="Validation errors", @OA\JsonContent()),
     *      @OA\Response(response=404, description="Book not found", @OA\JsonContent()),
     *  )
     */
    public function update(BookRequestInterface $request, string $id): JsonResponse
    {
        $book = $this->bookService->update($request, $id);

        if (empty($book)) {
            return HttpResponse::error('Book not found', Response::HTTP_NOT_FOUND);
        }

        return HttpResponse::success($book);
    }

    /**
     * @OA\Delete(
     *     path="/books/{id}",
     *     tags={"Books"},
     *     summary="Delete a book by id",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="Book id",
     *         required=true,
     *      ),
     *     security={{"bearerAuth":{}}},
     *     @OA\Response(response=204, description="Successful", @OA\JsonContent()),
     *     @OA\Response(response=401, description="Unauthorized", @OA\JsonContent()),
     *     @OA\Response(response=404, description="Book not found", @OA\JsonContent()),
     * )
     */
    public function destroy(string $id): JsonResponse
    {
        $book = $this->bookService->destroy($id);

        if (!$book) {
            return HttpResponse::error('Book not found', Response::HTTP_NOT_FOUND);
        }

        return HttpResponse::success([], Response::HTTP_NO_CONTENT);
    }
}
