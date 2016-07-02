<?php

namespace FieldTypes\View\Widget;

use Cake\View\Form\ContextInterface;

class FlatpickrWidget extends \BootstrapUI\View\Widget\BasicWidget
{
    protected $_templates;
    protected $_View;

    public function __construct($templates, $view)
    {
        $this->_templates = $templates;
        $this->_View = $view;
    }


    protected function _generateFieldClass($prefix, $fieldName){
		return $prefix . '-' . str_replace(['.'], '', $fieldName) . '-' . uniqid();
	}

    public function render(array $data, ContextInterface $context)
    {
        $data += [
            'name' => '',
            'val' => null,
            'type' => 'textarea',
            'escape' => true,
            'class' => '',
            'templateVars' => []
        ];

        $data['value'] = $data['val'];
        $data['class'] = $this->_generateFieldClass('ft-datepicker', $data['name']);

        $ftOptions = isset($data['ftOptions']) ? $data['ftOptions'] : [];

        unset($data['ftOptions']);
        unset($data['col']);

        // Script/styles include
        echo $this->_View->Html->script('FieldTypes.../vendor/flatpickr/dist/flatpickr.min.js', ['block' => 'headjs']);
        echo $this->_View->Html->script('FieldTypes.../vendor/flatpickr/src/flatpickr.l10n.pt.js', ['block' => 'headjs']);
        echo $this->_View->Html->css('FieldTypes.../vendor/flatpickr/dist/flatpickr.min.css', ['block' => 'css']);

        // Script call
        $this->_View->Html->scriptStart(['block' => true]);
        echo '$(document).ready(function() { flatpickr(".'.$data['class'].'", '.(json_encode($ftOptions, true)).') });';
        $this->_View->Html->scriptEnd();

        return parent::render($data, $context);

    }

    public function secureFields(array $data)
    {
        return [$data['name']];
    }
}
