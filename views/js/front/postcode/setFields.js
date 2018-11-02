/**
 * 2018, Apium
 *
 * @author    Niels Wouda, Apium <n.wouda@apium.nl>
 * @copyright 2018, Apium
 */
function setFields(data)
{
    "use strict";
    $("#address1").val(addressLineFormatter(data));
    $("#postcode").val(data.postcode);
    $("#city").val(data.city);
}

function addressLineFormatter(data)
{
    "use strict";
    return data.street + " " + data.houseNumber + data.houseNumberAddition;
}

export default setFields;
