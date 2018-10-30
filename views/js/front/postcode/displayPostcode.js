/**
 * 2018, Apium
 *
 * @author    Niels Wouda, Apium <n.wouda@apium.nl>
 * @copyright 2018, Apium
 */
import ajaxProcess, {POSTCODE_FORM} from "../functions/ajaxProcess";

function displayPostcode()
{
    "use strict";
    ajaxProcess(POSTCODE_FORM).done(data => {
        // Only append if it does not yet exist.
        if (!$("#houseNumber").length && data.html) {
            $("#postcode").parent().insertAfter(data.html);
        }
    });
}

export default displayPostcode;
