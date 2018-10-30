<?php
/**
 * 2018, Apium
 *
 * @author    Niels Wouda, Apium <n.wouda@apium.nl>
 * @copyright 2018, Apium
 */
defined('_PS_VERSION_') || exit;

class PostcodeNLPostcodeModuleFrontController extends ModuleFrontController
{
    public function __construct()
    {
        $this->ajax = true;
    }

    public function displayAjaxPostcode()
    {
        // TODO
    }

    public function displayAjaxPostcodeForm()
    {
        die(json_encode([
            'html' => $this->context->smarty->fetch(
                $this->module->local_path.'views/templates/front/postcode.tpl'
            )
        ]));
    }
}
