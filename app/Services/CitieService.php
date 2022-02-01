<?php

namespace App\Services;
use App\Repositories\CitieRepository;

class CitieService
{   
    protected $citieRepository;

    public function __construct(CitieRepository $citieRepository)
    {
        $this->citieRepository = $citieRepository;
    }

    public function create($data) {
        return $this->citieRepository->create($data);
    }

    public function update($data, $citie_id) {
        return $this->citieRepository->update($data, $citie_id);
    }

    public function list($request, $orderByField, $orderByOrder, $paginate) {
        return $this->citieRepository->list($request, $orderByField, $orderByOrder, $paginate);
    }

    public function find($citie_id) {
        return $this->citieRepository->find($citie_id);
    }

    public function first($data) {
        return $this->citieRepository->first($data);
    }

    public function destroy($citie_id) {
        return $this->citieRepository->destroy($citie_id);
    }   

    public function allStatus() {
        return $this->citieRepository->allStatus();
    }  
}
