$('document').ready(function(){
   $('textarea').froalaEditor({height: 300});
    $('.colLang select').on("change",function(){
        $('.rowEtape').addClass("hide");
        $('.rowEtape#'+$(this).val()).removeClass("hide");
        $('.rowEtape#1 .colLang select').val("1");
        $('.rowEtape#2 .colLang select').val("2");
    })
    
});
