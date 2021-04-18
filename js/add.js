$(function() {

    var gasto = {
        concepto:'',
        desde:'',
        hasta:'',
        empleado:'',
        posicion:'',
        despartamento:'',
        supervidor:'',
        detalles: [],
        aprobado: '',
    } 
    var detalle = {
        fecha: '',
        cuenta: '',
        descripcion:'',
        total: 0.0,
        newid: ''
    }


    $('.add-detalle').on('click', function(){


        if($('#dtfecha').val() != '' && $('#dtCuenta').val() != '' && $('#dtDescripcion').val() != '' && $('#dtTotal').val() != ''){

            var sumaTotal = 0.0;

            var newid = new Date().getTime().toString();

            var detalle = {
                fecha: '',
                cuenta: '',
                descripcion:'',
                total: 0.0
            }

            detalle.fecha = $('#dtfecha').val();
            detalle.cuenta = $('#dtCuenta').val();
            detalle.descripcion = $('#dtDescripcion').val();
            detalle.total = parseFloat($('#dtTotal').val()).toFixed(2);
            detalle.newid = newid;

            var existe =false;
            if(gasto.detalles.length > 0){
                var index= 1;
                for (let index = 0; index < gasto.detalles.length; index++) {
                    const element = gasto.detalles[index];
                    if(element.cuenta ==   detalle.cuenta){
                        existe = true;
                        break;
                    }else{
                        index +=1;
                    }
                }

                if(existe == false){

                    gasto.detalles.push(detalle);

                    $('#DetalleDelGato').append('<tr><td>'+index+'</td><td>'+detalle.fecha+'</td><td>'+detalle.cuenta+'</td><td>'+detalle.descripcion+'</td><td>'+detalle.total+'</td><td><a class="btn btn-danger btn-quitar" data-id="'+newid+'">Quitar</a></td></tr>');

                    $('#dtfecha').val('');
                    $('#dtCuenta').val('');
                    $('#dtDescripcion').val('');
                    $('#dtTotal').val('');

                }else{
                alert('Ya existe un registro para esa cuenta');
                }


            }else{

                gasto.detalles.push(detalle);

                $('#DetalleDelGato').append('<tr><td>1</td><td>'+detalle.fecha+'</td><td>'+detalle.cuenta+'</td><td>'+detalle.descripcion+'</td><td>'+detalle.total+'</td><td><a class="btn btn-danger btn-quitar" data-id="'+newid+'">Quitar</a></td></tr>');

                $('#dtfecha').val('');
                $('#dtCuenta').val('');
                $('#dtDescripcion').val('');
                $('#dtTotal').val('');
            }

            for (let index = 0; index < gasto.detalles.length; index++) {
                const element = gasto.detalles[index];
                sumaTotal += parseFloat(element.total);
            }

            $('#dtotalsuma').text(sumaTotal.toFixed(2));
            
            
        }else{
            alert('Debe completar todo los datos');
        }        

    });

    $('#DetalleDelGato > tbody').on('click', '.btn-quitar',function(){
        var id = $(this).attr('data-id');

        for (let index = 0; index < gasto.detalles.length; index++) {
            const element = gasto.detalles[index];
            if(element.newid == id){
                gasto.detalles.splice(index, 1);
            }
        }
        
        $("#DetalleDelGato > tbody").empty();

        for (let index = 0; index < gasto.detalles.length; index++) {
            const element = gasto.detalles[index];
            $('#DetalleDelGato').append('<tr><td>'+index+'</td><td>'+element.fecha+'</td><td>'+element.cuenta+'</td><td>'+element.descripcion+'</td><td>'+element.total+'</td><td><a class="btn btn-danger btn-quitar" data-id="'+element.newid+'">Quitar</a></td></tr>');
            sumaTotal += parseFloat(element.total);
        }
        
        $('#dtotalsuma').text(sumaTotal.toFixed(2));

    })

    $('.solodecimal').on('input', function () {
        this.value = this.value.replace(/[^0-9.]/g, '').replace(/,/g, '.');
    });
    
    $('.btn-agregar').on('click',function(){

        $('.btn-agregar').prop('disabled',true);
        $('.btn-agregar').attr('Guardando...');

        if($('#concepto').val() != '' && $('#desde').val() != '' && $('#hasta').val() != '' && $('#nombre').val() != '' && $('#posicion').val() != '' && $('#departamento').val() != '' && $('#aprobado').val() != '' && gasto.detalles.length > 0){


            var vdesde = $('#desde').val();
            var vhasta = $('#hasta').val();

            

            var r = confirm("¿Quiere enviar los datos ingresado en el formulario?");

            if (r == true) { 

                gasto.concepto = $('#concepto').val();
                gasto.desde = $('#desde').val();
                gasto.hasta = $('#hasta').val();
                gasto.nombre = $('#nombre').val();
                gasto.posicion = $('#posicion').val();
                gasto.departamento = $('#departamento').val();
                gasto.aprobado = $('#aprobado').val();
                gasto.supervisor = $('#supervisor').val();
                        
                            $.ajax({
                                url: urlsite+"/lib/api_ajax.php",
                                type: "POST",
                                dataType:'json',
                                data: { opcion: 'Crear',
                                concepto:gasto.concepto,
                                nombre:gasto.nombre,
                                supervisor:gasto.supervisor,
                                desde:gasto.desde,
                                hasta:gasto.hasta,
                                posicion:gasto.posicion,
                                departamento:gasto.departamento,
                                aprobado:gasto.aprobado,
                                detalles:gasto.detalles
                                },
                                success: function (r) {
                                    if(r.code == '0'){
                                        window.location = urlsite+'form/add.php?res=ok'; 
                                    }else{
                                        alert(r.message);
                                        $('.btn-agregar').prop('disabled',false);
                                        $('.btn-agregar').attr('value','Guardar');
                                    }                                    
                                },
                                error: function(xhr, status, error) {
                                    window.location = urlsite+'form/add.php?res=ko'; 

                                }

                            });

            }

        }else{
            alert('Por favor completar todos los datos del formulario!, gracias.');
            $('.btn-agregar').prop('disabled',false);
            $('.btn-agregar').attr('value','Guardar');
        }

    });


});