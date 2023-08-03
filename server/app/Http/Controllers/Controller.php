<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * Require Bearer token.
     *
     * @return void
     */
    protected $message = '';
    protected $status = 'fail';
    public function __construct()
    {
        $this->middleware('jwtauth', ['except' => ['login', 'register', 'refresh']]);
    }

    /**
     * Define response structure.
     * 
     * @param $data
     * @return JsonResponse
    */
    protected function response($data): JsonResponse
    {
        return response()->json([
            'success' => $this->status,
            'data' => $data,
            'message' => $this->message,
        ]);
    }
}