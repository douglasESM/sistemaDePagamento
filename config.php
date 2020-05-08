<?php
    /*Link sandbox, quando terminar os testes você deve tirar este sandbox e mudar o token */
    $link = 'https://ws.sandbox.pagseguro.uol.com.br/v2/session?
    email=douglaserik.tec@gmail.com&
    token=B75CECD11BD342D397AD8D2ED50C1419';
   
    /*iniciando o cURL*/ 
    $_curl = curl_init($link);
    
    /*ESSE É O CONJUNTO DE CARACTERES. COMO UTILIZAMOS CARACTERISTICAS ESPECIAIS, ENTÃO COLOCAMOS POR PADRÃO UTF-8*/ 
    curl_setup($_curl, CURLOPT_HTTPHEADER, array("Content-Type: application/x-www-form-urlencoded; charset=UTF-8"));
    
    /*Autorizando o retorno de informação em string*/
    curl_setup($_curl, CURLOPT_RETURNTRANSFER, true);
    
    /*Tipo de transferencia. o PagSeguro exige que seja por POST, entçao colocamos TRUE*/
    curl_setup($_curl, CURLOP_POST, true);

    /**Executando o cURL */
    $retorno = curl_exec($_curl);
    curl_close($_curl);/**Encerrando o cURL*/

    $retorno = simplexml_load_string($retorno);//Convertendo o XML em uma string
    echo json_encode($retorno);
?>