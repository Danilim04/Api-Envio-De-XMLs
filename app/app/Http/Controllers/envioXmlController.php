<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\envioXmlsService;

class envioXmlController extends Controller
{
    private $envioXmlsService;

    public function __construct(envioXmlsService $envioXmlsService)
    {
        $this->envioXmlsService = $envioXmlsService;
    }

    public function envioxml(Request $request)
    {
        $return = $this->validarRequest($request);
        return $return;
    }
    public function validarRequest($request)
    {
        $pastaConsulta = $request->input('pasta');
        $dias = $request->input('diasAtras');
        $diasAtras = isset($dias) ? $dias : 1;
        if (
            isset($pastaConsulta) &&
            ($pastaConsulta == 'xmlsEc' | $pastaConsulta == 'xmlsEs' | $pastaConsulta == 'xmlsRio')
        ) {
            $retorno = $this->envioXmlsService->buscarXmls($pastaConsulta,$diasAtras);
            return $retorno;
        } else {
            return [
                'status' => false,
                'mensagem' => "Parametro da pasta para consulta nao foi enviado ou esta invalido"

            ];
        }
    }
}
