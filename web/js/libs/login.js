// -------------------------------------------------------------------------
// Initialize page components
$(function() {
    $("#page-signin-forgot-link").on("click", function(e) {
        e.preventDefault();

        $("#page-signin-form, #page-signin-social")
            .css({ opacity: "1" })
            .animate({ opacity: "0" }, 200, function() {
                $(this).hide();

                $("#page-signin-forgot-form")
                    .css({ opacity: "0", display: "block" })
                    .animate({ opacity: "1" }, 200)
                    .find(".form-control").first().focus();

                $(window).trigger("resize");
                $("#page-back-to-login").removeClass("hidden");
            });
    });

    $("#page-signin-forgot-back").on("click", function(e) {
        e.preventDefault();

        $("#page-signin-forgot-form")
            .animate({ opacity: "0" }, 200, function() {
                $(this).css({ display: "none" });

                $("#page-signin-form, #page-signin-social")
                    .show()
                    .animate({ opacity: "1" }, 200)
                    .find(".form-control").first().focus();

                $(window).trigger("resize");
                $("#page-back-to-login").addClass("hidden");
            });
    });

    $("#btn-reload-captcha").on("click", function (e) {
        e.preventDefault();
        $("#forgotpassword-verifycode-image").trigger("click");
    });
});