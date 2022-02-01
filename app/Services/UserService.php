<?php

namespace App\Services;
use App\Repositories\UserRepository;

class UserService
{   
    protected $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function create($data) {
        return $this->userRepository->create($data);
    }

    public function update($data, $user_id) {
        return $this->userRepository->update($data, $user_id);
    }

    public function list($request, $orderByField, $orderByOrder, $paginate) {
        return $this->userRepository->list($request, $orderByField, $orderByOrder, $paginate);
    }

    public function find($user_id) {
        return $this->userRepository->find($user_id);
    }

    public function first($data) {
        return $this->userRepository->first($data);
    }

    public function destroy($user_id) {
        return $this->userRepository->destroy($user_id);
    }

    public function allStatus() {
        return $this->userRepository->allStatus();
    }    
}
