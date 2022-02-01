<?php

namespace App\Services;
use App\Repositories\CustomerRepository;

class CustomerService
{   
    protected $customerRepository;

    public function __construct(CustomerRepository $customerRepository)
    {
        $this->customerRepository = $customerRepository;
    }

    public function create($data) {
        return $this->customerRepository->create($data);
    }

    public function emailCustomer($customer_email){
        return $this->customerRepository->emailCustomer($customer_email);
    }

    public function update($data, $customer_id) {
        return $this->customerRepository->update($data, $customer_id);
    }

    public function list($request, $orderByField, $orderByOrder, $paginate) {
        return $this->customerRepository->list($request, $orderByField, $orderByOrder, $paginate);
    }

    public function find($customer_id) {
        return $this->customerRepository->find($customer_id);
    }

    public function first($data) {
        return $this->customerRepository->first($data);
    }

    public function destroy($customer_id) {
        return $this->customerRepository->destroy($customer_id);
    }   

    public function allStatus() {
        return $this->customerRepository->allStatus();
    }

    public function allTypes() {
        return $this->customerRepository->allTypes();
    }  

    public function allAccredited() {
        return $this->customerRepository->allAccredited();
    }     
}
