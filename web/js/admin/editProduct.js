$('document').ready(function(){
   
    var url = document.location.href;
    var getDiese = url.split("#");
    if(getDiese.length>1){
        $('li a[href=\'#'+getDiese[1]+'\']').trigger("click");
    }
    calculTempsTotal();
    rafraichitDenree();
    $('body').on("click",function(e){
       if(!$(e.target).hasClass("innerAction")){
           $("ul.actionListe").remove();
       } 
    });
    $('.technique a.movieLink span.glyphicon-facetime-video').on("click",function(evt){
       if($(evt.target).hasClass("glyphicon-facetime-video")){
            $("#modalVideo .modal-body").html('<div class="embed-responsive embed-responsive-4by3"><iframe class="embed-responsive-item" src="'+$(this).parent().attr("data-attr-movie")+'"></iframe></div>');
            $("#modalVideo .modal-header").html("<strong>"+$(this).parent().text()+"</strong>");
            $('#modalVideo').modal();
            return false;
       }
    });
    $('.etape .main-left > h4').on('contextmenu', function(ev) {
        ev.preventDefault();
        var id = $(this).parent().parent().attr("id");
        var spl=id.split("-");
        if(spl.length>1){
            id=spl[1];
            $("ul.actionListe").remove();
            var ul = document.createElement('ul');
            ul.setAttribute("class","actionListe actionEtape list-group");
            ul.setAttribute("style","top:"+ev.pageY+"px;left:"+ev.pageX+"px");

            var liEdit = document.createElement('li');
            liEdit.setAttribute("class","list-group-item");
            liEdit.innerHTML="<a class='innerAction'>Modifier</a>";
            liEdit.onclick=function(){getFormEditEtape(id)};
            
            var liDelete = document.createElement('li');
            liDelete.setAttribute("class","list-group-item");
            liDelete.innerHTML="<a class='innerAction'>Supprimer</a>";
            liDelete.onclick=function(){valideDeteleteEtape(id)};
            
            $(liEdit).appendTo(ul);
            $(liDelete).appendTo(ul);
            $(ul).appendTo('body');
        }
        return false;
    });
    $('.etape .main-left .technique > h5').on('contextmenu', function(ev) {
        ev.preventDefault();
        var id = $(this).parent().attr("id");
        var spl=id.split("-");
        if(spl.length>1){
            id=spl[1];
            $("ul.actionListe").remove();
            var ul = document.createElement('ul');
            ul.setAttribute("class","actionListe actionEtape list-group");
            ul.setAttribute("style","top:"+ev.pageY+"px;left:"+ev.pageX+"px");

            var liEdit = document.createElement('li');
            liEdit.setAttribute("class","list-group-item");
            liEdit.innerHTML="<a class='innerAction'>Modifier</a>";
            liEdit.onclick=function(){getFormEditTechnique(id)};
            
            var liDelete = document.createElement('li');
            liDelete.setAttribute("class","list-group-item");
            liDelete.innerHTML="<a class='innerAction'>Supprimer</a>";
            liDelete.onclick=function(){valideDeteleteTechnique(id)};
            
            $(liEdit).appendTo(ul);
            $(liDelete).appendTo(ul);
            $(ul).appendTo('body');
        }
        return false;
    });
    $('.order').on("click",function(){
       var idEtape = $(this).attr("data-attr-id"); 
        $.ajax({
            url: basePageAdmin+'etape/reorder',
            type: 'POST',
            data:{sens:($(this).hasClass('orderUp')) ? 1 : 0,id:idEtape},
            dataType: 'JSON',
            success: function(retour) {
                if(retour.success) window.location.reload();
                else bootbox.alert("<div class='alert alert-danger'>Une erreur est survenue <br /> Détail :"+retour.message+"</div>");
            }
        });
    });
    $('.addstep').on("click",function(){
        var lien = $(this).attr("data-href");
        $.ajax({
            url: lien,
            type: 'POST',
            dataType: 'JSON',
            success: function(ret) {
                $("#addStep .modal-body").html(ret);
                var dialog = bootbox.dialog({
                    message: $("#addStep .modal-body").html(),
                    closeButton: false,
                    size: 'large'
                });
                $('#addStep .modal-body select#catEtapeProduit').on("change",function(){
                    getEtapeTypeByCat($(this).val());
                 });
                 $('#addStep .modal-body #etapeProduit').on("change",function(){
                    getEtapeType($(this).val());
                 });
                $('#addStep .modal-body .jscolor').colorPicker();
                $('#addStep #btnValideAddEtape').on("click",function(){
                    var couleur = $('#adminbundle_etapeproduit_codeCouleur').val();
                    var titre = $('#adminbundle_etapeproduit_titre').val();
                    $.ajax({
                        url: basePageAdmin+'etape/valide_new',
                        type: 'POST',
                        data: {
                            t:titre,
                            c:couleur,
                            dT:$('#adminbundle_etapeproduit_dureeType').val(),
                            dV:$('#adminbundle_etapeproduit_dureeValeur').val(),
                            dU:$('#adminbundle_etapeproduit_dureeUnite').val(),
                            idP:$('#productIdRef').val()},
                        dataType: 'JSON',
                        success: function(retour) {
                            if(retour.success) window.location.reload();
                            else bootbox.alert("<div class='alert alert-danger'>Une erreur est survenue <br /> Détail :"+retour.message+"</div>");
                        }
                    });
                });
            }
        });
    });
    $('.addtech').on("click",function(){
        var lien = $(this).attr("data-href");
        var idEtape = $(this).attr("data-attr-id");
        $.ajax({
            url: lien,
            type: 'POST',
            dataType: 'JSON',
            success: function(ret) {
                $("#addTech .modal-body").html(ret);
                $('#addTech').modal();
                $('textarea').froalaEditor({height: 300});
                $('#addTech #btnValideAddTech').on("click",function(){
                    var description = $('#adminbundle_techniquesetape_description').val();
                    var titre = $('#adminbundle_techniquesetape_titre').val();
                    var lien = $('#adminbundle_techniquesetape_lienExterne').val();
                    $.ajax({
                        url: basePageAdmin+'technique/valide_new',
                        type: 'POST',
                        data: {t:titre,d:description,idEtape:idEtape,l:lien},
                        dataType: 'JSON',
                        success: function(retour) {
                            if(retour.success) window.location.reload();
                            else bootbox.alert("<div class='alert alert-danger'>Une erreur est survenue <br /> Détail :"+retour.message+"</div>");
                        }
                    });
                });
            }
        });
    });
    $('#addDenree').on("click",function(){
        $.ajax({
            url:  basePageAdmin+'etape/add_denree',
            type: 'POST',
            dataType: 'JSON',
            data:{idP:$('#productIdRef').val()},
            success: function(ret) {
                $("#addDenreeModal .modal-body").html(ret);
                $('#addDenreeModal').modal();
                selectDenree();
                $('form[name=adminbundle_etape_denree] #adminbundle_etape_denree_denreeProduit').on("change",function(){selectDenree()});
                $('#addDenreeModal form').on("submit",function(e){
                    e.preventDefault();
                    $.ajax({
                        url: this.action,
                        type: 'POST',
                        data: $(this).serialize(),
                        dataType: 'JSON',
                        success: function(retour) {
                            if(retour.success){
                                $('#addDenreeModal').modal("hide");
                                rafraichitDenree();
                            }
                            else bootbox.alert("<div class='alert alert-danger'>Une erreur est survenue <br /> Détail :"+retour.message+"</div>");
                        }
                    });
                });
            }
        });
    });
    $('#btnDeleteProduct').on("click",function(){
        var lien = $(this).attr("data-href");
        if(bootbox.confirm({
            message:"Êtes-vous sûr de vouloir supprimer cette image ?",
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
                            bootbox.alert("<div class='alert alert-success'>L'image a bien été supprimée</div>");
                        } else {
                            bootbox.alert("<div class='alert alert-danger'>Une erreur est survenue</div>");
                        }
                    }
                });
            }
            }
        }));
    });
});

function getFormEditEtape(idEtape){
    $.ajax({
        url: basePageAdmin+'etape/'+idEtape+'/edit',
        type: 'POST',
        dataType: 'JSON',
        success: function(ret) {
            $("#editEtape .modal-body").html(ret);
            $('#editEtape').modal();
            $('#editEtape #formValideEditEtape').on("submit",function(e){
                e.preventDefault();
                $.ajax({
                    url: this.action,
                    type: 'POST',
                    data: $(this).serialize(),
                    dataType: 'JSON',
                    success: function(retour) {
                        if(retour.success){
                            $('.etape#etape-'+idEtape+' .main-left > h4 span').html($('#editEtape #formValideEditEtape #adminbundle_etapeproduit_titre').val());
                            var detailDuree="";
                            if($('#editEtape #formValideEditEtape #adminbundle_etapeproduit_dureeUnite').val()=="s"){
                                detailDuree+='seconde(s)';
                            }
                            else if($('#editEtape #formValideEditEtape #adminbundle_etapeproduit_dureeUnite').val()=="m"){
                                detailDuree+='minute(s)';
                            }
                            else{
                                detailDuree+='heure(s)';
                            }
                            if($('#editEtape #formValideEditEtape #adminbundle_etapeproduit_dureeType').val()=="unitaire"){
                                detailDuree+=' par produit';
                            }
                            else{
                                detailDuree+=' peu importe la quantité';
                            }
                            
                            $('.etape#etape-'+idEtape+' .main-left > h4 small').html("<span class='glyphicon glyphicon-grain'></span> "+$('#editEtape #formValideEditEtape #adminbundle_etapeproduit_dureeValeur').val()+" "+detailDuree);
                            $('.etape#etape-'+idEtape+' .main-left .detailDataTemps').val($('#editEtape #formValideEditEtape #adminbundle_etapeproduit_dureeValeur').val());
                            $('.etape#etape-'+idEtape+' .main-left .detailDataTemps').attr("data-attr-unite",$('#editEtape #formValideEditEtape #adminbundle_etapeproduit_dureeUnite').val());
                            $('.etape#etape-'+idEtape+' .main-left .detailDataTemps').attr("data-attr-calculType",$('#editEtape #formValideEditEtape #adminbundle_etapeproduit_dureeType').val());
                            $('#editEtape').modal('hide');
                            $("ul.actionListe").remove();  
                            calculTempsTotal();
                        }
                        else bootbox.alert("<div class='alert alert-danger'>Une erreur est survenue <br /> Détail :"+retour.message+"</div>");
                    }
                });
            });
        }
    });
}
function valideDeteleteEtape(idEtape){
    if(bootbox.confirm({
        message:"Êtes-vous sûr de vouloir supprimer cette étape ? Attention les techniques associées seront également supprimées définitivement",
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
                url: basePageAdmin+'etape/'+idEtape,
                type: 'DELETE',
                dataType: 'JSON',
                success: function(json) {
                    if(json.success==1) {
                        bootbox.alert("<div class='alert alert-success'>L'étape a bien été supprimée</div>");
                        $('.etape#etape-'+idEtape).remove();
                        $('.denree table thead tr th#etapeDenree-'+idEtape).remove();
                        $('.denree table thead tr th#refColspan').attr("colspan",$('.theadEtape').length);
                        $("ul.actionListe").remove();
                        
                    } else {
                        bootbox.alert("<div class='alert alert-danger'>Une erreur est survenue</div>");
                        $("ul.actionListe").remove();
                    }
                }
            });
        }
        }
    }));
}
function getFormEditTechnique(idTechnique){
    $.ajax({
        url: basePageAdmin+'technique/'+idTechnique+'/edit',
        type: 'POST',
        dataType: 'JSON',
        success: function(ret) {
            $("#editTechnique .modal-body").html(ret);
            $('#editTechnique').modal();
            $('#editTechnique textarea').froalaEditor({height: 300});
            $('#editTechnique #formValideEditTechnique').on("submit",function(e){
                e.preventDefault();
                $.ajax({
                    url: this.action,
                    type: 'POST',
                    data: $(this).serialize(),
                    dataType: 'JSON',
                    success: function(retour) {
                        if(retour.success){
                            window.location.reload(); 
                        }
                        else bootbox.alert("<div class='alert alert-danger'>Une erreur est survenue <br /> Détail :"+retour.message+"</div>");
                    }
                });
            });
        }
    });
}
function valideDeteleteTechnique(idTechnique){
    if(bootbox.confirm({
        message:"Êtes-vous sûr de vouloir supprimer cette technique définitivement ? ",
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
                url: basePageAdmin+'technique/'+idTechnique,
                type: 'DELETE',
                dataType: 'JSON',
                success: function(json) {
                    if(json.success==1) {
                        bootbox.alert("<div class='alert alert-success'>La technique a bien été supprimée</div>");
                        $('.technique#tech-'+idTechnique).remove();
                        $("ul.actionListe").remove();
                        
                    } else {
                        bootbox.alert("<div class='alert alert-danger'>Une erreur est survenue</div>");
                        $("ul.actionListe").remove();
                    }
                }
            });
        }
        }
    }));
}


function selectDenree(){
    var denree = $('form[name=adminbundle_etape_denree] #adminbundle_etape_denree_denreeProduit').val();
    $.ajax({
        url: basePageAdmin+'denrees/Ajax/'+denree,
        type: 'GET',
        dataType: 'JSON',
        success: function(json) {
            $('form[name=adminbundle_etape_denree] #moreInfoAddDenree').html(" ( en "+json.uniteMesure+" )");
        }
    });
}

function rafraichitDenree(){
    $.ajax({
        url: basePage+'getByProduit/'+$('#productIdRef').val(),
        type: 'GET',
        dataType: 'JSON',
        success: function(json) {
            if(json.success){
                $('.denree table tbody tr').remove();
                var nbEtape = $('.theadEtape').length;
                for(var e in json.data){
                    $('<tr class="headCategorieDenree"><td colspan="'+(parseInt(nbEtape)+5)+'">'+e+'</td></tr>').appendTo('.denree table tbody');
                    
                    for(var d in json.data[e]){
                        
                        if($('.denree table tbody tr td#denree-'+(json.data[e][d].etapeID)+'-'+(json.data[e][d].denreeID)).length==0){
                            
                            var newTR = document.createElement("tr");
                            newTR.setAttribute("id","denreeID-"+json.data[e][d].denreeID);
                            newTR.setAttribute("uniqueID",json.data[e][d].UniqueID);
                            newTR.setAttribute("class","denreeTR");
                            
                            var newTDLabel = document.createElement("td");
                            newTDLabel.innerHTML = json.data[e][d].Nom;
                            $(newTDLabel).appendTo(newTR);
                            
                            var newTDuniteMesure = document.createElement("td");
                            newTDuniteMesure.innerHTML = json.data[e][d].uniteMesure;
                            $(newTDuniteMesure).appendTo(newTR);
                            
                            //Creation des colonnes pouvant précèder l'étape en cours
                            for(var i = 1 ; i<json.data[e][d].etapeOrdre; i++){
                                var newTD = document.createElement("td");
                                newTD.setAttribute("id","denree-"+json.etapes[i]+'-'+json.data[e][d].denreeID);
                                $(newTD).appendTo(newTR);
                            }
                            var newTD = document.createElement("td");
                            newTD.innerHTML = json.data[e][d].quantite;
                            newTD.setAttribute("id","denree-"+(json.data[e][d].etapeID)+'-'+(json.data[e][d].denreeID));
                            newTD.setAttribute("class","denreeValue");
                            $(newTD).appendTo(newTR);
                            
                            // Création des colonnes restantes de l'étape en cours
                            for(var i = json.data[e][d].etapeOrdre+1 ; i<=nbEtape; i++){
                                var newTD = document.createElement("td");
                                newTD.setAttribute("id","denree-"+json.etapes[i]+'-'+json.data[e][d].denreeID);
                                $(newTD).appendTo(newTR);
                            }
                            
                            var newTDTotal = document.createElement("td");
                            newTDTotal.setAttribute("class","totalQtt");
                            var newTDPUHT = document.createElement("td");
                            newTDPUHT.innerHTML=json.data[e][d].pUHT;
                            
                            var newTDPTHT = document.createElement("td");
                            $(newTDTotal).appendTo(newTR);
                            $(newTDPUHT).appendTo(newTR);
                            $(newTDPTHT).appendTo(newTR);
                            $(newTR).on("dblclick",function(){
                                removeDenreeProduct(this);
                            });
                            $(newTR).appendTo('.denree table tbody');
                        }
                        else{
                            $('.denree table tbody tr td#denree-'+(json.data[e][d].etapeID)+'-'+(json.data[e][d].denreeID)).html(json.data[e][d].quantite);
                            $('.denree table tbody tr td#denree-'+(json.data[e][d].etapeID)+'-'+(json.data[e][d].denreeID)).attr("class","denreeValue");
                        }
                    }
                }
                calculColonne();
            }
            else{
                bootbox.alert("<div class='alert alert-danger'>Une erreur est survenue lors de la récupération des denrees</div>");
            }
        }
    });
}
function removeDenreeProduct(e){
    if(bootbox.confirm({
        message:"Êtes-vous sûr de vouloir supprimer cette denrée de cette étape ? ",
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
                url:  basePageAdmin+'etape/remove_denree',
                type: 'POST',
                dataType: 'JSON',
                data:{id:$(e).attr("uniqueid")},
                success: function(json) {
                    if(json.success==1) {
                        bootbox.alert("<div class='alert alert-success'>La denrée a bien été supprimée</div>");
                        $('.denree table tr[uniqueID='+$(e).attr("uniqueid")+']').remove();
                        
                    } else {
                        bootbox.alert("<div class='alert alert-danger'>Une erreur est survenue</div>");
                    }
                }
            });
        }
        }
    }));
    
}
function calculColonne(){
    var trs = $('.denree table tbody tr.denreeTR');
    var totalGlobalPTHT=0;
    $('.denree table tbody tr.denreeTR').each(function( index ) {
        var total=0;
        $(this).find("td.denreeValue").each(function( i ) {
            total=parseFloat($(this).text())+parseFloat(total);
        });
        $(this).find("td.totalQtt").html(total.toFixed(3));
        var prixUHT = parseFloat($(this).find("td:last-child").prev().html());
        $(this).find("td:last-child").html(parseFloat(prixUHT*total.toFixed(3)).toFixed(2));
        $(this).find("td:last-child").attr("class","ptht");
        totalGlobalPTHT=parseFloat(parseFloat(prixUHT*total.toFixed(3)).toFixed(2))+parseFloat(totalGlobalPTHT);
    });
    var totDenree=parseFloat(totalGlobalPTHT).toFixed(2);
    var assaiso=parseFloat((parseFloat(totalGlobalPTHT).toFixed(2)*2)/100).toFixed(2);
    $(".denree table tfoot td#totDenree").html(totDenree);
    $(".denree table tfoot td#assaiso").html(assaiso);
    $(".denree table tfoot td#totMatiere").html(parseFloat(assaiso)+parseFloat(totDenree));
}

function calculTempsTotal(){
    var inputTemps = $('input.detailDataTemps').toArray();
    var tempsTotalSeconde = 0;
    for ( var i = 0; i < inputTemps.length; i++ ) {
        if($(inputTemps[ i ]).attr("data-attr-unite")=="h"){
            tempsTotalSeconde+=parseInt($(inputTemps[ i ]).val())*60*60;
        }
        else if($(inputTemps[ i ]).attr("data-attr-unite")=="m"){
            tempsTotalSeconde+=parseInt($(inputTemps[ i ]).val())*60;
        }
        else{
            tempsTotalSeconde+=parseInt($(inputTemps[ i ]).val());
        }
    }
    var stoH = dateHMS(tempsTotalSeconde);
    $('.dureeTotal span').html((parseInt(stoH[0])-1)+'J '+stoH[1]+'h '+stoH[2]+'m '+stoH[3]+'s');
}
function dateHMS(time) {
  var d = moment().startOf('year').seconds(time).format('DDD:HH:mm:ss');
  return d.split(':');
}

function getEtapeTypeByCat(cat){
    console.log("test");
    $('#etapeProduit option[value!=-1]').remove();
    $.ajax({
        url:  basePageAdmin+'etapetype/getByCat',
        type: 'POST',
        dataType: 'JSON',
        data:{id:cat},
        success: function(json) {
            if(json.success==1) {
                

            } else {
                bootbox.alert("<div class='alert alert-danger'>Une erreur est survenue</div>");
            }
        }
    });
}
function getEtapeType(idEtape){
}