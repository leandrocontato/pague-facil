<?php

namespace App\Repositories;
use App\Models\Card;

class CardRepository
{
    protected $card;

    public function __construct(Card $card)
    {
        $this->card = $card;
    }

    public function create($data) {
        return $this->card->create($data);
    }

    public function findIdCustomer($custumer_id){
        return $this->card->where('customer_id', $custumer_id)->get();
    }

    public function update($data, $card_id) {
        return tap($this->card->findOrFail($card_id))->update($data);
    }

    public function list($request, $orderByField, $orderByOrder, $paginate) {

        $fillable = $this->card->getFillable();
        $card = $this->card->orderBy($orderByField, $orderByOrder);

        foreach ($request->all() as $field => $filter) {
            
            if (in_array($field, $fillable)) {

                switch ($field) {
                    case 'created_at':
                    case 'updated_at':
                    case 'deleted_at': 
                        if ($request->input($field)) {
                            $card->whereDate($field, $filter);
                        }                        
                        break;
                    case 'card':
                        if ($request->input($field)) {
                            $card->where($field, "like", "%".$filter."%");
                        }                         
                        break; 
                    case 'card_id': 
                        $card->whereHas('state', function($query) use($field, $filter) {
                            return $query->where($field, $filter);
                        });  
                        break;                    
                    default:
                        if ($request->input($field)) {
                            $card->where($field, $filter);
                        }                         
                        break;
                }
               
            }
        }

        return $card->paginate($paginate);
    }

    public function find($card_id) {
        return $this->card->findOrFail($card_id);
    }

    public function first($data) {
        
        $fillable = $this->card->getFillable();
        $card = $this->card;

        foreach ($data as $field => $filter) {
            
            if (in_array($field, $fillable)) {

                switch ($field) {
                    case 'created_at':
                    case 'updated_at':
                    case 'deleted_at': 
                        if ($request->input($field)) {
                            $card->whereDate($field, $filter);
                        }                        
                        break;
                    case 'card':
                        if ($request->input($field)) {
                            $card->where($field, "like", "%".$filter."%");
                        }                         
                        break; 
                    case 'card_id': 
                        $card->whereHas('state', function($query) use($field, $filter) {
                            return $query->where($field, $filter);
                        });  
                        break;                    
                    default:
                        if ($request->input($field)) {
                            $card->where($field, $filter);
                        }                         
                        break;
                }
               
            }
        }

        return $card->first();
    }

    public function destroy($card_id) {
        return tap($this->card->findOrFail($card_id))->delete();
    }

    public function allStatus() {
        return $this->card->allStatus();
    }
}
