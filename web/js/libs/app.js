// Initialize
jQuery(function () {
    jQuery("body > .px-nav").pxNav();
    jQuery("body > .px-footer").pxFooter();
    jQuery("#navbar-messages-notifications").perfectScrollbar();
    jQuery(document).on("click", "#btn-menu-logout", function (e) {
        e.preventDefault();
        var targetLogout = jQuery(this).data("url"),
            confirmTitle = jQuery(this).data("confirm-title"),
            confirmMessage = jQuery(this).data("confirm-message");

        jQuery.confirm({
            title: confirmTitle,
            content: confirmMessage,
            buttons: {
                confirm: {
                    btnClass: "btn-blue",
                    action: function () {
                        jQuery.post(targetLogout);
                    }
                },
                cancel: function () {
                    return true;
                }
            }
        });
    });
});