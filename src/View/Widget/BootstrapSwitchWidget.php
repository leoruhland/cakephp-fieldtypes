<?php

namespace FieldTypes\View\Widget;

use Cake\View\Form\ContextInterface;

class BootstrapSwitchWidget extends \Cake\View\Widget\CheckboxWidget
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

        $data['value'] = $data['val'];
        $data['class'] = $this->_generateFieldClass('ft-bootstrap-switch', $data['name']);

        $ftOptions = isset($data['ftOptions']) ? $data['ftOptions'] : [];

        unset($data['ftOptions']);
        unset($data['col']);

        // Script/styles include
        echo $this->_View->Html->script('FieldTypes.../vendor/bootstrap-switch/dist/js/bootstrap-switch.min.js', ['block' => 'headjs']);
        echo $this->_View->Html->css('FieldTypes.../vendor/bootstrap-switch/dist/css/bootstrap3/bootstrap-switch.css', ['block' => 'css']);
        echo $this->_View->Html->css('FieldTypes.switch.css', ['block' => 'css']);

        // Script call
        $this->_View->Html->scriptStart(['block' => true]);
        echo '$(document).ready(function() { $(".'.$data['class'].'").bootstrapSwitch('.(json_encode($ftOptions, true)).'); });';
        $this->_View->Html->scriptEnd();

        return parent::render($data, $context);
    }

    public function secureFields(array $data)
    {
        return [$data['name']];
    }
}
