<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\RecoveryEndPointRequest;
use App\Http\Resources\BoletoEndPointResource;

class BoletoController extends Controller
{
    public function RecoveryEndPoint(RecoveryEndPointRequest $request){
        
           return new BoletoEndPointResource([
            "tipo"  => "sucesso",
            "text"  => "Pagamento realizado com sucesso"
        ]);
    }
}
