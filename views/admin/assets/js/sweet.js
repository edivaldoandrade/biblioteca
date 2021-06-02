/* global swal */

$(document).ready(function(){

    $(".ajaxForm").submit(function(e) {
        e.preventDefault();
        
        var form = $(this);

        var type = form.attr('data-form');
        var action = form.attr('action');
        var method = form.attr('method');

        var formData = new FormData(this);
 
        var textoAlerta;
        
        if (type === "registrar") {
            textoAlerta = "Os dados serão armazenados no sistema.";
        } else if (type === "remover") {
            textoAlerta = "Os dados serão eliminados completamente do sistema.";
        } else if (type === "actualizar") {
            textoAlerta = "Os dados no sistema serão actualizados.";
        }
        
        swal({
            title: "Está seguro?",   
            text: textoAlerta,   
            type: "question",   
            showCancelButton: true,     
            confirmButtonText: "Aceitar",
            cancelButtonText: "Cancelar"
        }).then(function () {
            $.ajax({
                url: action,
                data: formData ? formData : form.serialize(),
                type: method,
                dataType: "json",
                cache: false,
                contentType: false,
                processData: false,
                success: function (callback) {
                    if(callback.type==="success"){
                        swal({
                            title: "Sucesso!",
                            text: callback.message,
                            type: callback.type
                        }).then(function () {
                            location.reload();
                        });
                    }else{
                        swal({
                            title: "Atenção!",
                            text: callback.message,
                            type: callback.type
                        });
                    }
                },
                error: function() {
                    swal(
                        "Ocorreu um erro",
                        "Não foi possível efectuar a operação",
                        "error"
                    );
                }
            });
            return false;
        });
    });
    
    /*****************************************************************/
    
    $('.remove').click(function (e) {
        e.preventDefault();
    });
    
    $('.remove').each(function () {

        $(this).click(function () {

            var content = $(this).parent().parent().parent();
            var data = $(this).data();

            swal({
                title: "Tem a certeza?",
                text: "O item será removido",
                type: 'question',
                showCancelButton: true,
                confirmButtonColor: '#03A9F4',
                cancelButtonColor: '#F44336',
                confirmButtonText: 'Sim, remover!',
                cancelButtonText: 'Não, cancelar!'
            }).then(function () {
                $.ajax({
                    url: data.action,
                    type: "post",
                    dataType: "json",
                    cache: false,
                    processData: false,
                    success: function (callback){
                        if (callback.type === "success") {
                            content.fadeOut();
                            swal({
                                title: "Sucesso!",
                                text: callback.message,
                                type: callback.type
                            });
                        } else {
                            swal({
                                title: "Atenção!",
                                text: callback.message,
                                type: callback.type
                            });
                        }
                    },
                    error: function() {
                        swal(
                            "Ocorreu um erro",
                            "Não foi possível efectuar a operação",
                            "error"
                        );
                    }
                });
            });
        });
    });
    
    /****************************************************/
});