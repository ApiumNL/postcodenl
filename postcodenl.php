<?php
/**
 * 2018, Apium
 *
 * @author    Niels Wouda, Apium <n.wouda@apium.nl>
 * @copyright 2018, Apium
 */
defined('_PS_VERSION_') || exit;

require_once 'vendor/autoload.php';

class PostCodeNL extends Module
{
    public function __construct()
    {
        $this->name = 'postcodenl';
        $this->version = '1.0.0';
        $this->author = 'Apium';
        $this->need_instance = false;
        $this->bootstrap = true;

        parent::__construct();

        $this->displayName = $this->l('Postcode.nl auto-complete');
        $this->description = $this->l('Completes the address forms via postcode.nl.');

        $this->ps_versions_compliancy = array(
            'min' => '1.6.0.0',
            'max' => _PS_VERSION_
        );
    }

    public function install()
    {
        return parent::install()
            && $this->registerHook('displayHeader')
            && $this->registerHook('displayPostCodeNL')
            && $this->registerHook('displayOverrideTemplate');
    }

    public function uninstall()
    {
        return parent::uninstall()
            && $this->unregisterHook('displayHeader')
            && $this->unregisterHook('displayPostCodeNL')
            && $this->unregisterHook('displayOverrideTemplate');
    }

    public function getContent()
    {
        $settingsForm = new \Apium\PostcodeNL\Module\SettingsForm($this);

        return $settingsForm->process().$settingsForm->render();
    }

    public function hookDisplayHeader()
    {
        if (!$this->shouldAddProcessing() || !$this->active) {
            return;
        }

        // Webpack is in control of CSS assets
        $this->context->controller->addCSS($this->getPathUri().'views/css/front.styles.css');
        $this->context->controller->addJS($this->getPathUri().'views/js/front.bundle.js');

        Media::addJsDef([
            'country_postcode_active' => Country::getByIso('NL')
        ]);
    }

    /**
     * Used to override the address template. Change this template (in
     * `/views/templates` to suit your particular theme. Default works for
     * PS 1.6.x.
     */
    public function hookDisplayOverrideTemplate($params)
    {
        if ($params['controller']->php_self == "address") {
            return $this->local_path.'views/templates/hook/address.tpl';
        }

        return false;
    }

    public function hookDisplayPostCodeNL()
    {
        return $this->context->smarty->fetch(
            $this->local_path.'views/templates/hook/postcodenl.tpl'
        );
    }

    private function shouldAddProcessing()
    {
        $controllers = ['address']; // TODO extend where necessary
        return in_array($this->context->controller->php_self, $controllers);
    }
}
