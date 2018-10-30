<?php
/**
 * 2018, Apium
 *
 * @author    Niels Wouda, Apium <n.wouda@apium.nl>
 * @copyright 2018, Apium
 */
defined('_PS_VERSION_') || exit;

require_once 'vendor/autoload.php';

class PostcodeNL extends Module
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
            && $this->registerHook('displayHeader');
    }

    public function uninstall()
    {
        return parent::uninstall()
            && $this->unregisterHook('displayHeader');
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

        $this->context->controller->addJS($this->getPathUri().'views/js/front.bundle.js');

        Media::addJsDef([
            'country_postcode_active' => Country::getByIso('NL')
        ]);
    }

    private function shouldAddProcessing()
    {
        $controllers = ['address']; // TODO extend where necessary
        return in_array($this->context->controller->php_self, $controllers);
    }
}
