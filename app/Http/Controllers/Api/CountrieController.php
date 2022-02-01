<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\StoreCountrieRequest;
use App\http\Requests\UpdateCountrieRequest;
use App\Http\Resources\CountrieResource;
use App\Services\CountrieService;


class CountrieController extends Controller
{
    protected $countrieService;

    public function __construct(CountrieService $countrieService)
    {
        $this->countrieService = $countrieService;
    }
    
    /**
     * @OA\GET(
     *     tags={"Paises"},
     *     summary="Lista os paises",
     *     description="Retorna a coleção de paises",
     *     path="/countrie",
     *     @OA\Response(response="200", description="")
     * )
    */
    public function index(Request $request)
    {
        $paginate     = ($request->input('per_page')) ? $request->input('per_page') : 50;
        $orderByField = ($request->input('order_by_field')) ? $request->input('order_by_field') : 'countrie_id';
        $orderByOrder = ($request->input('order_by_order')) ? $request->input('order_by_order') : 'DESC';

        return new CountrieResource($this->countrieService->list($request, $orderByField, $orderByOrder , $paginate));
    }

    /**
     * @OA\POST(
     *     tags={"Paises"},
     *     summary="Criação de pais",
     *     description="Retorna a coleção do pais criado",
     *     path="/countrie",
     *     @OA\Response(response="200", description="")
     * )
    */
    public function store(StoreCountrieRequest $request)
    {
        return new CountrieResource($this->countrieService->create($request->all()));
    }

    /**
     * @OA\GET(
     *     tags={"Paises"},
     *     summary="Lista um pais",
     *     description="Retorna a coleção do pais",
     *     path="/countrie/{countrie_id}",
     *     @OA\Response(response="200", description="")
     * )
    */
    public function show($countrie_id)
    {
        return new CountrieResource($this->countrieService->find($countrie_id));
    }

    /**
     * @OA\PUT(
     *     tags={"Paises"},
     *     summary="Atualiza um pais",
     *     description="Retorna a coleção do pais",
     *     path="/countrie/{countrie_id}",
     *     @OA\Response(response="200", description="")
     * )
    */
    public function update(UpdateCountrieRequest $request, $countrie_id)
    {
        return new CountrieResource($this->countrieService->update($request->all(), $countrie_id));
    }

    /**
     * @OA\DELETE(
     *     tags={"Paises"},
     *     summary="Exclui um pais",
     *     description="Retorna a coleção do pais",
     *     path="/countrie/{countrie_id}",
     *     @OA\Response(response="200", description="")
     * )
    */
    public function destroy($countrie_id)
    {
        return new CountrieResource($this->countrieService->destroy($countrie_id));
    }
}
