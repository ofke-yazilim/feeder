$(document).ready(function () {
    $("#form").submit(function(e) {
        e.preventDefault(); // avoid to execute the actual submit of the form.

        var form = $(this);
        var actionUrl = form.attr('action');

        $.ajax({
            type: "JSON",
            url: actionUrl,
            data: form.serialize(), // serializes the form's elements.
            success: function(response) {
                console.log(response);
            }
        });
    });
 });
