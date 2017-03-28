<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response as IlluminateResponse;
use Illuminate\Pagination\Paginator;
use Symfony\Component\HttpFoundation\JsonResponse;

use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;


class ApiController extends Controller
{
    /**
     * @var int
     */
    use UserSessionTrait;
    protected $statusCode = IlluminateResponse::HTTP_OK;

    public function getAuthenticatedUser()
    {
        try {

            if (! $user = JWTAuth::parseToken()->authenticate()) {
                return response()->json(['user_not_found'], 404);
            }

        } catch (Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {

            return response()->json(['token_expired'], $e->getStatusCode());

        } catch (Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {

            return response()->json(['token_invalid'], $e->getStatusCode());

        } catch (Tymon\JWTAuth\Exceptions\JWTException $e) {

            return response()->json(['token_absent'], $e->getStatusCode());

        }

        // the token is valid and we have found the user via the sub claim
        return JWTAuth::parseToken()->authenticate();
    }
    /**
     * @return int
     */
    public function getStatusCode()
    {
        return $this->statusCode;
    }

    /**
     * @param $statusCode
     * @return $this
     */
    public function setStatusCode($statusCode)
    {
        $this->statusCode = $statusCode;
        return $this;
    }

    /**
     * @param $data
     * @param array $headers
     * @return JsonResponse
     */
    public function respond($data, $headers = [])
    {
        return new JsonResponse($data, $this->getStatusCode(), $headers);
    }

    /**
     * @param string $message
     * @return JsonResponse
     */
    public function respondFailedValidation($message = 'Parameters failed validation')
    {
        return $this->setStatusCode(IlluminateResponse::HTTP_UNPROCESSABLE_ENTITY)->respondWithError($message);
    }

    public function respondUnauthorizedWithErrors($errors)
    {
        return $this->setStatusCode(IlluminateResponse::HTTP_UNAUTHORIZED)->respond(['errors' => $errors]);
    }

    /**
     * @param string $message
     * @return JsonResponse
     */
    public function respondNotFound($message = "Not Found")
    {
        return $this->setStatusCode(IlluminateResponse::HTTP_NOT_FOUND)->respondWithError($message);
    }

    /**
     * @param $data
     * @return JsonResponse
     */
    public function respondWithPagination($model, $data)
    {
        $data = array_merge($data, [
            'next_page_url' => $model->nextPageUrl(),
        ]);

        return $this->respond(
            $data
        );
    }

    /**
     * @param $data
     * @param string $message
     * @return JsonResponse
     */
    public function respondWithCreated($data, $message = 'Created successfully')
    {
        return $this->setStatusCode(IlluminateResponse::HTTP_CREATED)->respondWithData($message, $data);
    }

    /**
     * @param string $message
     * @return JsonResponse
     */
    public function respondCreated($message = 'Created successfully')
    {
        return $this->setStatusCode(IlluminateResponse::HTTP_CREATED)->respondWithSuccess($message);
    }

    /**
     * @param $message
     * @return JsonResponse
     */
    public function respondOK($message)
    {
        return $this->setStatusCode(IlluminateResponse::HTTP_OK)->respondWithSuccess($message);
    }

    public function respondOKWithData($message, $data)
    {
        return $this->setStatusCode(IlluminateResponse::HTTP_OK)->respondWithData($message, $data);
    }

    /**
     * @param $message
     * @return JsonResponse
     */
    public function respondWithError($message)
    {
        return $this->respond([
            'error' => [
                'message' => $message,
                'status_code' => $this->getStatusCode()
            ]
        ]);
    }

    /**
     * @param $message
     * @return JsonResponse
     */
    private function respondWithSuccess($message)
    {
        return $this->respond([
            'success' => [
                'message' => $message,
                'status_code' => $this->getStatusCode()
            ]
        ]);
    }

    /**
     * @param $message
     * @param $data
     * @return JsonResponse
     */
    private function respondWithData($message, $data)
    {
        return $this->respond([
            'message' => $message,
            key($data) => $data[key($data)],
            'status_code' => $this->getStatusCode()
        ]);
    }
}