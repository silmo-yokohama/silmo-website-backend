<?php

class ApiController
{
  protected $data = [];
  protected $hasError = false;
  protected $errorMessage = '';
  protected $statusCode = 200;


  function response()
  {
    if ($this->hasError) {
      return new WP_REST_Response([
        'error' => $this->errorMessage,
        'statusCode' => $this->statusCode,
      ], $this->statusCode);
    }

    return new WP_REST_Response([
      'data' => $this->data,
      'statusCode' => $this->statusCode,
    ], 200);
  }
}
