$(document).ready(function(){
    
    $('.select-exp').on('change', function(e) {
        e.stopPropagation();
        var expediente = $(this).val();
        if(this.checked) {
            var input = $('<input>')
                .attr('type', 'hidden')
                .attr('id','form-exp-'+ expediente)
                .attr('name', 'expedientes['+ expediente +']')
                .val(expediente);
            $('#form-exp').append(input);
        }else{
            //console.log($('#form-exp-'+ expediente));
            $('#form-exp-'+ expediente).remove();
        }
        return false;
    });

    $('#add-acta').on('click', function(e){
        e.preventDefault();
        
        // TODO: chequear que haya seleccionado expedientes
        if($('form input').length === 1){
            alert('Debe seleccionar al menos un expediente para iniciar una reunión');
            return false
        }

        $('#form-exp').submit();

    });
});
