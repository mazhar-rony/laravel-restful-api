<?php

namespace App\Exceptions;

use Symfony\Component\HttpFoundation\Response;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

trait Exceptiontrait
{
    public function apiException($request, $e)
    {
        /*if($e instanceof ModelNotFoundException)
        {
            return response()->json([
                'errors' => 'Product Model Not Found'
            ], Response::HTTP_NOT_FOUND);
        }

        if($e instanceof NotFoundHttpException)
        {
            return response()->json([
                'errors' => 'Incorrect Route or URL'
            ], Response::HTTP_NOT_FOUND);
        }*/

        if($this->isModel($e))
        {
            return $this->modelResponse();
        }

        if($this->isHttp($e))
        {
            return $this->httpResponse();
        }

        return parent::render($request, $exception);
    }

    protected function isModel($e)
    {
        return $e instanceof ModelNotFoundException;
    }

    protected function isHttp($e)
    {
        return $e instanceof NotFoundHttpException;
    }

    protected function modelResponse()
    {
        return response()->json(['errors' => 'Product Model Not Found'], Response::HTTP_NOT_FOUND);
    }

    protected function httpResponse()
    {
        return response()->json(['errors' => 'Incorrect Route or URL'], Response::HTTP_NOT_FOUND);
    }
}