function showNotification(type, msg) {
    var notification_bar = $('.notification');

    if (msg) {
        if (type == 'error')
            notification_bar.prepend("<div class='err'>" + msg + "</div>");
        else
            notification_bar.prepend("<div>" + msg + "</div>");

        notification_bar.find('div').first().slideDown(200, function () {
            $(this).delay(3600).slideUp(200);
        });
    }
}