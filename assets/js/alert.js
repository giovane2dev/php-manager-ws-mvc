



function alertBootstrap(text, type, url) {
    var color = null;
    var strType = null;
    var message;


    if (type == 'success') {
        color = '#52adea';
        strType = '';
    }
    else if (type == 'warning') {
        color = '#18bc9c';
        strType = "<div id=\"message\"><a id=\"yesMessage\" class=\"btn btn-primary mr-2\" style=\"background-color:#0a826a; border:none;\" role=\"button\">SIM</a>" +
                "<a id=\"noMessage\" class=\"btn btn-primary\" style=\"background-color:#046753; border:none;\" role=\"button\">NÃO</a></div>";
    }



    message = "<div id=\"\" class=\"text-center;\" style=\"background-color:" + color +
            "; position: absolute; padding-top:15px; height:15%; width:100%; top:85%; text-align:center;\">" + text +
            "<br/>" + strType + "</div>";
    $('#content').append(message);

    if (strType != '') {
        $('#yesMessage').click(function () {
            getContent('#message', url);
        });
    }

}