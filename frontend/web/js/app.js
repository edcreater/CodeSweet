/**
 *  @author Eugene Terentev <eugene@terentev.net>
 */
$("code[class^='language-']").each(function(){
    $(this).html($(this).html().trim());
});