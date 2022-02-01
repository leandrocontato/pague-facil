<?php

namespace App\Repositories;
use App\Models\Citie;

class CitieRepository
{
    protected $citie;

    public function __construct(Citie $citie)
    {
        $this->citie = $citie;
    }

    public function create($data) {
        return $this->citie->create($data);
    }

    public function update($data, $citie_id) {
        return tap($this->citie->findOrFail($citie_id))->update($data);
    }

    public function list($request, $orderByField, $orderByOrder, $paginate) {

        $fillable = $this->citie->getFillable();
        $citie = $this->citie->orderBy($orderByField, $orderByOrder);

        foreach ($request->all() as $field => $filter) {
            
            if (in_array($field, $fillable)) {

                switch ($field) {
                    case 'created_at':
                    case 'updated_at':
                    case 'deleted_at': 
                        if ($request->input($field)) {
                            $citie->whereDate($field, $filter);
                        }                        
                        break;
                    case 'name':
                        if ($request->input($field)) {
                            $citie->where($field, "like", "%".$filter."%");
                        }                         
                        break; 
                    case 'countrie_id': 
                        $citie->whereHas('state', function($query) use($field, $filter) {
                            return $query->where($field, $filter);
                        });  
                        break;                    
                    default:
                        if ($request->input($field)) {
                            $citie->where($field, $filter);
                        }                         
                        break;
                }
               
            }
        }

        return $citie->paginate($paginate);
    }

    public function find($citie_id) {
        return $this->citie->findOrFail($citie_id);
    }

    public function first($data) {
        
        $fillable = $this->citie->getFillable();
        $citie = $this->citie;

        foreach ($data as $field => $filter) {
            
            if (in_array($field, $fillable)) {

                switch ($field) {
                    case 'created_at':
                    case 'updated_at':
                    case 'deleted_at': 
                        if ($request->input($field)) {
                            $citie->whereDate($field, $filter);
                        }                        
                        break;
                    case 'name':
                        if ($request->input($field)) {
                            $citie->where($field, "like", "%".$filter."%");
                        }                         
                        break; 
                    case 'countrie_id': 
                        $citie->whereHas('state', function($query) use($field, $filter) {
                            return $query->where($field, $filter);
                        });  
                        break;                    
                    default:
                        if ($request->input($field)) {
                            $citie->where($field, $filter);
                        }                         
                        break;
                }
               
            }
        }

        return $citie->first();
    }

    public function destroy($citie_id) {
        return tap($this->citie->findOrFail($citie_id))->delete();
    }

    public function allStatus() {
        return $this->citie->allStatus();
    }
}
