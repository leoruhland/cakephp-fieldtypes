<?php
/**
 * CakeManager (http://cakemanager.org)
 * Copyright (c) http://cakemanager.org
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) http://cakemanager.org
 * @link          http://cakemanager.org CakeManager Project
 * @since         1.0
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

namespace FieldTypes\View\Helper;

use Cake\View\Helper;
use Bootstrap\View\Helper\BootstrapFormHelper;

class FieldTypesFormHelper extends BootstrapFormHelper {


	protected function _generateFieldClass($prefix, $fieldName){
		return $prefix . '-' . str_replace(['.'], '', $fieldName);
	}

	public function input($fieldName, array $options = array()) {

		$options = $this->_parseOptions($fieldName, $options);
		$_ftOptions = [];

		if(!isset($options['ft-options'])){
			$ftOptions = [];
		} else {
			$ftOptions = $options['ft-options'];
			unset($options['ft-options']);
		}

		switch($options['type']) {

			case 'select2':
			$options['type'] = 'select';
			$options['class'] = $this->_generateFieldClass('ft-select2', $fieldName);
			echo $this->Html->script('FieldTypes.select2');
			echo $this->Html->css('FieldTypes.select2');
			$this->Html->scriptStart(['block' => true]);
			echo '$(document).ready(function() { $(".'.$options['class'].'").select2('.(json_encode($ftOptions, true)).'); });';
			$this->Html->scriptEnd();
			break;

			case 'summernote':
			$_ftOptions = ['height' => '300'];
			$ftOptions = array_merge($_ftOptions, $ftOptions);
			$options['type'] = 'textarea';
			$options['class'] = $this->_generateFieldClass('ft-summernote', $fieldName);
			echo $this->Html->script('FieldTypes.summernote');
			echo $this->Html->css('FieldTypes.summernote');
			$this->Html->scriptStart(['block' => true]);
			echo '$(document).ready(function() { $(".'.$options['class'].'").summernote('.(json_encode($ftOptions, true)).'); });';
			$this->Html->scriptEnd();
			break;

			case 'datepicker':
			$options['type'] = 'text';
			$options['class'] = $this->_generateFieldClass('ft-datepicker', $fieldName);
			echo $this->Html->script('FieldTypes.datepicker');
			echo $this->Html->css('FieldTypes.datepicker');
			$this->Html->scriptStart(['block' => true]);
			echo '$(document).ready(function() { $(".'.$options['class'].'").datepicker('.(json_encode($ftOptions, true)).'); });';
			$this->Html->scriptEnd();
			break;

			case 'datetimepicker':
			$options['type'] = 'text';
			$options['class'] = $this->_generateFieldClass('ft-datetimepicker', $fieldName);
			echo $this->Html->script('FieldTypes.datetimepicker');
			echo $this->Html->css('FieldTypes.datetimepicker');
			$this->Html->scriptStart(['block' => true]);
			echo '$(document).ready(function() { $(".'.$options['class'].'").datetimepicker('.(json_encode($ftOptions, true)).'); });';
			$this->Html->scriptEnd();
			break;

			case 'colorpicker':
			$options['type'] = 'text';
			$options['class'] = $this->_generateFieldClass('ft-colorpicker', $fieldName);
			echo $this->Html->script('FieldTypes.colorpicker');
			echo $this->Html->css('FieldTypes.colorpicker');
			$this->Html->scriptStart(['block' => true]);
			echo '$(document).ready(function() { $(".'.$options['class'].'").colorpicker('.(json_encode($ftOptions, true)).'); });';
			$this->Html->scriptEnd();
			break;

			case 'toggle':
			$options['type'] = 'checkbox';
			$options['class'] = $this->_generateFieldClass('ft-toggle', $fieldName);
			$options['data-toggle'] = 'toggle';
			echo $this->Html->script('FieldTypes.toggle');
			echo $this->Html->css('FieldTypes.toggle');
			$this->Html->scriptStart(['block' => true]);
			echo '$(document).ready(function() { $(".'.$options['class'].'").bootstrapToggle('.(json_encode($ftOptions, true)).'); });';
			$this->Html->scriptEnd();
			break;

			case 'touchspin':
			$options['type'] = 'text';
			$options['class'] = $this->_generateFieldClass('ft-touchspin', $fieldName);
			echo $this->Html->script('FieldTypes.touchspin');
			echo $this->Html->css('FieldTypes.touchspin');
			$this->Html->scriptStart(['block' => true]);
			echo '$(document).ready(function() { $(".'.$options['class'].'").TouchSpin('.(json_encode($ftOptions, true)).'); });';
			$this->Html->scriptEnd();
			break;

			case 'map':
			$options['type'] = 'text';
			$options['class'] = $this->_generateFieldClass('ft-locationpicker', $fieldName);
			$options['append'] = '<div class="div'.$options['class'].'" style="width: 500px; height: 400px;"></div>';
			echo $this->Html->script('http://maps.google.com/maps/api/js?sensor=false&libraries=places');
			echo $this->Html->script('FieldTypes.locationpicker');
			$this->Html->scriptStart(['block' => true]);
			echo '$(document).ready(function() { $(".div'.$options['class'].'").locationpicker('.(json_encode($ftOptions, true)).'); });';
			$this->Html->scriptEnd();
			break;

		}

		return parent::input($fieldName, $options) ;
	}


}
