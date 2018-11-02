/**
 * 2018, Apium
 *
 * @author    Niels Wouda, Apium <n.wouda@apium.nl>
 * @copyright 2018, Apium
 */
import hideFields from "./postcode/hideFields";
import showFields from "./postcode/showFields";
import ajaxPostcode from "./postcode/ajaxPostcode";

$(document).on("change", "select[name='id_country']", function () {
    "use strict";
    /* global country_postcode_active */
    if (parseInt($(this).val()) === country_postcode_active) {
        hideFields(); // hide superfluous fields (address lines, city)
    } else {
        showFields(); // different country
    }
});

$(document).on("focusout", "#postcode, #houseNumber", ajaxPostcode);

$(document).ready(() => {
    "use strict";
    $("select[name='id_country']").change();
});

