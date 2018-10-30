/**
 * 2018, Apium
 *
 * @author    Niels Wouda, Apium <n.wouda@apium.nl>
 * @copyright 2018, Apium
 */
export const POSTCODE = "postcode";
export const POSTCODE_FORM = "postcodeForm";

const actions = new Set([
    POSTCODE,
    POSTCODE_FORM
]);

function ajaxProcess(action, data)
{
    "use strict";
    if (!actions.has(action)) {
        throw new Error(`Unknown action ${action}.`);
    }

    return $.ajax({
        url: "index.php",
        type: "POST",
        cache: false,
        dataType: "JSON",
        data: $.extend({
            action: action,
            module: "postcodenl",
            controller: "postcode",
            ajax: true,
            fc: 'module'
        }, data)
    });
}

export default ajaxProcess;
