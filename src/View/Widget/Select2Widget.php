<?php

namespace FieldTypes\View\Widget;

use Cake\View\Form\ContextInterface;

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
            'type' => 'text',
            'escape' => true,
            'class' => '',
            'templateVars' => []
        ];

        $data['value'] = $data['val'];
        $data['class'] = $this->_generateFieldClass('ft-select2', $data['name']);

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
        echo $this->_View->Html->script('FieldTypes.../vendor/select2/dist/js/select2.min.js', ['block' => 'headjs']);

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
}
