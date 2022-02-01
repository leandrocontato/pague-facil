<?php

namespace App\Repositories;
use App\Models\User;

class UserRepository
{
    protected $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function create($data) {
        return $this->user->create($data);
    }

    public function update($data, $user_id) {
        return tap($this->user->findOrFail($user_id))->update($data);
    }

    public function list($request, $orderByField, $orderByOrder, $paginate) {

        $fillable = $this->user->getFillable();
        $user = $this->user->orderBy($orderByField, $orderByOrder);

        foreach ($request->all() as $field => $filter) {
            if (in_array($field, $fillable)) {

                switch ($field) {
                    case 'created_at':
                    case 'updated_at':
                    case 'deleted_at': 
                        if ($request->input($field)) {
                            $user->whereDate($field, $filter);
                        }                        
                        break;
                    case 'first_name':
                    case 'last_name':
                        if ($request->input($field)) {
                            $user->where($field, "like", "%".$filter."%");
                        }                          
                        break;                    
                    default:
                        if ($request->input($field)) {
                            $user->where($field, $filter);
                        }                        
                        break;
                }
               
            }
        }

        return $user->paginate($paginate);
    }

    public function find($user_id) {
        return $this->user->findOrFail($user_id);
    }

    public function first($data) {
        
        $fillable = $this->user->getFillable();
        $user     = $this->user;

        foreach ($data as $field => $filter) {
            
            if (in_array($field, $fillable)) {

                switch ($field) {
                    case 'created_at':
                    case 'updated_at':
                    case 'deleted_at': 
                        if ($request->input($field)) {
                            $user->whereDate($field, $filter);
                        }                        
                        break;
                    case 'first_name':
                    case 'last_name':
                        if ($request->input($field)) {
                            $user->where($field, "like", "%".$filter."%");
                        }                          
                        break;                    
                    default:
                        if ($request->input($field)) {
                            $user->where($field, $filter);
                        }                        
                        break;
                }
               
            }
        }

        return $user->first();
    }

    public function destroy($user_id) {
        return tap($this->user->findOrFail($user_id))->delete();
    }

    public function allStatus() {
        return $this->user->allStatus();
    }
}
