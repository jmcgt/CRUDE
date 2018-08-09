$('input').blur(function(){
    if($(this).val() != '')
    {
        $('label[for=\"'+$(this).attr('id')+'\"]').addClass('filled');
    }
    else{
        $('label[for=\"'+$(this).attr('id')+'\"]').removeClass('filled');
    }
});

function search_live()
{
    if(window.location.href=='http://localhost/Sites/CRUDE/index.php')
    {
        var txt = $('#busca').val();

        $.post('busca.php', {searchVal: txt}, function(saida){
            $('#table_lista').remove();
            $('#saida').html(saida);
        });
    }
}