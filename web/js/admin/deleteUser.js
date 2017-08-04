$('document').ready(function(){
    init();
    $('.datatable').on( 'draw.dt', function () {
        init();
    } );
});
function init(){
    $('.btn-danger').on("click",function(){
        var lien = $(this).attr("data-href");
        var idDel = $(this).attr("attr-id");
        if(bootbox.confirm({
            message:"Êtes-vous sûr de vouloir supprimer cet utilisateur ?",
            buttons: {
                confirm: {
                    label: 'Oui',
                    className: 'btn-success'
                },
                cancel: {
                    label: 'Annuler',
                    className: 'btn-danger'
                }
            }, 
            callback:function(result){
                if(result){
                $.ajax({
                    url: lien,
                    type: 'POST',
                    dataType: 'json',
                    success: function(json) {
                        if(json.success) {
                            $('tr#'+idDel).remove();
                            bootbox.alert("<div class='alert alert-success'>L'utilisateur a bien été supprimé</div>");
                        } else {
                            bootbox.alert("<div class='alert alert-danger'>Une erreur est survenue</div>");
                        }
                    }
                });
            }
            }
        }));
    });
}
