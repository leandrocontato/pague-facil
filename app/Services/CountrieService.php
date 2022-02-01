<?php

namespace App\Services;
use App\Repositories\CountrieRepository;

class CountrieService
{   
    protected $countrieRepository;

    public function __construct(CountrieRepository $countrieRepository)
    {
        $this->countrieRepository = $countrieRepository;
    }

    public function create($data) {
        return $this->countrieRepository->create($data);
    }

    public function update($data, $countrie_id) {
        return $this->countrieRepository->update($data, $countrie_id);
    }

    public function list($request, $orderByField, $orderByOrder, $paginate) {
        return $this->countrieRepository->list($request, $orderByField, $orderByOrder, $paginate);
    }

    public function find($countrie_id) {
        return $this->countrieRepository->find($countrie_id);
    }

    public function first($data) {
        return $this->countrieRepository->first($data);
    }

    public function destroy($countrie_id) {
        return $this->countrieRepository->destroy($countrie_id);
    }   

    public function allStatus() {
        return $this->countrieRepository->allStatus();
    } 
}
