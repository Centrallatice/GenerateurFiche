$('document').ready(function(){
    $('.colLang select').on("change",function(){
        $('.rowLang').addClass("hide");
        $('.rowLang#'+$(this).val()).removeClass("hide");
        $('.rowLang#1 .colLang select').val("1");
        $('.rowLang#2 .colLang select').val("2");
    })
});