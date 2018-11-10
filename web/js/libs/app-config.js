// -------------------------------------------------------------------------
// Initialize form config
$(function() {
    jQuery("#btn-back-to-default").on("click", function (e) {
        e.preventDefault();
        var targetBackToDefault = jQuery(this).attr("href"),
            confirmTitle = jQuery(this).data("confirm-title"),
            confirmMessage = jQuery(this).data("confirm-message");

        jQuery.confirm({
            title: confirmTitle,
            content: confirmMessage,
            type: "red",
            buttons: {
                confirm: function () {
                    jQuery.get(targetBackToDefault);
                },
                cancel: function () {
                    return true;
                }
            }
        });
    });

    jQuery("#form-app-config").on("afterValidate", function (event, messages, errorAttributes) {
        if (errorAttributes.length > 0) {
            jQuery.alert({
                content: jQuery("#form-app-config").data("error-fields-message"),
                type: "red"
            });
        }

    });
});