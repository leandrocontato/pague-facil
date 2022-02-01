<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\StoreCitieRequest;
use App\http\Requests\UpdateCitieRequest;
use App\Http\Resources\CitieResource;
use App\Services\CitieService;


class CitieController extends Controller
{
    protected $citieService;

    public function __construct(CitieService $citieService)
    {
        $this->citieService = $citieService;
    }
    
    /**
     * @OA\GET(
     *     tags={"Cidades"},
     *     summary="Lista as cidades",
     *     description="Retorna a coleção de uma cidades",
     *     path="/citie",
     *     @OA\Response(response="200", description="")
     * )
    */
    public function index(Request $request)
    {
        $paginate     = ($request->input('per_page')) ? $request->input('per_page') : 50;
        $orderByField = ($request->input('order_by_field')) ? $request->input('order_by_field') : 'citie_id';
        $orderByOrder = ($request->input('order_by_order')) ? $request->input('order_by_order') : 'DESC';

        return new CitieResource($this->citieService->list($request, $orderByField, $orderByOrder , $paginate));
    }

    /**
     * @OA\POST(
     *     tags={"Cidades"},
     *     summary="Criação de cidade",
     *     description="Retorna a coleção de uma cidades criada",
     *     path="/citie",
     *     @OA\Response(response="200", description="")
     * )
    */
    public function store(StoreCitieRequest $request)
    {
        return new CitieResource($this->citieService->create($request->all()));
    }

    /**
     * @OA\GET(
     *     tags={"Cidades"},
     *     summary="Lista uma cidade",
     *     description="Retorna a coleção de uma cidade",
     *     path="/citie/{citie_id}",
     *     @OA\Response(response="200", description="")
     * )
    */
    public function show($citie_id)
    {
        return new CitieResource($this->citieService->find($citie_id));
    }

    /**
     * @OA\PUT(
     *     tags={"Cidades"},
     *     summary="Atualiza uma cidade",
     *     description="Retorna a coleção de uma cidade",
     *     path="/citie/{citie_id}",
     *     @OA\Response(response="200", description="")
     * )
    */
    public function update(UpdateCitieRequest $request, $citie_id)
    {
        return new CitieResource($this->citieService->update($request->all(), $citie_id));
    }

    /**
     * @OA\DELETE(
     *     tags={"Cidades"},
     *     summary="Exclui um cidade",
     *     description="Retorna a coleção de uma cidades",
     *     path="/citie/{citie_id}",
     *     @OA\Response(response="200", description="")
     * )
    */
    public function destroy($citie_id)
    {
        return new CitieResource($this->citieService->destroy($citie_id));
    }
}
