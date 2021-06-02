$(function () {
    $(".form").submit(function (e) {
        e.preventDefault();

        var form = $(this);
        var action = form.attr("action");
        var data = form.serialize();

        $.ajax({
            url: action,
            data: data,
            type: "post",
            dataType: "json",
            success: function (su) {
                if (su.message) {
                    var view = '\
                            <div class="message fade show ' + su.message.type + '">\n\
                                ' + su.message.message + '\n\
                            </div>\n\
                        ';
                    
                    $(".login_form_callback").html(view);
                    $(".message").effect("bounce");
                    return;
                }

                if (su.redirect) {
                    window.location.href = su.redirect.url;
                }
            }
        });
    });
});