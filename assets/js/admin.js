
function cs_showHideSlide(spnId, divId) {
    if (jQuery("#" + spnId).hasClass("dashicons-arrow-down")) {
        cs_showSlideUp(spnId, divId);
    } else {
        cs_showSlideDown(spnId, divId);
    }
}

function cs_showSlideDown(spnId, divId) {
    jQuery("#" + spnId).addClass("dashicons-arrow-down").removeClass("dashicons-arrow-up");
    jQuery("#" + divId).show();
}
function cs_showSlideUp(spnId, divId) {
    jQuery("#" + spnId).addClass("dashicons-arrow-up").removeClass("dashicons-arrow-down");
    jQuery("#" + divId).hide();
}
