<?php
/**
 * 2018, Apium
 *
 * @author    Niels Wouda, Apium <n.wouda@apium.nl>
 * @copyright 2018, Apium
 */
namespace Apium\PostcodeNL\Module;

defined('_PS_VERSION_') || exit;

abstract class ModuleForm extends ModuleField
{
    /**
     * @var string $submitAction The submit action for this form.
     */
    protected $submitAction = null;

    /**
     * @var string $legend The form's legend title
     */
    protected $legend = null;

    /**
     * @var array $configFields The form's configuration fields.
     */
    protected $configFields = [];

    protected function getSubmitAction()
    {
        return $this->submitAction;
    }

    protected function getConfigFields()
    {
        return $this->configFields;
    }

    /**
     * If submitted, processes this form - validates the fields, and updates
     * the configuration.
     *
     * @return string Output message.
     */
    public function process()
    {
        if (!\Tools::isSubmit($this->getSubmitAction())) {
            return '';
        }

        if ($this->validate()) {
            return $this->update();
        }

        $text = implode(
            ' ',
            [
                $this->module->l('Could not validate form fields.'),
                $this->module->l('Are you sure the values are correctly formatted?'),
            ]
        );

        return $this->module->displayError($text);
    }

    /**
     * Renders the form using the built-in HelperForm.
     *
     * @return string Rendered form
     */
    public function render()
    {
        $helper = new \HelperForm();

        // module, token and current index
        $helper->module = $this->module;
        $helper->name_controller = $this->module->name;
        $helper->token = \Tools::getAdminTokenLite('AdminModules');
        $helper->currentIndex = \AdminController::$currentIndex.'&configure='.$this->module->name;

        // language
        $helper->default_form_language = (int)\Configuration::get('PS_LANG_DEFAULT');
        $helper->allow_employee_form_lang = \Configuration::get('PS_BO_ALLOW_EMPLOYEE_FORM_LANG') ?: 0;

        // field values
        $helper->fields_value = $this->getConfigFieldsValues();

        // title and toolbar
        $helper->title = $this->module->displayName;
        $helper->show_toolbar = false;
        $helper->toolbar_scroll = false;
        $helper->submit_action = $this->getSubmitAction();

        $href = [
            'configure' => $this->module->name,
            'save' => $this->module->name,
            'token' => \Tools::getAdminTokenLite('AdminModules')
        ];

        $helper->toolbar_btn = [
            'save' => [
                'desc' => $this->module->l('Save'),
                'href' => \AdminController::$currentIndex.http_build_query($href)
            ]
        ];

        return $helper->generateForm([$this->form()]);
    }

    /**
     * Form data for the form helper
     *
     * @return array The form data.
     */
    protected function form()
    {
        $settings = [
            'form' => [
                'legend' => [
                    'title' => $this->module->l($this->legend),
                    'icon' => 'icon-cog',
                ],
                'input' => [],
                'submit' => [
                    'title' => $this->module->l('Save'),
                ],
            ],
        ];

        // Set-up input fields
        foreach ($this->getConfigFields() as $field => $config) {
            $config['name'] = $field;
            $config['label'] = $this->toPrestaLang($config['label']);
            $config['desc'] = $this->toPrestaLang(...$config['desc']);

            $settings['form']['input'][] = $config;
        }

        return $settings;
    }

    /**
     * Updates the configuration fields in the database. Assumes the data has
     * been validated before.
     *
     * @see CredentialsForm::validate()
     *
     * @return string Confirmation or warning message, depending on whether the
     *                update was successful.
     */
    protected function update()
    {
        $result = true;

        foreach (array_keys($this->getConfigFields()) as $field) {
            $value = \Tools::getValue($field, \Configuration::get($field));

            $result = $result
                && \Configuration::updateValue($field, trim($value));
        }

        if (!$result) {
            $text = $this->module->l('Could not update module configuration!');
            return $this->module->displayError($text);
        }

        $this->updateCallback(); // allows for some additional processing

        $text = $this->module->l('Configuration was successfully updated!');
        return $this->module->displayConfirmation($text);
    }

    /**
     * Validates the set fields for the module configuration. See also the
     * config fields in the module.
     *
     * @return bool Valid data or not?
     */
    protected function validate()
    {
        $result = true;

        foreach ($this->getConfigFields() as $field => $settings) {
            $value = \Tools::getValue($field, \Configuration::get($field));

            if (!$settings['required'] && empty($value)) {
                continue; // not required and empty - fine.
            }

            $result = $result
                && !empty($value)
                && call_user_func(
                    [
                        \Validate::class,
                        $settings['validate']
                    ],
                    $value
                );
        }

        return $result;
    }

    protected function toPrestaLang(...$items)
    {
        return implode( // maps the passed items into a single translated string
            ' ',
            array_map(
                function ($item) {
                    return $this->module->l($item);
                },
                $items
            )
        );
    }

    /**
     * Called after a successful update of the configuration, for (optional)
     * further processing.
     */
    protected function updateCallback()
    {
        // intentional stub - see subclass implementations.
    }

    /**
     * Maps the configuration fields to current values.
     *
     * @return array Array of config fields (key) to values.
     */
    private function getConfigFieldsValues()
    {
        $values = array_map(
            function ($item) {
                return \Tools::getValue($item, \Configuration::get($item));
            },
            array_keys($this->getConfigFields())
        );

        return array_combine(array_keys($this->getConfigFields()), $values);
    }
}
