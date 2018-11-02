/**
 * 2018, Apium
 *
 * @author    Niels Wouda, Apium <n.wouda@apium.nl>
 * @copyright 2018, Apium
 */
export default function validate($postcode, $houseNumber)
{
    "use strict";
    return isString($houseNumber.val())
        && isPostCode($postcode.val());
}

function isString(candidate)
{
    "use strict";
    if (!candidate) {
        return false; // should *not* be empty
    }

    // see https://stackoverflow.com/a/9436948/4316405
    return typeof candidate === 'string' || candidate instanceof String;
}

function isPostCode(candidate)
{
    "use strict";
    /* global countriesNeedZipCode, country_postcode_active */
    const pattern = countriesNeedZipCode[country_postcode_active];
    return window.validate_isPostCode(candidate, pattern);
}
