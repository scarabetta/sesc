jQuery(function(){
    
    var anchor = window.location.hash ? window.location.hash : '#collapseTwo';
    $(".collapse").collapse('hide');
    $(anchor).collapse('show');
    
    
    $('#cancelar-reunion').on('click', function(){
        if(!confirm('Esta seguro que desea cancelar la reunión?')){
            return false;
        }
    });

    $('#close-acta').on('click', function(){

        error = true;

        // No se puede cerrar con todos pendientes
        $('.expedientes_estados').each(function(){
            
            if($(this).val() != 3 ){
                error = false;
            }
        });

        if(error){
            alert('ERROR: Todos los expedientes estan en estado pendiente.');
            return false;
        }

        error = false;

        // No se puede cerrar con aceptados sin monto
        $('.expedientes_estados').each(function(){
            expediente_id = $(this).data('expediente-id');
            linea_id = $(this).data('linea-id');
            monto = $('input[name=expedientes_montos\\['+linea_id+'\\]\\['+expediente_id+'\\]]').val();
            
            if($(this).val() == 1 && parseFloat(monto) <= 0.0){
                alert('ERROR: Existen expedientes aceptados con un monto asignado menor o igual a cero.');
                error = true;
            }
        });

        if(error){
            return false;
        }
      
        $('.doClose').val('1');
        var data = $( "input, textarea, select, checkbox" ).serialize();

        $('button').prop('disabled', true);
        
        if(confirm('Seguro que desea cerrar la reunión? No podrá volver a editarla')){
          
            $.ajax({
                type: "POST",
                url: "/reunion/save",
                data: data,
                success: function(msg){
                    var msg = $.parseJSON(msg);
                    if(msg.divClass === "success"){
                        window.open('/reunion/print/'+$('#acta_id').val() , '_blank');
                        window.location.href = $('#url_root').val()+'/reunion/close/'+ $('#acta_id').val();
                    }else{
                        var message = $('<p>').addClass('alert alert-'+msg.divClass).text(msg.message);
                        $('.flash-message').html(message);
                        $('html, body').animate({ scrollTop: 0 }, 'fast');
                    }
                },
                error: function(msg){
                    var msg = $.parseJSON(msg);
                    var message = $('<p>').addClass('alert alert-'+msg.divClass).text(msg.message);
                    $('.flash-message').html(message);
                    $('html, body').animate({ scrollTop: 0 }, 'fast');
                },
                complete: function(){
                }
            }); 
        }else{
            $('.doClose').val('0');
            $('button').prop('disabled', false);
        }
    });

    $('select').on('change', function(){
        if($(this).children("option").filter(":selected").text() === 'Aceptado'){
            $(this).next('input').attr('disabled', false);
        }else{
            $(this).next('input').attr('disabled', true);
        }
    });
    
    $('#save-acta').on('click', function(){

        var data = $( "input, textarea, select, checkbox" ).serialize();

        $('button').prop('disabled', true);

        $.ajax({
            type: "POST",
            url: "/reunion/save",
            data: data,
            success: function(msg){
                var msg = $.parseJSON(msg);
                var message = $('<p>').addClass('alert alert-'+msg.divClass).text(msg.message);
                $('.flash-message').html(message);
                $('html, body').animate({ scrollTop: 0 }, 'fast');
                
                $('#reunion-save-success').fadeIn();
                $("#reunion-save-success").fadeOut(3000);
                $('button').prop('disabled', false);
                
            },
            error: function(msg){
                $('html, body').animate({ scrollTop: 0 }, 'fast');
                $('#reunion-save-error').fadeIn();
                $("#reunion-save-error").fadeOut(3000);
                $('#save-gedo').prop('disabled', false);
            }
        });

    });
    
    $('#print_acta').on('click', function(){

        var data = $( "input, textarea, select, checkbox" ).serialize();

        $('button').prop('disabled', true);

        $.ajax({
            type: "POST",
            url: "/reunion/save",
            data: data,
            success: function(msg){
                var msg = $.parseJSON(msg);
                var message = $('<p>').addClass('alert alert-'+msg.divClass).text(msg.message);
                $('.flash-message').html(message);
                $('html, body').animate({ scrollTop: 0 }, 'fast');
                
                $('#reunion-save-success').fadeIn();
                $("#reunion-save-success").fadeOut(3000);
                $('button').prop('disabled', false);
                
                window.open('/reunion/print/'+$('#acta_id').val() , '_blank');
                
            },
            error: function(msg){
                $('html, body').animate({ scrollTop: 0 }, 'fast');
                $('#reunion-save-error').fadeIn();
                $("#reunion-save-error").fadeOut(3000);
                $('#save-gedo').prop('disabled', false);
            }
        });

    });
    
    $('#terminar-acta').on('click', function(){
      if ($('#acta_firmada').get(0).files.length === 0) {
          alert("Debe subir el acta firmada para poder cerrar la reunión.");
      }else{
          $('#form_terminar').submit();
      }
    });

    // DEPRECATED
    $('#save-gedo').on('click', function(){

        if($('#nro_gedo').val() === ''){
            alert('Debe ingresar número de GEDO para guardar');
            return false;
        }
        
        $('#save-gedo').prop('disabled', true);
        $('html, body').animate({ scrollTop: 0 }, 'fast');
        $('#save-gedo-inprogress').fadeIn();
        $("#save-gedo-inprogress").fadeOut(3000);

        var data = $( "input, textarea, select, checkbox" ).serialize();
        
        $.ajax({
            type: "POST",
            url: "/reunion/save_gedo",
            data: data,
            success: function(msg){
                $('#reunion-save-success').fadeIn();
                $("#reunion-save-success").fadeOut(3000);
                //console.log(msg);
                if(msg['error'] !== undefined){
                    $("#reunion-save-success").hide();
                    $('#save-gedo').prop('disabled', false);
                    alert(msg.error);
                }else{
                    window.location = '/expedientes';
                }
            },
            error: function(msg){
                $('#save-gedo').prop('disabled', false);
                $('#reunion-save-error').fadeIn();
                $("#reunion-save-error").fadeOut(3000);
            }
        });

    });
});
