<?php

namespace App\Exceptions;

use Exception;
use Symfony\Component\HttpFoundation\Response;

class ProductNotBelongsToUser extends Exception
{
    public function render()
    {
        return response()->json([
                'error' => 'Product Not Belongs to this User'
            ], Response::HTTP_NOT_FOUND);
    }
}
