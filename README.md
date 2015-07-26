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

```php
'type' => 'select2'
```
![select2](http://leoruhland.github.io/cakephp-fieldtypes/images/ex-select2.png)
```php
'type' => 'select2', 'multiple' => true
```
![select2](http://leoruhland.github.io/cakephp-fieldtypes/images/ex-select2-multiple.png)

```php
'type' => 'summernote'
```
![summernote](http://leoruhland.github.io/cakephp-fieldtypes/images/ex-summernote.png)

```php
'type' => 'datepicker'
```
![Touchspin](http://leoruhland.github.io/cakephp-fieldtypes/images/ex-datepicker.png)

```php
'type' => 'colorpicker'
```
![colorpicker](http://leoruhland.github.io/cakephp-fieldtypes/images/ex-colorpicker.png)

```php
'type' => 'touchspin'
```
![touchspin](http://leoruhland.github.io/cakephp-fieldtypes/images/ex-touchspin.png)

```php
'type' => 'toggle'
```
![toggle](http://leoruhland.github.io/cakephp-fieldtypes/images/ex-toggle.png)

## CakeAdmin

The plugin is [CakeAdmin](https://github.com/cakemanager/cakephp-cakeadmin) compatible!