<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Repositories\Contracts\UserRepositoryInterface;
use App\Services\Contracts\UserServiceInterface;
use Illuminate\Http\Request;

class UserController extends Controller
{
    private UserRepositoryInterface $userRepository;
    private UserServiceInterface $userService;

    public function __construct(UserServiceInterface $userService,  UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
        $this->userService = $userService;
    }

    public function index()
    {
        return $this->userRepository->index();
    }

    public function show(string $id)
    {
        return $this->userRepository->show($id);
    }

    public function register(Request $request)
    {
        return $this->userService->register($request);
    }

    public function login(Request $request)
    {
        return $this->userService->login($request);
    }

    public function logout()
    {
        return $this->userService->logout();
    }

    public function user(Request $request)
    {
        return $this->userService->user($request);
    }

    public function update(string $id, Request $request)
    {
        return $this->userService->update($id, $request);
    }

    public function destroy(string $id)
    {
        return $this->userService->destroy($id);
    }
}
