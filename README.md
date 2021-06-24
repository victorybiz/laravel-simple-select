# Simple Livewire Select

Simple Blade/Livewire Select inputs component.

[![Latest Version on Packagist](https://img.shields.io/packagist/v/victorybiz/simple-livewire-select.svg?style=flat-square)](https://packagist.org/packages/victorybiz/simple-livewire-select)
[![Total Downloads](https://img.shields.io/packagist/dt/victorybiz/simple-livewire-select.svg?style=flat-square)](https://packagist.org/packages/victorybiz/simple-livewire-select)
![GitHub Actions](https://github.com/victorybiz/simple-livewire-select/actions/workflows/main.yml/badge.svg)


## Installation

You can install the package via composer:

```bash
composer require victorybiz/simple-livewire-select
```

Next, you should publish the configuration file using the vendor:publish Artisan command. The configuration file will be placed in your application's config directory:

```bash
php artisan vendor:publish --provider="Victorybiz\SimpleLivewireSelect\SimpleLivewireSelectServiceProvider"
```

## Requirements
This package use the following packages.
* Laravel Livewire (https://laravel-livewire.com/)
* TailwindCSS (https://tailwindcss.com/) 
* Alpine.js v3 (https://alpinejs.dev/) 

Please make sure you include these dependencies before using this component. 

## Usage

```html
<x-simple-select       
    wire:model="country"
    name="country"
    id="country"
    :options="$countries"
    value-field='code'
    text-field='name'
    placeholder="Select Country"
    search-placeholder="Search Country"
    :searchable="true"                                                       
    class="form-select"     
/>
```

### Testing

```bash
composer test
```

### Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

### Security

If you discover any security related issues, please email lavictorybiz@gmail.com instead of using the issue tracker.

## Credits

-   [Victory Osayi Airuoyuwa](https://github.com/victorybiz)
-   [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

## Laravel Package Boilerplate

This package was generated using the [Laravel Package Boilerplate](https://laravelpackageboilerplate.com).
