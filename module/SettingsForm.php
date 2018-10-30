<?php
/**
 * 2018, Apium
 *
 * @author    Niels Wouda, Apium <n.wouda@apium.nl>
 * @copyright 2018, Apium
 */
namespace Apium\PostcodeNL\Module;

defined('_PS_VERSION_') || exit;

class SettingsForm extends ModuleForm
{
    /**
     * @inheritdoc
     */
    protected $legend = 'Settings';

    /**
     * @inheritdoc
     */
    protected $submitAction = 'settingsSubmit';

    /**
     * @inheritdoc
     */
    protected $configFields = [
        'POSTCODE_NL_API_KEY' => [
            'type' => 'text',
            'validate' => 'isString',
            'required' => true,
            'label' => 'Postcode.nl API key',
            'desc' => [
                'API key, as provided by postcode.nl.'
            ]
        ],
        'POSTCODE_NL_API_SECRET' => [
            'type' => 'text',
            'validate' => 'isString',
            'required' => true,
            'label' => 'Postcode.nl API secret',
            'desc' => [
                'API secret, as provided by postcode.nl'
            ]
        ]
    ];
}
