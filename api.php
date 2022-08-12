<?php
    header('Content-Type: text/html; charset=UTF-8');
    if (isset($_GET['posicion']) && isset($_GET['nombre'])) { // Validamos que la url contenga los campos de posicion y nombre
        if(is_numeric($_GET['posicion']) && $_GET['nombre'] != ''){ // Validamos que la posicion contenga números y el nombre no esté vacío
            $position = $_GET['posicion']; // Obtenemos el valos de posicion
            $name = $_GET['nombre']; // Obtenemos el nombre
            $fibRes = fibNum($position); // Mandamos a llamar a la función que nos retorna el valor de la serie fibonacci
            $res = array('Número' => $fibRes, 'Nombre' => $name);
            echo json_encode($res, JSON_UNESCAPED_UNICODE);
        }
        else { // Envíamos el error
            sendError(400.1, "El nombre no debe estar vacío y la posición debe ser un número");
        }
    }
    else { // Envíamos el error
        sendError(400.2, "Se debe mandar un nombre y una posición");
    }

    // Función para obtener el número fibonacci basado en la posición
    function fibNum($n){
        return round(1.618 ** $n / 2.236);
    }

    // Función para enviar errores
    function sendError($errCode, $errMsg){
        http_response_code($errCode);
        echo json_encode(array('response_code'=>$errCode, 'error_message'=> $errMsg), JSON_UNESCAPED_UNICODE);
    }

?>