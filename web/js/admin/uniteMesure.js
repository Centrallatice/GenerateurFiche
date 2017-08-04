$('document').ready(function(){
    $('#adminbundle_unitemesure_langue,#adminbundle_unitemesure_groupe').on("change",function(){
        getDenreesByLang();
    });
    $('.colLang select').on("change",function(){
        $('.rowLang').addClass("hide");
        $('.rowLang#'+$(this).val()).removeClass("hide");
        $('.rowLang#1 .colLang select').val("1");
        $('.rowLang#2 .colLang select').val("2");
    })
    getDenreesByLang(); 
    $('#adminbundle_unitemesure_uniteMesureLang_0_nom').on("change",function(){
        $('.rowLang#1 span#add-on-1-1').html(" 1"+$(this).val()+" =");
        $('.rowLang#2 span#add-on-2-2').html($(this).val());
    });
    $('#adminbundle_unitemesure_uniteMesureLang_1_nom').on("change",function(){
        $('.rowLang#2 span#add-on-2-1').html(" 1"+$(this).val()+" =");
        $('.rowLang#1 span#add-on-1-2').html($(this).val());
    });
});
function getDenreesByLang(){
    $.ajax({
        url: basePageAdmin+'unitemesure/getByLangGroup',
        type: 'POST',
        dataType: 'json',
        data:{
            l:($('#adminbundle_unitemesure_langue').val()=="fr") ? "en" : "fr",
            g:$('#adminbundle_unitemesure_groupe').val()
        },
        success: function(json) {
            $('#adminbundle_unitemesure_uniteMesure option').remove();
            for(e in json.datas){
                $('<option value="'+json.datas[e]['id']+'">'+json.datas[e]['nom']+'</option>').appendTo("#adminbundle_unitemesure_uniteMesure");
            }
            
        }
    });
}