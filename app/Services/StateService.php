<?php

namespace App\Services;
use App\Repositories\StateRepository;

class StateService
{   
    protected $stateRepository;

    public function __construct(StateRepository $stateRepository)
    {
        $this->stateRepository = $stateRepository;
    }

    public function create($data) {
        return $this->stateRepository->create($data);
    }

    public function update($data, $state_id) {
        return $this->stateRepository->update($data, $state_id);
    }

    public function list($request, $orderByField, $orderByOrder, $paginate) {
        return $this->stateRepository->list($request, $orderByField, $orderByOrder, $paginate);
    }

    public function find($state_id) {
        return $this->stateRepository->find($state_id);
    }

    public function first($data) {
        return $this->stateRepository->first($data);
    }

    public function destroy($state_id) {
        return $this->stateRepository->destroy($state_id);
    }   

    public function allStatus() {
        return $this->stateRepository->allStatus();
    }  
}
