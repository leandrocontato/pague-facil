<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Services\UserService;

class UserController extends Controller
{   
    protected $userService;

    public function __construct(UserService $userService)
    {
        parent::__construct();

        $this->userService = $userService;
    }

    public function index(Request $request)
    {
        $paginate     = ($request->input('per_page')) ? $request->input('per_page') : 0;
        $orderByField = ($request->input('order_by_field')) ? $request->input('order_by_field') : 'user_id';
        $orderByOrder = ($request->input('order_by_order')) ? $request->input('order_by_order') : 'DESC';

        return view('dashboard.user.index', [
            'bodyClass' => 'user',
            'users'     => $this->userService->list($request, $orderByField, $orderByOrder , $paginate),
            'allStatus' => $this->userService->allStatus()
        ]);
    }

    public function create()
    {
        return view('dashboard.user.show', [
            'bodyClass' => 'user',
            'allStatus' => $this->userService->allStatus()
        ]);
    }

    public function store(StoreUserRequest $request)
    {
        try {
            $this->userService->create($request->all());
            $request->session()->flash('alert', array('code'=> 'success', 'text'  => "Cadastro realizado com sucesso!"));
            return redirect(route("dashboard-user"));
            
        } catch (Exception $e) {
            $request->session()->flash('alert', array('code'=> 'danger', 'text'  => $e->getMessage()));
            return redirect(route("dashboard-user"));
        }
    }

    public function show($user_id)
    {
        $user = $this->userService->find($user_id);

        if(empty($user)) {
            abort(404);
        }
        
        return view('dashboard.user.show', [
            'bodyClass' => 'user',
            'allStatus' => $this->userService->allStatus(),
            'user'      => $user
        ]);
    }

    public function update(UpdateUserRequest $request, $user_id)
    {
        try {

            $this->userService->update((!empty($request->input('password'))) ? $request->except([]) : $request->except(["password"]), $user_id);

            $request->session()->flash('alert', array('code'=> 'success', 'text'  => "Cadastro atualizado com sucesso!"));
            return redirect(route("dashboard-user"));
            
        } catch (Exception $e) {
            $request->session()->flash('alert', array('code'=> 'danger', 'text'  => $e->getMessage()));
            return redirect(route("dashboard-user"));
        }           
    }

    public function destroy(Request $request, $user_id)
    {
        try {
            $this->userService->destroy($user_id);
            $request->session()->flash('alert', array('code'=> 'success', 'text'  => 'Registro excluido com sucesso!'));

        } catch (Exception $e) {
            $request->session()->flash('alert', array('code'=> 'danger', 'text'  => $e->getMessage()));              
        }

        return redirect(route("dashboard-user"));    
    }
}
