<?php

namespace App\Repositories;
use App\Models\Countrie;

class CountrieRepository
{
    protected $countrie;

    public function __construct(Countrie $countrie)
    {
        $this->countrie = $countrie;
    }

    public function create($data) {
        return $this->countrie->create($data);
    }

    public function update($data, $countrie_id) {
        return tap($this->countrie->findOrFail($countrie_id))->update($data);
    }

    public function list($request, $orderByField, $orderByOrder, $paginate) {

        $fillable = $this->countrie->getFillable();
        $countrie = $this->countrie->orderBy($orderByField, $orderByOrder);

        foreach ($request->all() as $field => $filter) {
            
            if (in_array($field, $fillable)) {

                switch ($field) {
                    case 'created_at':
                    case 'updated_at':
                    case 'deleted_at': 
                        if ($request->input($field)) {
                            $countrie->whereDate($field, $filter);
                        }                          
                        break;
                    case 'name':
                    case 'initial':
                        if ($request->input($field)) {
                            $countrie->where($field, "like", "%".$filter."%");
                        }                        
                        break;                           
                    default:
                        if ($request->input($field)) {
                            $countrie->where($field, $filter);
                        }                         
                        break;
                }
               
            }
        }

        return $countrie->paginate($paginate);
    }

    public function find($countrie_id) {
        return $this->countrie->findOrFail($countrie_id);
    }

    public function first($data) {
        
        $fillable = $this->countrie->getFillable();
        $countrie = $this->countrie;

        foreach ($data as $field => $filter) {
            
            if (in_array($field, $fillable)) {

                switch ($field) {
                    case 'created_at':
                    case 'updated_at':
                    case 'deleted_at': 
                        if ($request->input($field)) {
                            $countrie->whereDate($field, $filter);
                        }                          
                        break;
                    case 'name':
                    case 'initial':
                        if ($request->input($field)) {
                            $countrie->where($field, "like", "%".$filter."%");
                        }                        
                        break;                           
                    default:
                        if ($request->input($field)) {
                            $countrie->where($field, $filter);
                        }                         
                        break;
                }
               
            }
        }

        return $countrie->first();
    }

    public function destroy($countrie_id) {
        return tap($this->countrie->findOrFail($countrie_id))->delete();
    }

    public function allStatus() {
        return $this->countrie->allStatus();
    }
}
