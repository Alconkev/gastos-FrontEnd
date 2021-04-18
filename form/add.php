<?php
/*
  PHP 7.4.9
  Formulario Desarrollaro para hypernovalabs.com
  Kevin Martinez Fecha: 2021-04-17
*/

include_once('../lib/libreria-api.php');
require_once('../config.php');

$page = 'registro';

$maxdate = date('Y-m-d');

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
                    <h1>Nuevo registro de gasto</h1>                    
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
                                                <input type="text" class="form-control" placeholder="concepto" name="concepto" id="concepto" required="">
                                            </div>
                                            <div class="col-6">
                                                <div class="row">                                            
                                                    <div class="col-6">
                                                        <label for="uname1">Desde</label>
                                                        <input  type="date" class="form-control" placeholder="desde" name="desde" id="desde" required="" max="<?=$maxdate;?>">
                                                    </div>
                                                    <div class="col-6">
                                                        <label for="uname1">Hasta</label>
                                                        <input  type="date" class="form-control" placeholder="hasta" name="hasta" id="hasta" required="" max="<?=$maxdate;?>">
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
                                                        <input type="text" class="form-control" placeholder="Nombre" name="nombre" id="nombre" required="">
                                                    </div>
                                                    <div class="col-6">
                                                        <label for="uname1">Posición</label>
                                                        <input type="text" class="form-control" placeholder="Posición" name="posicion" id="posicion" required="">
                                                    </div>
                                                </div> 
                                                <div class="row">                                            
                                                    <div class="col-6">
                                                        <label for="uname1">Departamento</label>
                                                        <input type="text" class="form-control" placeholder="Departamento" name="departamento" id="departamento" required="">
                                                    </div>
                                                    <div class="col-6">
                                                        <label for="uname1">Supervisor</label>
                                                        <input type="text" class="form-control" placeholder="Supervisor" name="supervisor" id="supervisor" required="">
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
                                                    <input type="date" class="form-control" placeholder="fecha" name="fecha" id="dtfecha" max="<?=$maxdate;?>">
                                                </th>
                                                <th scope="col">
                                                    Cuenta
                                                    <input type="text" class="form-control" placeholder="cuenta" name="cuenta" id="dtCuenta">                                                
                                                </th>
                                                <th scope="col">
                                                    Descripcion
                                                    <input type="text" class="form-control" placeholder="descripcion" name="descripcion" id="dtDescripcion">   
                                                </th>
                                                <th scope="col">
                                                    Total
                                                    <input type="text" class="form-control solodecimal" placeholder="total" name="total" id="dtTotal">   
                                                </th>
                                                <th>
                                                    <a class="btn btn-success add-detalle">Agregar <i class="fa fa-plus"></i></a>
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr></tr>
                                        </tbody>
                                        <tfooter>
                                            <tr>
                                                <td colspan="4"></td>
                                                <td colspan="2">
                                                    <div class="badge badge-primary"> USD. 
                                                     <span id="dtotalsuma">0.00</span>
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
                                        <textarea class="form-control" rows="5" id="aprobado" name="aprobado"></textarea>
                                    </div>
                                </div>                                
                                
                            </div>
                            <br/>
                            <a href="<?= $redirect; ?>" class="btn btn-danger float-rigth"> Volver <i class="fa fa-reply" aria-hidden="true"></i></a>
                            <input type="botton" class="btn btn-primary btn-agregar" value="Guardar">


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
