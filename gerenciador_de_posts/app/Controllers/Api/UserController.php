<?php

namespace App\Controllers\Api;

use App\Controllers\BaseController;
use App\Models\User;
use CodeIgniter\API\ResponseTrait;

class UserController extends BaseController
{
    use ResponseTrait;

    public function index()
    {
        return $this->respond(['message' => 'API de usuários online']);
    }
}
