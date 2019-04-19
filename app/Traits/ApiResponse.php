<?php

namespace App\Traits;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response as IlluminateResponse;

trait ApiResponse
{
    protected static $response = null;

    protected $statusCode = IlluminateResponse::HTTP_OK;

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
     * @return int
     */
    public function getStatusCode()
    {
        return $this->statusCode;
    }

    /**
     * @param int $code
     * @param null $status
     * @param null $data
     * @param null $message
     * @return JsonResponse
     */
    public function respond($code = 200, $status = null, $data = null, $message = null)
    {
        $return = null;
        if (!is_null($status) || !is_null($message) || !is_null($data)) {
            $return = [];
            if (!is_null($status)) $return['status'] = $status;
            if (!is_null($message)) $return['message'] = $message;
            if (!is_null($data)) $return['data'] = $data;
        }
        return response()->json($return, $code);
    }

    /**
     * @param null $data
     * @param null $message
     * @return JsonResponse
     */
    public function respondOK($data = null, $message = null)
    {
        return $this->respond(200, 'OK', $data, $message);
    }

    /**
     * @param null $data
     * @param null $message
     * @return JsonResponse
     */
    public function respondUnchanged($data = null, $message = null)
    {
        return $this->respond(200, 'UNCHANGED', $data, $message);
    }

    /**
     * @param null $data
     * @param null $message
     * @return JsonResponse
     */
    public function respondCreated($data = null, $message = null)
    {
        return $this->respond(201, 'CREATED', $data, $message);
    }

    /**
     * @param null $message
     * @param null $data
     * @return JsonResponse
     */
    public function respondDenied($message = null, $data = null)
    {
        $message = $message ? $message : trans('errors.permission_denied');
        return $this->respond(403, $message, $message, $data);
    }

    /**
     * @param null $errorMessage
     * @param string $status
     * @param null $data
     * @return JsonResponse
     */
    public function respondBadRequest($errorMessage = null, $status = 'BAD_REQUEST', $data = null)
    {
        $errorMessage = is_null($errorMessage) ? trans('errors.bad_request') : $errorMessage;
        return $this->respond(400, $status, $data, $errorMessage);
    }

    /**
     * @return JsonResponse
     */
    public function respondUnauthorized()
    {
        return $this->respond(401, 'UNAUTHORIZED', null, trans('errors.401_bad_permissions'));
    }

    /**
     * @param null $errorMessage
     * @return JsonResponse
     */
    public function respondNotFound($errorMessage = null)
    {
        $errorMessage = is_null($errorMessage) ? trans('errors.Page not found') : $errorMessage;
        return $this->respond(404, 'NOT_FOUND', null, $errorMessage);
    }

    /**
     * @param $data
     * @param string $status
     * @return JsonResponse
     */
    public function respondConflict($data, $status = 'EMAIL_EXISTS')
    {
        $msg = implode("\n", $data->all());
        return $this->respond(409, $status, $data, $msg);
    }

    /**
     * @param        $data
     * @param string $validationType
     *
     * @return JsonResponse
     */
    public function respondInvalidation($data, $validationType = 'VALIDATION_ERROR')
    {
        $msg = implode("\n", $data->all());
        return $this->respond(422, $validationType, $data, $msg);
    }

    /**
     * @return JsonResponse
     */
    public function respondUnexpected()
    {
        return $this->respond(500, 'UNEXPECTED_ERROR', null, trans('errors.500'));
    }

    /**
     * @param null $errorMessage
     * @return JsonResponse
     */
    public function respondServerError($errorMessage = null)
    {
        $errorMessage = is_null($errorMessage) ? trans('errors.500') : $errorMessage;
        return $this->respond(500, 'UNEXPECTED_ERROR', null, $errorMessage);
    }

    public function respondLocked()
    {
        return $this->respond(423, 'Locked', null, trans('errors.locked'));
    }
}
