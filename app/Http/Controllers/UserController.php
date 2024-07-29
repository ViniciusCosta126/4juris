<?php

namespace App\Http\Controllers;

use App\Actions\Fortify\CreateNewUser;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class UserController extends Controller
{
    protected $createNewUser;

    public function __construct(CreateNewUser $createNewUser)
    {
        $this->createNewUser = $createNewUser;
    }

    public function store(Request $request): JsonResponse
    {
        $result = $this->createNewUser->create($request->all());

        if ($result instanceof \Illuminate\Support\MessageBag) {
            return response()->json(['errors' => $result], 422);
        }

        return response()->json(['user' => $result], 201);
    }
}
