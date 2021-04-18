<?php
/*
  PHP 7.4.9
  Formulario Desarrollaro para hypernovalabs.com
  Kevin Martinez Fecha: 2021-04-17
*/

include_once('./lib/libreria-api.php');
require_once('config.php');

$gastos = $api->getGastos();

$page = 'inicio';

?>
<!DOCTYPE html>
<html lang="en">
    <?php require_once('header.php'); ?>
    <body>

        <?php require_once('menu.php'); ?>

        <div class="container">  

            <div id="pagina">

                <div class="row">
                    <h1>Listado de gastos</h1>
                </div>
                <div class="row">
                    <a class="btn btn-success" href="form/add.php">Agregar <i class="fa fa-plus"></i></a>
                </div>

                <div class="row resultados">
                   
                        <?php if(isset($gastos) && count($gastos)){?>

                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table" id="table1">
                                    <thead>
                                        <tr>
                                            <th>Id</th>
                                            <th>F.Registro</th>
                                            <th>Concepto</th>
                                            <th>Desde / Hasta</th>                                            
                                            <th>Empleado</th>
                                            <th>Supervisor</th>
                                            <th>Aprobador</th>
                                            <th>Total</th>
                                            <th>Acción</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        
                                        <?php  foreach($gastos as $value){?>
                                        <tr>
                                            <td>
                                                <span class="badge badge-secondary"><?=$value['id']?></span>
                                            </td>
                                            <td>
                                                <?=$value['fecha']?>
                                            </td>
                                            <td>
                                                <?=$value['concepto']?>
                                            </td>
                                            <td>
                                                <span class="badge badge-secondary"><?=$value['fechadesde']?> - <?=$value['fechahasta']?></span>
                                            </td>
                                            <td>
                                                <?=$value['nombre']?>
                                            </td>
                                            <td>
                                                <?=$value['supervisor']?>
                                            </td>
                                            <td>
                                                <?=$value['aprobado']?>
                                            </td>
                                            <td>
                                            <span class="badge badge-success"><?=$value['total']?></span>
                                            </td>
                                            <td><a href="form/form.php?id=<?=$value['id']?>" class="btn btn-info">Ver <i class="fa fa-edit"></i></a></td>
                                        </tr>
                                        <?php }  ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <?php }else {?>
                            
                            <div class="col-12 mt-2">
                                <div class="alert alert-info" role="alert">
                                    No hay datos.
                                </div>
                            </div>

                        <?php }?>
                </div>

            </div>
        </div>


        <?php require_once('footer.php'); ?>        

    </body>
</html>
