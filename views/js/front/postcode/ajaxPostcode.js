/**
 * 2018, Apium
 *
 * @author    Niels Wouda, Apium <n.wouda@apium.nl>
 * @copyright 2018, Apium
 */
import validate from "./validators";
import ajaxProcess, {POSTCODE} from "../functions/ajaxProcess";

function ajaxPostcode()
{
    "use strict";
    const $postcode = $("#postcode");
    const $houseNumber = $("#houseNumber");

    if (!validate($postcode, $houseNumber)) {
        return;
    }

    ajaxProcess(POSTCODE, {
        postcode: $postcode.val(),
        houseNumber: $houseNumber.val(),
        cache: false
    }).done(data => {
        // TODO
    });
}

export default ajaxPostcode;
