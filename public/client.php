<?php

    $url = 'http://localhost/Gerenciador-de-Produtos/public/api';

    $class = '/produtos';
    $param = '';

    $response = file_get_contents($url.$class.$param);

    //echo $response;

    //
    //$response = json_decode($response, 1);
    //var_dump($response);
    //var_dump($response['data'][1]['email']);