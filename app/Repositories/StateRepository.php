<?php

namespace App\Repositories;
use App\Models\State;

class StateRepository
{
    protected $state;

    public function __construct(State $state)
    {
        $this->state = $state;
    }

    public function create($data) {
        return $this->state->create($data);
    }

    public function update($data, $state_id) {
        return tap($this->state->findOrFail($state_id))->update($data);
    }

    public function list($request, $orderByField, $orderByOrder, $paginate) {

        $fillable = $this->state->getFillable();
        $state = $this->state->orderBy($orderByField, $orderByOrder);

        foreach ($request->all() as $field => $filter) {
            
            if (in_array($field, $fillable)) {

                switch ($field) {
                    case 'created_at':
                    case 'updated_at':
                    case 'deleted_at': 
                        if ($request->input($field)) {
                            $state->whereDate($field, $filter);
                        }                         
                        break;
                    case 'name':
                    case 'initial':
                        if ($request->input($field)) {
                            $state->where($field, "like", "%".$filter."%");
                        }                         
                        break;                    
                    default:
                        if ($request->input($field)) {
                            $state->where($field, $filter);
                        }                         
                        break;
                }
               
            }
        }

        return $state->paginate($paginate);
    }

    public function find($state_id) {
        return $this->state->findOrFail($state_id);
    }

    public function first($data) {
        
        $fillable = $this->state->getFillable();
        $state = $this->state;

        foreach ($data as $field => $filter) {
            
            if (in_array($field, $fillable)) {

                switch ($field) {
                    case 'created_at':
                    case 'updated_at':
                    case 'deleted_at': 
                        if ($request->input($field)) {
                            $state->whereDate($field, $filter);
                        }                         
                        break;
                    case 'name':
                    case 'initial':
                        if ($request->input($field)) {
                            $state->where($field, "like", "%".$filter."%");
                        }                         
                        break;                    
                    default:
                        if ($request->input($field)) {
                            $state->where($field, $filter);
                        }                         
                        break;
                }
               
            }
        }

        return $state->first();
    }

    public function destroy($state_id) {
        return tap($this->state->findOrFail($state_id))->delete();
    }

    public function allStatus() {
        return $this->state->allStatus();
    }
}
