/*!
 * Functions for get and post content using ajax
 * Requires jQuery v1.5 or later 
 */

var string = "AGUARDE...";

// function for get content
function getContent(Content, URL) {
    $.ajax({
        type: "GET",
        url: URL,
        async: true,
        beforeSend: function() {
            $(Content).html(string);
        },
        success: function(data) {
            $(Content).html(data);
        },
        error: function() {
            $(Content).html(string);
        }
    });
}

// function for post content
function postContent(Content, Form) {
    $(document).ready(function() {
        $(Form).ajaxForm({
            beforeSend: function() {
                $(Content).html(string);
            },
            uploadProgress: function() {
                $(Content).html(string);
            },
            success: function() {
                $(Content).html(string);
            },
            complete: function(data) {
                $(Content).html(data.responseText);
            },
            error: function() {
                $(Content).html(string);
            }
        });
    });
}