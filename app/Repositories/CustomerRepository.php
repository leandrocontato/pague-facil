<?php

namespace App\Repositories;
use App\Models\Customer;

class CustomerRepository
{
    protected $customer;

    public function __construct(Customer $customer)
    {
        $this->customer = $customer;
    }

    public function create($data) {
        return $this->customer->create($data);
    }

    public function emailCustomer($customer_email){
        return $this->customer->where('email', $customer_email)->first();
    }

    public function update($data, $customer_id) {
        return tap($this->customer->findOrFail($customer_id))->update($data);
    }

    public function list($request, $orderByField, $orderByOrder, $paginate) {

        $fillable = $this->customer->getFillable();
        $customer = $this->customer->orderBy($orderByField, $orderByOrder);

        foreach ($request->all() as $field => $filter) {
            
            if (in_array($field, $fillable)) {

                switch ($field) {
                    case 'created_at':
                    case 'updated_at':
                    case 'deleted_at': 
                        if ($request->input($field)) {
                            $customer->whereDate($field, $filter);
                        }                         
                        break;
                    case 'first_name':
                    case 'last_name':
                    case 'company_name':
                    case 'fantasy_name': 
                        if ($request->input($field)) {
                           $customer->where($field, "like", "%".$filter."%");
                        }                         
                        break;                    
                    default:
                        if ($request->input($field)) {
                            $customer->where($field, $filter);
                        }                       
                        break;
                }
               
            }
        }

        return $customer->paginate($paginate);
    }

    public function find($customer_id) {
        return $this->customer->findOrFail($customer_id);
    }

    public function first($data) {
        
        $fillable = $this->customer->getFillable();
        $customer = $this->customer;

        foreach ($data as $field => $filter) {
            
            if (in_array($field, $fillable)) {

                switch ($field) {
                    case 'created_at':
                    case 'updated_at':
                    case 'deleted_at': 
                        if ($request->input($field)) {
                            $customer->whereDate($field, $filter);
                        }                         
                        break;
                    case 'first_name':
                    case 'last_name':
                    case 'company_name':
                    case 'fantasy_name': 
                        if ($request->input($field)) {
                           $customer->where($field, "like", "%".$filter."%");
                        }                         
                        break;                    
                    default:
                        if ($request->input($field)) {
                            $customer->where($field, $filter);
                        }                       
                        break;
                }
               
            }
        }

        return $customer->first();
    }

    public function destroy($customer_id) {
        return tap($this->customer->findOrFail($customer_id))->delete();
    }

    public function allStatus() {
        return $this->customer->allStatus();
    }

    public function allTypes() {
        return $this->customer->allTypes();
    }

    public function allAccredited() {
        return $this->customer->allAccredited();
    }    
}
