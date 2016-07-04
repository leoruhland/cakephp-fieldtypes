<?php

namespace FieldTypes\View\Widget;

use Cake\View\Form\ContextInterface;
use Cake\Utility\Inflector;

if(!class_exists('\BootstrapUI\View\Widget\SelectBoxWidget')){
    class_alias('\Cake\View\Widget\SelectBoxWidget', '\BootstrapUI\View\Widget\SelectBoxWidget');
}

class BootstrapSelectWidget extends \BootstrapUI\View\Widget\SelectBoxWidget
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
            'type' => 'text',
            'escape' => true,
            'class' => '',
            'templateVars' => []
        ];

        $data['type'] = 'select';
        $data['value'] = $data['val'];
        $data['class'] = $this->_generateFieldClass('ft-bootstrap-select', $data['name']);

        $data['options'] = $this->_optionsOptions($data['name'], $data);

        $ftOptions = isset($data['ftOptions']) ? $data['ftOptions'] : [];

        if(!isset($ftOptions['width'])){
            $ftOptions['width'] = '100%';
        }

        // Clean data
        unset($data['ftOptions']);
        unset($data['col']);

        // Script/styles include
        echo $this->_View->Html->css('FieldTypes.../vendor/bootstrap-select/dist/css/bootstrap-select.min.css', ['block' => 'css']);
        echo $this->_View->Html->script('FieldTypes.../vendor/bootstrap-select/dist/js/bootstrap-select.min.js', ['block' => 'headjs']);

        // Script call
        $this->_View->Html->scriptStart(['block' => true]);
        echo '$(document).ready(function() { $(".'.$data['class'].'").selectpicker('.(json_encode($ftOptions, true)).') });';
        $this->_View->Html->scriptEnd();

        return parent::render($data, $context);

    }

    public function secureFields(array $data)
    {
        return [$data['name']];
    }

    protected function _optionsOptions($fieldName, $options)
    {
        $pluralize = true;
        if (substr($fieldName, -5) === '._ids') {
            $fieldName = substr($fieldName, 0, -5);
            $pluralize = false;
        } elseif (substr($fieldName, -3) === '_id') {
            $fieldName = substr($fieldName, 0, -3);
        }
        $fieldName = array_slice(explode('.', $fieldName), -1)[0];

        $varName = Inflector::variable(
            $pluralize ? Inflector::pluralize($fieldName) : $fieldName
        );
        return $this->_View->get($varName);
    }
}
