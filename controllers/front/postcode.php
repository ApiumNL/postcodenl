<?php
/**
 * 2018, Apium
 *
 * @author    Niels Wouda, Apium <n.wouda@apium.nl>
 * @copyright 2018, Apium
 */
defined('_PS_VERSION_') || exit;

use PostcodeNl_Api_RestClient;

class PostcodeNLPostcodeModuleFrontController extends ModuleFrontController
{
    public function displayAjaxPostcode()
    {
        try { // the client is a bit exception-happy, so best to wrap this
            $client = new PostcodeNl_Api_RestClient(
                Configuration::get('POSTCODE_NL_API_KEY'),
                Configuration::get('POSTCODE_NL_API_SECRET')
            );

            $lookup = $client->lookupAddress(
                Tools::getValue('postcode'),
                Tools::getValue('houseNumber')
            );

            die(json_encode($lookup));
        } catch (PostcodeNl_Api_RestClient_Exception $e) {
            die(json_encode(false));
        }
    }
}
