$('document').ready(function(){
    init();
    $('.datatable').on( 'draw.dt', function () {
        init();
    } );
});
function init(){
   $('.btn-delete').on("click",function(){
        var lien = $(this).attr("data-href");
        var id= $(this).attr("data-id");
        if(bootbox.confirm({
            message:"Êtes-vous sûr de vouloir supprimer ce produit ?",
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
                        if(json.success==1) {
                            bootbox.alert("<div class='alert alert-success'>Le produit a bien été supprimé</div>");
                            $('table tbody tr#'+id).remove();
                        } else {
                            bootbox.alert("<div class='alert alert-danger'>Une erreur est survenue</div>");
                        }
                    }
                });
            }}
        }));
    }); 
}