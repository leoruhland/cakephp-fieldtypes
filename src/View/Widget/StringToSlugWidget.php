<?php

namespace FieldTypes\View\Widget;

use Cake\View\Form\ContextInterface;

if(!class_exists('\BootstrapUI\View\Widget\BasicWidget')){
    class_alias('\Cake\View\Widget\BasicWidget', '\BootstrapUI\View\Widget\BasicWidget');
}

class StringToSlugWidget extends \BootstrapUI\View\Widget\BasicWidget
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
        $data['class'] = $this->_generateFieldClass('ft-stringtoslug', $data['name']);

        $ftOptions = isset($data['ftOptions']) ? $data['ftOptions'] : [];

        // Clean data
        unset($data['ftOptions']);
        //unset($data['val']);
        unset($data['col']);

        // Script/styles include
        echo $this->_View->Html->script('FieldTypes.../vendor/speakingurl/speakingurl.min.js', ['block' => 'headjs']);
        echo $this->_View->Html->script('FieldTypes.../vendor/jquery.stringtoslug/dist/jquery.stringtoslug.min.js', ['block' => 'headjs']);

        // Script call
        $this->_View->Html->scriptStart(['block' => true]);
        echo '$(document).ready(function() { $(".'.$data['class'].'").stringToSlug('.(json_encode($ftOptions, true)).') });';
        $this->_View->Html->scriptEnd();

        return parent::render($data, $context);

    }

    public function secureFields(array $data)
    {
        return [$data['name']];
    }
}
