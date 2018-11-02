/**
 * 2018, Apium
 *
 * @author    Niels Wouda, Apium <n.wouda@apium.nl>
 * @copyright 2018, Apium
 */
import setFields from "./setFields";
import validate from "./validators";
import ajaxProcess, {POSTCODE} from "../functions/ajaxProcess";

const fields = {
    city: item => item.city,
    houseNumber: item => item.houseNumber + item.houseNumberAddition,
    postcode: item => item.postcode,
    street: item => item.street
};

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
        if (!Boolean(data)) { // could not find the address - return and hope for the best?
            return;
        }

        for (const field in fields) {
            $(`span.${field}`).html(fields[field](data));
        }

        $("div.postcodenl-template").show();

        setFields(data); // populates the input fields with postcode.nl data
    });
}

export default ajaxPostcode;
