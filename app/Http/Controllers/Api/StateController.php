<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\StoreStateRequest;
use App\http\Requests\UpdateStateRequest;
use App\Http\Resources\StateResource;
use App\Services\StateService;


class StateController extends Controller
{
    protected $stateService;

    public function __construct(StateService $stateService)
    {
        $this->stateService = $stateService;
    }
    
    /**
     * @OA\GET(
     *     tags={"Estados"},
     *     summary="Lista os estados",
     *     description="Retorna a coleção de estados",
     *     path="/state",
     *     @OA\Response(response="200", description="")
     * )
    */
    public function index(Request $request)
    {
        $paginate     = ($request->input('per_page')) ? $request->input('per_page') : 50;
        $orderByField = ($request->input('order_by_field')) ? $request->input('order_by_field') : 'state_id';
        $orderByOrder = ($request->input('order_by_order')) ? $request->input('order_by_order') : 'DESC';

        return new StateResource($this->stateService->list($request, $orderByField, $orderByOrder , $paginate));
    }

    /**
     * @OA\POST(
     *     tags={"Estados"},
     *     summary="Criação de estado",
     *     description="Retorna a coleção do estado criado",
     *     path="/state",
     *     @OA\Response(response="200", description="")
     * )
    */
    public function store(StoreStateRequest $request)
    {
        return new StateResource($this->stateService->create($request->all()));
    }

    /**
     * @OA\GET(
     *     tags={"Estados"},
     *     summary="Lista um estado",
     *     description="Retorna a coleção do estado",
     *     path="/state/{state_id}",
     *     @OA\Response(response="200", description="")
     * )
    */
    public function show($state_id)
    {
        return new StateResource($this->stateService->find($state_id));
    }

    /**
     * @OA\PUT(
     *     tags={"Estados"},
     *     summary="Atualiza um estado",
     *     description="Retorna a coleção do estado",
     *     path="/state/{state_id}",
     *     @OA\Response(response="200", description="")
     * )
    */
    public function update(UpdateStateRequest $request, $state_id)
    {
        return new StateResource($this->stateService->update($request->all(), $state_id));
    }

    /**
     * @OA\DELETE(
     *     tags={"Estados"},
     *     summary="Exclui um estado",
     *     description="Retorna a coleção do estado",
     *     path="/state/{state_id}",
     *     @OA\Response(response="200", description="")
     * )
    */
    public function destroy($state_id)
    {
        return new StateResource($this->stateService->destroy($state_id));
    }
}
