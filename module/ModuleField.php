<?php
/**
 * 2018, Apium
 *
 * @author    Niels Wouda, Apium <n.wouda@apium.nl>
 * @copyright 2018, Apium
 */
namespace Apium\PostcodeNL\Module;

defined('_PS_VERSION_') || exit;

class ModuleField
{
    /**
     * @var \Module $module The associated PrestaShop module
     */
    protected $module;

    public function __construct($module)
    {
        $this->module = $module;
    }
}
