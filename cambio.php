<?php

if(isset($_POST['valor'])){
    $valor = floatval($_POST['valor']);
    //$apiURL = "https://v6.exchangerate-api.com/v6/2262ba2b0d62d11fc4a58f0d/latest/USD";
    $apiURL = "https://v6.exchangerate-api.com/v6/2262ba2b0d62d11fc4a58f0d/pair/USD/ARS/{$valor}";

    $iniciarCURL = curl_init($apiURL);

    curl_setopt($iniciarCURL, CURLOPT_RETURNTRANSFER, true);

    $repuesta = curl_exec($iniciarCURL);

    //print_r($repuesta);

    if(curl_errno($iniciarCURL)){
        echo "Error al realizar la solicitud : ".curl_error($iniciarCURL);
        exit;
    }
    
    curl_close($iniciarCURL);

    $datos = json_decode($repuesta, true);

    //print_r($datos);
    //print_r($datos['conversion_result']);
    $fecha = substr($datos['time_last_update_utc'],4 ,-5);
    //echo  "<br>".$datos['time_last_update_utc']."<br>";
    echo "Tipo de cambio a la fecha ".$fecha.": $".$datos['conversion_rate']."<br>
          Valor resultante: $".$datos['conversion_result'];




}

?>