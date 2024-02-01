<?php

namespace App\Services;

use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Carbon;

class envioXmlsService
{
    private $timezone = 'America/Sao_Paulo';
    public function validarRequest($request)
    {
        $pastaConsulta = $request->input('pasta');

        if (
            isset($pastaConsulta) &&
            ($pastaConsulta == 'xmlsEc' | $pastaConsulta == 'xmlsEs' | $pastaConsulta == 'xmlsRio')
        ) {
            $this->buscarXmls($pastaConsulta);
        } else {
            return [
                'status' => false,
                'mensagem' => "Parametro da pasta para consulta nao foi enviado ou esta invalido"

            ];
        }
    }
    public function buscarXmls($pasta)
    {

        $files = Storage::disk($pasta)->allFiles();

        foreach ($files as $pos =>  $diretorio) {
            if (!stristr(strtolower($diretorio), '.xml')) {
                continue;
            } else {
                $dataModificao = Carbon::parse(Storage::disk($pasta)->lastModified($diretorio), $this->timezone)->format('d-m-Y H:i:s');
                if ($dataModificao >= Carbon::now($this->timezone)->subDays(1)->startOfDay()->format('d-m-Y H:i:s')){
                    $logEnvio = json_decode(Storage::get('logsEnvio.json'));
                    $validaEnvio = array_search("$diretorio",$logEnvio);
                    if ($validaEnvio !== false){
                        
                    }else {
                        continue;
                    }
                }else{
                    continue;
                }
            }
        }
    }
}
