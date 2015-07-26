# FieldTypes plugin for CakePHP

> Note: This is a non-stable plugin for CakePHP 3.x at this time. It is currently under development and should be 
considered experimental.

## Installation

You can install this plugin into your CakePHP application using [composer](http://getcomposer.org).

The recommended way to install composer packages is:

```
composer require leoruhland/cakephp-fieldtypes
```
    
Now load the plugin with the command:

```sh
bin/cake plugin load -r -b FieldTypes
```

## Usage

You can use the FieldTypes extending core FormHelper:

```php
$this->loadHelper('Form', ['className' => 'FieldTypes.FieldTypesForm']);
```
You can use FieldTypes extending FormHelper.
```php
$this->Form->input('some_field', ['type' => 'summernote']);
```
It also works nice with CakeAdmin [formFields](http://cakemanager.org/docs/cakeadmin/1.0/tutorials-and-examples/adding-posttypes/#formfields).

```php
public function postType() {
	return [
		'formFields' => [
			'some_field' => [
				'type' => 'summernote',
			],
		]
	];
};
```

## Types

### [Select2](https://select2.github.io/) - [GitHub](https://github.com/select2/select2)
```php
'type' => 'select2'
```
![select2](http://leoruhland.github.io/cakephp-fieldtypes/images/ex-select2.png)

```php
'type' => 'select2', 'multiple' => true
```
![select2](http://leoruhland.github.io/cakephp-fieldtypes/images/ex-select2-multiple.png)

### [Summernote](http://summernote.org/) - [GitHub](https://github.com/summernote/summernote)

```php
'type' => 'summernote'
```
![summernote](http://leoruhland.github.io/cakephp-fieldtypes/images/ex-summernote.png)

### [Bootstrap Datepicker](http://eternicode.github.io/bootstrap-datepicker/) - [GitHub](https://github.com/eternicode/bootstrap-datepicker)

```php
'type' => 'datepicker'
```
![datepicker](http://leoruhland.github.io/cakephp-fieldtypes/images/ex-datepicker.png)

### [Bootstrap Colorpicker](http://mjolnic.com/bootstrap-colorpicker/) - [GitHub](https://github.com/mjolnic/bootstrap-colorpicker/)

```php
'type' => 'colorpicker'
```
![colorpicker](http://leoruhland.github.io/cakephp-fieldtypes/images/ex-colorpicker.png)

### [Bootstrap TouchSpin](http://www.virtuosoft.eu/code/bootstrap-touchspin/) - [GitHub](https://github.com/istvan-ujjmeszaros/bootstrap-touchspin)

```php
'type' => 'touchspin'
```
![touchspin](http://leoruhland.github.io/cakephp-fieldtypes/images/ex-touchspin.png)

### [Bootstrap Toggle](http://www.bootstraptoggle.com/) - [GitHub](https://github.com/minhur/bootstrap-toggle/)

```php
'type' => 'toggle'
```
![toggle](http://leoruhland.github.io/cakephp-fieldtypes/images/ex-toggle.png)


## CakeAdmin

The plugin is [CakeAdmin](https://github.com/cakemanager/cakephp-cakeadmin) compatible!