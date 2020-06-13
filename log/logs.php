<?php

function logs($texto){

    $hora = date("H:i:s"); // pega a hora
    $data = date("d-m-Y"); // pega o dia
    $logFile = 'log';
    /*

        o "a+" abaixo significa:
        - Abre o arquivo para leitura e gravação; 
        - coloca o ponteiro no fim do arquivo. 
        - Se o arquivo não existir, tentar criá-lo.

    */
    $log = fopen("log/".$logFile.".txt", "a+");

    $escreve = fwrite($log, $data." - ".$hora." - ".$texto."\n");// Escreve

    fclose($log); // Fecha o arquivo

}