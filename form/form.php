<?php

/*
  PHP 7.4.9
  Formulario Desarrollaro para hypernovalabs.com
  Kevin Martinez Fecha: 2021-04-17
*/

include_once('../lib/libreria-api.php');
require_once('../config.php');

$page = 'consulta';

$maxdate = date('Y-m-d');

    if(isset($_GET['id'])){

        $gastos = $api->getGastoById($_GET['id']);

        if(!isset($gastos['id'])){
            header('Location: '.$redirect);
            exit();
        }

    }else{
        header('Location: '.$redirect);
        exit();   
    }

?>
<!DOCTYPE html>
<html lang="en">
    <?php require_once('../header.php'); ?>
    <body>

        <?php require_once('../menu.php'); ?>

        <div class="container">  

            <div class="row" id="pagina">
                
                    <?php if(isset($_GET['res']) && $_GET['res'] == "ok"){ ?>
                        <div class=" col-12 alert alert-success">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                <strong>Excelente!</strong> Operación exitosa
                        </div>
                    <?php } ?>
                    <?php if(isset($_GET['res']) && $_GET['res'] == "fail"){ ?>
                        <div class="col-12 alert alert-danger">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <strong>Atención!</strong> No se pudo completar la operación
                        </div>
                    <?php } ?>

                <div class="col-12 text-center">
                    <h1>Consulta registro de gasto  ID#<?=$_GET['id']?></h1>                    
                </div>
                          
                
                <div class="col-12 resultados">
                        
                        <!-- form card login with validation feedback -->
                        <form class="form" role="form" autocomplete="off" id="formRegistro" novalidate="">

                            <div class="card card-outline-secondary mt-2">
                                
                                <div class="card-header">
                                    <h3 class="mb-0">Datos basicos</h3>
                                </div>
                                <div class="card-body">                                
                                        <div class="form-group col-12 row">
                                            <div class="col-6">                                        
                                                <label for="uname1">Concepto</label>
                                                <input type="text" class="form-control" placeholder="concepto" name="concepto" id="concepto" value="<?=$gastos['concepto']?>" disabled="disable">
                                            </div>
                                            <div class="col-6">
                                                <div class="row">                                            
                                                    <div class="col-6">
                                                        <label for="uname1">Desde</label>
                                                        <input  type="date" class="form-control" placeholder="desde" name="desde" id="desde" required="" value="<?=$gastos['fechadesde']?>" disabled="disable">
                                                    </div>
                                                    <div class="col-6">
                                                        <label for="uname1">Hasta</label>
                                                        <input  type="date" class="form-control" placeholder="hasta" name="hasta" id="hasta" required="" value="<?=$gastos['fechahasta']?>" disabled="disable">
                                                    </div>
                                                </div>                                            
                                            </div>
                                        </div>
                                </div>
                                <div class="card-header">
                                    <h3 class="mb-0">Datos del empleado</h3>
                                </div>
                                <div class="card-body">                                
                                        <div class="form-group col-12 row">
                                            <div class="col-12">
                                                <div class="row">                                            
                                                    <div class="col-6">
                                                        <label for="uname1">Nombre</label>
                                                        <input type="text" class="form-control" placeholder="Nombre" name="nombre" id="nombre" value="<?=$gastos['nombre']?>" disabled="disable">
                                                    </div>
                                                    <div class="col-6">
                                                        <label for="uname1">Posición</label>
                                                        <input type="text" class="form-control" placeholder="Posición" name="posicion" id="posicion" value="<?=$gastos['posicion']?>" disabled="disable">
                                                    </div>
                                                </div> 
                                                <div class="row">                                            
                                                    <div class="col-6">
                                                        <label for="uname1">Departamento</label>
                                                        <input type="text" class="form-control" placeholder="Departamento" name="departamento" id="departamento" value="<?=$gastos['departamento']?>" disabled="disable">
                                                    </div>
                                                    <div class="col-6">
                                                        <label for="uname1">Supervisor</label>
                                                        <input type="text" class="form-control" placeholder="Supervisor" name="supervisor" id="supervisor" value="<?=$gastos['supervisor']?>" disabled="disable">
                                                    </div>
                                                </div>                                            
                                            </div>
                                        </div>
                                </div>
                                <div class="card-header">
                                    <h3 class="mb-0">Detalle de gastos</h3>
                                </div>
                                <div class="card-body"> 
                                    <table class="table" id="DetalleDelGato">
                                        <thead>
                                            <tr>
                                                <th scope="col">#</th>
                                                <th scope="col">
                                                    Fecha                                                    
                                                </th>
                                                <th scope="col">
                                                    Cuenta                                                    
                                                </th>
                                                <th scope="col">
                                                    Descripcion                                                    
                                                </th>
                                                <th scope="col">
                                                    Total                                                    
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $contador=1; $suma=0.0; foreach ($gastos['detallesgasto'] as $detalle){?>
                                                <tr>
                                                    <td><?=$contador?></td>
                                                    <td><?=$detalle['fecha']?></td>
                                                    <td><?=$detalle['cuenta']?></td>
                                                    <td><?=$detalle['descripcion']?></td>
                                                    <td><?=number_format($detalle['total'],2,'.',',')?></td>
                                                </tr>
                                            <?php  
                                            
                                                $contador +=1; 
                                                $suma +=$suma+ (float)$detalle['total'];
                                        
                                            }?>
                                        </tbody>
                                        <tfooter>
                                            <tr>
                                                <td colspan="4"></td>
                                                <td colspan="2">
                                                    <div class="badge badge-primary"> USD. 
                                                     <span id="dtotalsuma"><?=$suma;?></span>
                                                    </div>                                                    
                                                </td>
                                            </tr>
                                        </tfooter>
                                    </table>
                                </div>
                                <div class="card-header">
                                    <h3 class="mb-0"><sptrng>Aprobación</h3>
                                </div>
                                <div class="card-body"> 
                                    <div class="form-group">
                                        <label for="comment">Aprobado por:</label>
                                        <textarea class="form-control" rows="5" id="aprobado" name="aprobado"  disabled="disable"><?=$gastos['supervisor']?></textarea>
                                    </div>
                                </div>                                
                                
                            </div>
                            <br/>
                            <a href="<?= $redirect; ?>" class="btn btn-danger float-rigth"> Volver <i class="fa fa-reply" aria-hidden="true"></i></a>

                        </form>
                </div>

            </div>
        </div>

        <?php require_once('../footer.php'); ?>  

        <script>
            var urlsite = '<?=$redirect?>';
        </script>    

        <script src="../js/add.js"></script>  

    </body>
</html>
