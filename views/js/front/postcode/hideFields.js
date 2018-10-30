/**
 * 2018, Apium
 *
 * @author    Niels Wouda, Apium <n.wouda@apium.nl>
 * @copyright 2018, Apium
 */
function hideFields()
{
    "use strict";
    const fields = [
        'address1',
        'address2',
        'city'
    ];

    fields.forEach(item => {
        $("#" + item).parent().hide();
    });

    $("#houseNumber").show(); // this belongs to the postcode processing
}

export default hideFields;
