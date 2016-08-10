# Forms [![Build Status](https://travis-ci.org/frozzare/wp-forms.svg?branch=master)](https://travis-ci.org/frozzare/wp-forms)

Create forms in using code in WordPress.

## Installation

```
composer require frozzare/wp-forms
```

## Example

```php
// Register form.
forms()->register( 'contact', [
	'name' => [
		'label' => 'Name',
		'rules' => 'required|max:250'
	],
	'email' => [
		'label' => 'Email',
		'type'  => 'email',
		'rules' => 'required|email'
	],
	'text'  => [
		'label' => 'Text',
		'type'  => 'textarea'
	],
	'color' => [
		'label' => 'Select color',
		'type'  => 'select',
		'items' => [
			[
				'text'  => 'Blue',
				'value' => 'blue',
			],
			[
				'text'  => 'Green',
				'value' => 'green'
			]
		]
	]
] );

// Render form.
forms()->render( 'contact' );

```

## License

MIT © [Fredrik Forsmo](https://github.com/frozzare)
