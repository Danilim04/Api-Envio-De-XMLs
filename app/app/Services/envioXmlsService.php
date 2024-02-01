<?php

namespace App\Services;

use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Carbon;
use ZipArchive;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class envioXmlsService
{
    private $timezone = 'America/Sao_Paulo';
    public function buscarXmls($pasta)
    {

        $files = Storage::disk($pasta)->allFiles();
        $fileTemp = tempnam(Storage::disk('zip')->path('/'), 'temp');
        $nameTemp = $fileTemp . '.zip';
        $zip = new ZipArchive();
        $zip->open($nameTemp, ZipArchive::CREATE);
        foreach ($files as $diretorio) {
            if (!stristr(strtolower($diretorio), '.xml')) {
                continue;
            } else {
                $dataModificao = Carbon::parse(Storage::disk($pasta)->lastModified($diretorio), $this->timezone);
                if ($dataModificao >= Carbon::now($this->timezone)->subDays(5)->startOfDay()) {
                    $logEnvio = json_decode(Storage::get('logsEnvio.json'));
                    $validaEnvio = array_search("$diretorio", $logEnvio);
                    if ($validaEnvio !== false) {
                        continue;
                    } else {
                        $zip->addFile(Storage::disk($pasta)->path($diretorio), basename($diretorio));
                        $logEnvioNovo = $logEnvio;
                        $logEnvioNovo[] = $diretorio;
                        $envio = true;
                    }
                } else {
                    continue;
                }
            }
        }
        if (isset($envio) && $envio) {
            if (!Storage::put('logsEnvio.json',  json_encode($logEnvioNovo))) {
                return [
                    "status" => false,
                    "mensagem" => "erro ao gravar registro de envio"
                ];
            } else {
                $gravarEnvio = true;
            }
        } else {
            return [
                "status" => true,
                "mensagem" => "Nao existem arquivos para enviar"
            ];
        }
        $zip->close();
        if ($gravarEnvio) {
            $envioEmail = $this->envioEmail($nameTemp);
            return [
                "status" => true,
                "mensagem" => "Os arquivos foram enviados com sucesso"
            ];
        } else {
            return [
                "status" => false,
                "mensagem" => "houve algum erro para gravar o envio"
            ];
        }
    }
    public function envioEmail($arquivo)
    {
        try {
            $mail = new PHPMailer(true);
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'danielazapfy@gmail.com';
            $mail->Password = 'vgxr uvcg psrp uttx';
            $mail->SMTPSecure = 'tls';
            $mail->Port = 587;

            $mail->setFrom('danielazapfy@gmail.com', 'Daniel');
            $mail->addAddress('daniel.ferraz@azapfy.com.br', 'xmlAzapfy');

            $mail->isHTML(true);
            $mail->Subject = 'Arquivo de XMLs da Carvalho' . time();
            $mail->Body = 'Arquivo de Xmls da Caralho';
            $mail->addAttachment($arquivo);
            $mail->send();
            $arquivosEnviados[] = $arquivo;
            return $arquivosEnviados;
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }
}
