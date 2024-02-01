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
       $return = $this->envioXmlsService->validarRequest($request);
       return $return;
    }
}
