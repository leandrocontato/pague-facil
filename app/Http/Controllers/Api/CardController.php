<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\StoreCardRequest;
use App\http\Requests\UpdateCardRequest;
use App\Http\Resources\CardResource;
use App\Services\CardService;

class CardController extends Controller
{
    protected $cardService;

    public function __construct(CardService $cardService)
    {
        $this->cardService = $cardService;
    }
    
    /**
     * @OA\GET(
     *     tags={"Cartões"},
     *     summary="Lista os cartões",
     *     description="Retorna a coleção dos cartões",
     *     path="/card",
     *     @OA\Response(response="200", description="")
     * )
    */
    public function index(Request $request)
    {
        $paginate     = ($request->input('per_page')) ? $request->input('per_page') : 50;
        $orderByField = ($request->input('order_by_field')) ? $request->input('order_by_field') : 'card_id';
        $orderByOrder = ($request->input('order_by_order')) ? $request->input('order_by_order') : 'DESC';

        return new CardResource($this->cardService->list($request, $orderByField, $orderByOrder , $paginate));
    }

    /**
     * @OA\POST(
     *     tags={"Cartões"},
     *     summary="Criação de cartão",
     *     description="Retorna a coleção do cartão criado",
     *     path="/card",
     *     @OA\Response(response="200", description="")
     * )
    */
    public function store(StoreCardRequest $request)
    {
        return new CardResource($this->cardService->create($request->all()));
    }

    /**
     * @OA\GET(
     *     tags={"Cartões"},
     *     summary="Lista um cartão",
     *     description="Retorna a coleção de um cartão",
     *     path="/card/{card_id}",
     *     @OA\Response(response="200", description="")
     * )
    */
    public function show($card_id)
    {
        return new CardResource($this->cardService->find($card_id));
    }

    /**
     * @OA\PUT(
     *     tags={"Cartões"},
     *     summary="Atualiza um cartão",
     *     description="Retorna a coleção de um cartão",
     *     path="/card/{card_id}",
     *     @OA\Response(response="200", description="")
     * )
    */
    public function update(UpdateCardRequest $request, $card_id)
    {
        return new CardResource($this->cardService->update($request->all(), $card_id));
    }

    /**
     * @OA\DELETE(
     *     tags={"Cartões"},
     *     summary="Exclui um cartão",
     *     description="Retorna a coleção de uma cartão",
     *     path="/cartao/{card_id}",
     *     @OA\Response(response="200", description="")
     * )
    */
    public function destroy($card_id)
    {
        return new CardResource($this->cardService->destroy($card_id));
    }
}
