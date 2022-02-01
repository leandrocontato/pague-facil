<?php

namespace App\Services;
use App\Repositories\CardRepository;

class CardService
{   
    protected $cardRepository;

    public function __construct(CardRepository $cardRepository)
    {
        $this->cardRepository = $cardRepository;
    }

    public function create($data) {
        return $this->cardRepository->create($data);
    }

    public function findIdCustomer($custumer_id){
        return $this->cardRepository->findIdCustomer($custumer_id);
    }

    public function update($data, $card_id) {
        return $this->cardRepository->update($data, $card_id);
    }

    public function list($request, $orderByField, $orderByOrder, $paginate) {
        return $this->cardRepository->list($request, $orderByField, $orderByOrder, $paginate);
    }

    public function find($card_id) {
        return $this->cardRepository->find($card_id);
    }

    public function first($data) {
        return $this->cardRepository->first($data);
    }

    public function destroy($card_id) {
        return $this->cardRepository->destroy($card_id);
    }   

    public function allStatus() {
        return $this->cardRepository->allStatus();
    }  
}
