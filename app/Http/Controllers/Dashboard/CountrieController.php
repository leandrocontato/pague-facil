<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCountrieRequest;
use App\Http\Requests\UpdateCountrieRequest;
use App\Services\CountrieService;

class CountrieController extends Controller
{   
    protected $countrieService;

    public function __construct(CountrieService $countrieService)
    {
        parent::__construct();

        $this->countrieService = $countrieService;
    }

    public function index(Request $request)
    {
        $paginate     = ($request->input('per_page')) ? $request->input('per_page') : 0;
        $orderByField = ($request->input('order_by_field')) ? $request->input('order_by_field') : 'countrie_id';
        $orderByOrder = ($request->input('order_by_order')) ? $request->input('order_by_order') : 'DESC';

        return view('dashboard.countrie.index', [
            'bodyClass' => 'countrie',
            'countries' => $this->countrieService->list($request, $orderByField, $orderByOrder , $paginate),
            'allStatus' => $this->countrieService->allStatus()
        ]);
    }

    public function create()
    {
        return view('dashboard.countrie.show', [
            'bodyClass' => 'countrie',
            'allStatus' => $this->countrieService->allStatus()
        ]);
    }

    public function store(StoreCountrieRequest $request)
    {
        try {
            $this->countrieService->create($request->all());
            $request->session()->flash('alert', array('code'=> 'success', 'text'  => "Cadastro realizado com sucesso!"));
            return redirect(route("dashboard-countrie"));
            
        } catch (Exception $e) {
            $request->session()->flash('alert', array('code'=> 'danger', 'text'  => $e->getMessage()));
            return redirect(route("dashboard-countrie"));
        }
    }

    public function show($countrie_id)
    {
        $countrie = $this->countrieService->find($countrie_id);

        if(empty($countrie)) {
            abort(404);
        }
        
        return view('dashboard.countrie.show', [
            'bodyClass' => 'countrie',
            'allStatus' => $this->countrieService->allStatus(),
            'countrie'  => $countrie
        ]);
    }

    public function update(UpdateCountrieRequest $request, $countrie_id)
    {
        try {

            $this->countrieService->update((!empty($request->input('password'))) ? $request->except([]) : $request->except(["password"]), $countrie_id);

            $request->session()->flash('alert', array('code'=> 'success', 'text'  => "Cadastro atualizado com sucesso!"));
            return redirect(route("dashboard-countrie"));
            
        } catch (Exception $e) {
            $request->session()->flash('alert', array('code'=> 'danger', 'text'  => $e->getMessage()));
            return redirect(route("dashboard-countrie"));
        }           
    }

    public function destroy(Request $request, $countrie_id)
    {
        try {
            $this->countrieService->destroy($countrie_id);
            $request->session()->flash('alert', array('code'=> 'success', 'text'  => 'Registro excluido com sucesso!'));

        } catch (Exception $e) {
            $request->session()->flash('alert', array('code'=> 'danger', 'text'  => $e->getMessage()));              
        }

        return redirect(route("dashboard-countrie"));    
    }
}
