<?php

    $result = array('code'=> 0, 'message' => '');

    include_once('lib-app.php');
    use namespace_api_gasto as Namespace_api_gasto;
    $api = new Namespace_api_gasto\ApiGasto();

    if($_POST && $_POST['opcion'] == 'Crear'){

        $detalles = $_POST['detalles'];
        $deatallesvalidado = array();
        
        for ($i=0; $i < count($detalles); $i++) { 
            array_push($deatallesvalidado, array("fecha" => $detalles[$i]['fecha'],
                                                "cuenta" => $detalles[$i]['cuenta'],
                                                "descripcion" => $detalles[$i]['descripcion'],
                                                "total" =>  (float)$detalles[$i]['total']));
        }
        
        
        $datos = array(
            "concepto" => $_POST['concepto'],
            "fechadesde" => $_POST['desde'],
            "fechahasta" => $_POST['hasta'],
            "nombre" => $_POST['nombre'],
            "departamento" => $_POST['departamento'],
            "posicion"=> $_POST['posicion'],
            "supervisor"=> $_POST['supervisor'],
            "detallesgasto" =>  $deatallesvalidado,
            "aprobado" =>  $_POST['aprobado']
        );
       
        $resultado = $api->setGasto($datos);

        if(isset($resultado['id'])){
            $result['code'] = 0;
            $result['message'] = 'ok';
        }else{
            $result['code'] = 1;
            $result['message'] = '';
        }

        echo json_encode($result);
        exit;
    }

    if($_GET && $_GET['opcion'] == 'Consultar' && isset($_GET['id']) && $_GET['id'] !=''){
        
        $resultado = $api->getGastoById($_GET['id']);
        echo $resultado;
        exit;  
    }   


?>