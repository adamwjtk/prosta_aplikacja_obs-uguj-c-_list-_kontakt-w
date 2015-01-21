
var http = new XMLHttpRequest(),
        json;
http.onreadystatechange = function()
{
    if(http.readyState === 4 && http.status === 200) 
    {
        json = JSON.parse(http.responseText);
        console.log(json);
        
        $(function() {
            $.each(json, function(i, item) {
                var $tr = $('<tr>').append(
                    $('<td>').text(item.name),
                    $('<td>').text(item.surname),
                    $('<td>').text(item.mail)
            );//.appendTo('#records_table');
            $tr.appendTo('#contact_table');
               // $tr.wrap('<table>').html() ;
        });
        
        });
    };
};
http.open('GET', '/DisplayList/show', true);
http.send();