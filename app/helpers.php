<?php

if(!function_exists('validateCpf')){
    function validateCpf(string $cpf)
    {
        $cpf = preg_replace('/[^0-9]/is', '', $cpf);

        if (strlen($cpf) != 11) {
            return false;
        }

        if (preg_match('/(\d)\1{10}/', $cpf)) {
            return false;
        }

        for ($t = 9; $t < 11; $t++) {
            for ($d = 0, $c = 0; $c < $t; $c++) {
                $d += $cpf[$c] * (($t + 1) - $c);
            }

            $d = ((10 * $d) % 11) % 10;

            if ($cpf[$c] != $d) {
                return false;
            }
        }

        return true;
    }
}

if(!function_exists('validaCNPJ')){
    function validaCNPJ(string $cnpj)
    {
        $cnpj = preg_replace('/[^0-9]/', '', (string) $cnpj);

        if (strlen($cnpj) != 14)
            return false;

        if (preg_match('/(\d)\1{13}/', $cnpj))
            return false;

        for ($i = 0, $j = 5, $soma = 0; $i < 12; $i++) {
            $soma += $cnpj[$i] * $j;
            $j = ($j == 2) ? 9 : $j - 1;
        }

        $resto = $soma % 11;

        if ($cnpj[12] != ($resto < 2 ? 0 : 11 - $resto))
            return false;

        for ($i = 0, $j = 6, $soma = 0; $i < 13; $i++) {
            $soma += $cnpj[$i] * $j;
            $j = ($j == 2) ? 9 : $j - 1;
        }

        $resto = $soma % 11;
        return $cnpj[13] == ($resto < 2 ? 0 : 11 - $resto);
    }
}

if(!function_exists('removeSpecialCaracters')){
    function removeSpecialCaracters(string $string): string
    {
        $string = str_replace(' ', '-', $string);
        return str_replace('-', '', preg_replace('/[^A-Za-z0-9\-]/', '', $string));
    }
}

if(!function_exists('cortaEmail')){
function cortaEmail(string $email, $qtdCaracteres = 2)
    {
        $dominio = strrchr($email, "@");
        $posicaoDominio = strpos($email, $dominio);

        if ($qtdCaracteres > $posicaoDominio) {
            $qtdCaracteres = $posicaoDominio;
        }

        $emailParcial = substr($email, 0, $qtdCaracteres);

        if ($qtdCaracteres == $posicaoDominio) {
            return "{$emailParcial}{$dominio}";
        } else {
            return "$emailParcial...$dominio";
        }
    }
}

if(!function_exists('randomString')){
    function randomString()
    {
        $listAlpha = 'abcdefghijklmnopqrstuvwxyz'.date('Y-m-dH:i:s').'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
        $validador = substr(str_shuffle($listAlpha), 0, 30);

        return $validador;
    }
}

if(!function_exists('randomStringWithNumbers')){
    function randomStringWithNumbers()
    {
        $listAlpha = 'abcdefghijklmnopqrstuvwxyz';
        $listNumeros = '0123456789';
        $validador = substr(str_shuffle($listNumeros), 0, 8);

        return $validador;
    }
}

if(!function_exists('toBrDate')){
    function toBrDate($unknowFormatDate = NULL, $flgIncludeTime = true, $flgIncludeSeg = true, $flgIncludeMilSeg = false)
    {
        if (trim($unknowFormatDate) == '' || $unknowFormatDate == NULL)
            return '';
        $dateAux = explode(" ", $unknowFormatDate);
        $separador = strstr($dateAux[0], "/") ? "/" : "-";
        $dateAux2 = explode($separador, $dateAux[0]);

        if (strlen($dateAux2[0]) == 4) {
            $retorno = $dateAux2[2] . "/" . $dateAux2[1] . "/" . $dateAux2[0];
        } else {
            $retorno = $dateAux2[0] . "/" . $dateAux2[1] . "/" . $dateAux2[2];
        }

        if ($flgIncludeTime && isset($dateAux[1])) {
            if (!$flgIncludeSeg) {
                $retorno .= " " . limitarStr($dateAux[1], 5, '');
            } else if (!$flgIncludeMilSeg) {
                $retorno .= " " . limitarStr($dateAux[1], 8, '');
            } else {
                $retorno .= " " . $dateAux[1];
            }
        }
        return $retorno;
    }
}

if(!function_exists('limitarStr')){
    function limitarStr($minhaStr, $tamLimite, $strAnexa = "...")
    {
        if (strlen($minhaStr) > $tamLimite) {
            return substr($minhaStr, 0, $tamLimite) . $strAnexa;
        } else {
            return $minhaStr;
        }
    }
}

if(!function_exists('toSqlDate')){
    function toSqlDate($unknowFormatDate, $flgIncludeTime = true)
    {
        if (trim($unknowFormatDate) == '')
            return '';
        $dateAux = explode(" ", $unknowFormatDate);
        $separador = strstr($dateAux[0], "/") ? "/" : "-";
        $dateAux2 = explode($separador, $dateAux[0]);

        if (strlen($dateAux2[0]) == 4) {
            $retorno = $dateAux2[0] . "-" . $dateAux2[1] . "-" . $dateAux2[2];
        } else {
            $retorno = $dateAux2[2] . "-" . $dateAux2[1] . "-" . $dateAux2[0];
        }

        if ($flgIncludeTime && isset($dateAux[1])) {
            $retorno .= " " . $dateAux[1];
        }
        return $retorno;
    }
}

if(!function_exists('convertDate')){
    function convertDate($date, $format) {
        $dateTime = new DateTime($date);

        return $dateTime->format($format);
    }
}

if(!function_exists('calculateAge')){
    function calculateAge($birthdate)
    {
        $birthDate = new DateTime($birthdate);
        $currentDate = new DateTime();

        $interval = $currentDate->diff($birthDate);
        return $interval->y;
    }
}

if(!function_exists('advanceMinutesInDate')){
    function advanceMinutesInDate(string $dateString, $minutes)
    {
        $dateTime = new DateTime($dateString);
        $dateTime->add(new DateInterval('PT' . $minutes . 'M'));

        return $dateTime->format('Y-m-d H:i:s');
    }
}

if(!function_exists('cutRegistroOcorrencia')){
    function cutRegistroOcorrencia(string $registroOcorrencia)
    {
        if(empty($registroOcorrencia)){
            return $registroOcorrencia;
        }

        $partsArray = str_split($registroOcorrencia, 4);
        $formattedString = implode(' ', $partsArray);

        return $formattedString;
    }
}

if(!function_exists('maskInput')){
    function maskInput($mask,$str){

        $str = str_replace(" ","", $str);

        for($i=0;$i<strlen($str);$i++){
            $mask[strpos($mask,"#")] = $str[$i];
        }

        return $mask;
    }
}

