<?php

$url = "http://localhost:8000";

$fecha = new DateTime('now', new DateTimeZone('Europe/Madrid'));
$fecha = $fecha->format('Y-m-d H:i:s');

//Credenciales del usuario, si no son válidas se cancela la conexión
$user = "nombreejemplo";
$pw = "282hdbd73bhwks982jhwhs2";

//Determinamos la acción que vamos a realizar (post, put, delete)
$accion = 'actualizar_producto';

switch( $accion ) {
    
    case 'nuevo_producto':

        $data = [
            'nombre' => 'Nuevo coche3',
            'categoria' => 'Audi',
        	'precio_iva_excl' => '100',
        	'id_iva' => '2',
        	'fecha_add' => $fecha,
        	'fecha_upd' => $fecha
        ];
         
        $payload = json_encode( $data );
         
        $ch = curl_init("$url/productos");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLINFO_HEADER_OUT, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
         
        curl_setopt($ch, CURLOPT_HTTPHEADER,
        	[ 
        	    'Content-Type: application/json',
        	    'Content-Length: ' . strlen($payload),
        	    "X-USER: $user",
        	    "X-PW: $pw",
        	]
        );
         
        $result = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE );
        
        curl_close($ch);
        
    break;
    
    case 'actualizar_producto':

        $id_producto = 8;
        
        $data = [
            'nombre' => 'Coche Audi azul',
            'categoria' => 'Audi',
        	'precio_iva_excl' => '125',
        	'id_iva' => '1',
        	'fecha_add' => $fecha,
        	'fecha_upd' => $fecha
        ];
         
        $payload = json_encode( $data );
         
        $ch = curl_init("$url/productos/$id_producto");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLINFO_HEADER_OUT, true);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PUT');
        curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
         
        curl_setopt($ch, CURLOPT_HTTPHEADER,
        	[ 
        	    'Content-Type: application/json',
        	    'Content-Length: ' . strlen($payload),
        	    "X-USER: $user",
        	    "X-PW: $pw",
        	]
        );
         
        $result = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE );
        
        curl_close($ch);
        
    break;
    
    case 'eliminar_producto':

        $id_producto = 8;
         
        $ch = curl_init("$url/productos/productos/$id_producto");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLINFO_HEADER_OUT, true);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'DELETE');
         
        curl_setopt($ch, CURLOPT_HTTPHEADER,
        	[ 
        	    "X-USER: $user",
        	    "X-PW: $pw",
        	]
        );
         
        $result = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE );
        
        curl_close($ch);
        
    break;
    
}

//Ejemplo de manejo de errores
switch ( $httpCode ) {
    
    case 200:
        echo"Conexión realizada con éxito";
        break;
    case 400:
        echo"Solicitud de recurso incorrecta";
        break;
    case 500:
        echo"El servidor ha fallado";
        break;
}