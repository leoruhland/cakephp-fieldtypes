<?php

namespace FieldTypes\View\Widget;

use Cake\View\Form\ContextInterface;
use Cake\Utility\Inflector;

if(!class_exists('\BootstrapUI\View\Widget\SelectBoxWidget')){
    class_alias('\Cake\View\Widget\SelectBoxWidget', '\BootstrapUI\View\Widget\SelectBoxWidget');
}

class Select2Widget extends \BootstrapUI\View\Widget\SelectBoxWidget
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
            'type' => 'select',
            'escape' => true,
            'class' => '',
            'templateVars' => []
        ];

        $data['value'] = $data['val'];
        $data['type'] = 'select';
        $data['class'] = $this->_generateFieldClass('ft-select2', $data['name']);

        $data['options'] = $this->_optionsOptions($data['name'], $data);
        //debug($data);
        $ftOptions = isset($data['ftOptions']) ? $data['ftOptions'] : [];

        if(!isset($ftOptions['theme'])){
            $ftOptions['theme'] = 'bootstrap';
        }

        // Clean data
        unset($data['ftOptions']);
        unset($data['col']);

        // Script/styles include
        echo $this->_View->Html->css('FieldTypes.../vendor/select2/dist/css/select2.min.css', ['block' => 'css']);
        echo $this->_View->Html->css('FieldTypes.../vendor/select2-bootstrap-theme/dist/select2-bootstrap.min.css', ['block' => 'css']);
        echo $this->_View->Html->script('FieldTypes.../vendor/select2/dist/js/select2.full.min.js', ['block' => 'headjs']);

        // Script call
        $this->_View->Html->scriptStart(['block' => true]);
        echo '$(document).ready(function() { $(".'.$data['class'].'").select2('.(json_encode($ftOptions, true)).') });';
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
