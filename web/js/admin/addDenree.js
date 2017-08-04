$('document').ready(function(){
    setInfo($('#adminbundle_denree_uniteMesure'));
    $('#adminbundle_denree_uniteMesure').on("change",function(){
        setInfo(this);
    });
});
function setInfo(e){
    $('#prixMoreInfo').html(" (Valeur unitaire HT pour 1 "+$(e).val()+')');
}
