<?php

namespace App\Traits;

trait ResponseTrait

{
  public function successResponse($message, $status = 200)
  {
      return response()->json(['message' => $message, 'status' => 'success'], $status);
  }

  public function errorResponse($message, $status = 400)
  {
      return response()->json(['message' => $message, 'status' => 'error'], $status);
  }
}
