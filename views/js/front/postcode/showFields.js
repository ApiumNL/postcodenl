/**
 * 2018, Apium
 *
 * @author    Niels Wouda, Apium <n.wouda@apium.nl>
 * @copyright 2018, Apium
 */
function showFields()
{
    "use strict";
    const fields = [
        'address1',
        'address2',
        'city'
    ];

    fields.forEach(item => {
        $("#" + item).parent().show();
    });

    $("div.postcodenl").hide(); // this belongs to the postcode processing
}

export default showFields;
