# Laravel Simple Select

Laravel Simple Select inputs component for Blade and Livewire.

[![Latest Version on Packagist](https://img.shields.io/packagist/v/victorybiz/laravel-simple-select.svg?style=flat-square)](https://packagist.org/packages/victorybiz/laravel-simple-select)
[![Total Downloads](https://img.shields.io/packagist/dt/victorybiz/laravel-simple-select.svg?style=flat-square)](https://packagist.org/packages/victorybiz/laravel-simple-select)
![GitHub Actions](https://github.com/victorybiz/laravel-simple-select/actions/workflows/main.yml/badge.svg)


## Table of Contents
- [Laravel Simple Select](#laravel-simple-select)
  - [Table of Contents](#table-of-contents)
  - [Installation](#installation)
  - [Requirements](#requirements)
    - [JavaScript Dependencies](#javascript-dependencies)
  - [Usage](#usage)
      - [Simple Select](#simple-select)
      - [Custom Option Slot](#custom-option-slot)
      - [Custom Icon Slots](#custom-icon-slots)
    - [Dependent Selects](#dependent-selects)
    - [Event Listener](#event-listener)
  - [Positioning](#positioning)
  - [Props / Attributes](#props--attributes)
  - [Slots / Custom Display](#slots--custom-display)
  - [Events](#events)
  - [Testing](#testing)
  - [Changelog](#changelog)
  - [Contributing](#contributing)
    - [Security](#security)
  - [Credits](#credits)
  - [License](#license)
  - [Laravel Package Boilerplate](#laravel-package-boilerplate)


<br>

<a name="installation"></a>

## Installation

You can install the package via composer:

```bash
composer require victorybiz/laravel-simple-select
```

**OPTIONAL**: To customize the component, you should publish the configuration file using the vendor:publish Artisan command. The configuration file will be placed in your application's config directory and view file in views directory respectively:

```bash
# Publish the config file
php artisan vendor:publish --tag=simple-select-config

# Publish the view file
php artisan vendor:publish --tag=simple-select-views
```

<a name="requirements"></a>

## Requirements
This package use the following packages.
* Laravel Livewire (https://laravel-livewire.com/) is required when using Livewire `wire:model`
* TailwindCSS (https://tailwindcss.com/) 
* Heroicon (https://heroicons.com/) 
* Alpine.js v3 (https://alpinejs.dev/) 
* Popper.js (https://popper.js.org/)

Please make sure you include these dependencies before using this component. 

<a name="javaScript-dependencies"></a>

### JavaScript Dependencies
For any external JavaScript dependency, we recommend you install them through npm or yarn, and then require them in your project's JavaScript. To install each of the dependencies this package makes use of, run this command in the terminal:
```bash
npm install -D alpinejs @popperjs/core
```
```javascript
import Alpine from 'alpinejs'
import { createPopper } from "@popperjs/core";

window.Alpine = Alpine;
Alpine.start()

window.createPopper = createPopper;
```
If you’re not using a compiled JavaScript, don’t forget to include CDN versions of the JavaScript Dependencies before it.

<a name="usage"></a>

## Usage

#### Simple Select
```php
@php
// Basic Arrays
$options = ['Nigeria', 'United Kingdom', 'United States'];
// Above will output Option Value e.g Nigeria 
// Above will output Option Text e.g Nigeria

// OR

// Associative Arrays
$options = [
  ['value' => 'NG', 'text' => 'Nigeria'],
  ['value' => 'GB', 'text' => 'United Kingdom'],
  ['value' => 'US', 'text' => 'United States']
];
// Above will output Option Value e.g NG 
// Above will output Option Text e.g Nigeria

// OR

// Using Associative Arrays data from a Model/Database,
// ensure to customize the field names with value-field="code" and text-field="name" properties of the component.
$options = [
  ['code' => 'NG', 'name' => 'Nigeria'],
  ['code' => 'GB', 'name' => 'United Kingdom'],
  ['code' => 'US', 'name' => 'United States']
];
// OR
$options = [
  ['code' => 'NG', 'name' => 'Nigeria', 'flag' => 'https://www.countryflags.io/ng/shiny/32.png'],
  ['code' => 'GB', 'name' => 'United Kingdom', 'flag' => 'https://www.countryflags.io/gb/shiny/32.png'],
  ['code' => 'US', 'name' => 'United States', 'flag' => 'https://www.countryflags.io/us/shiny/32.png']
];
// Above will output Option Value e.g NG 
// Above will output Option Text e.g Nigeria

@endphp
```
```html
<x-simple-select       
    name="country"
    id="country"
    :options="$options"
    value-field='code'
    text-field='name'
    placeholder="Select Country"
    search-input-placeholder="Search Country"
    :searchable="true"                                               
    class="form-select"     
/>
```

<a name="custom-option-slot"></a>

#### Custom Option Slot
```html
<x-simple-select       
    name="country"
    id="country"
    :options="$options"
    value-field='code'
    text-field='name'
    placeholder="Select Country"
    search-input-placeholder="Search Country"
    :searchable="true"                                               
    class="form-select"     
>
  <x-slot name="customOption">
    <img class="float-left mr-2 -mt-1" :src="option.flag">
    <span x-text="option.name"></span>
  </x-slot>
</x-simple-select>

<x-simple-select       
    name="country"
    id="country"
    :options="$options"
    value-field='code'
    text-field='name'
    placeholder="Select Country"
    search-input-placeholder="Search Country"
    :searchable="true"                                               
    class="form-select"     
>
  <x-slot name="customOption">
    <img class="float-left mr-2 -mt-1" :src="`https://www.countryflags.io/${option.code?.toLowerCase()}/shiny/32.png`">
    <span x-text="option.name"></span>
  </x-slot>
</x-simple-select>
```

<a name="custom-icon-slot"></a>

#### Custom Icon Slots
```html
<x-simple-select       
    name="country"
    id="country"
    :options="$options"
    value-field='code'
    text-field='name'
    placeholder="Select Country"
    search-input-placeholder="Search Country"
    :searchable="true"                                               
    class="form-select"     
>
  <x-slot name="customOption">
    <img class="float-left mr-2 -mt-1" :src="option.flag">
    <span x-text="option.name"></span>
  </x-slot>
  <x-slot name="customDeselectOptionIcon">
    <!-- Heroicon solid/x-circle -->
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class = 'h-4 fill-current'>
      <path d="M12 2c5.514 0 10 4.486 10 10s-4.486 10-10 10-10-4.486-10-10 4.486-10 10-10zm0-2c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm6 16.538l-4.592-4.548 4.546-4.587-1.416-1.403-4.545 4.589-4.588-4.543-1.405 1.405 4.593 4.552-4.547 4.592 1.405 1.405 4.555-4.596 4.591 4.55 1.403-1.416z"/>
    </svg>
  </x-slot>
</x-simple-select>
```

<a name="dependent-selects"></a>

### Dependent Selects
If you have a custom select whose options depend on the selection of another select, or just some kind of condition to be met, you can listen to the updated event of the livewire model of the main select to update the options in the dependent select.
```php
// Expected data in Database
// Model Country::class 
$countries = [
  ['code' => 'NG', 'name' => 'Nigeria'],
  ['code' => 'GB', 'name' => 'United Kingdom'],
  ['code' => 'US', 'name' => 'United States']
];
// Model State::class
$states = [
  ['id' => 1, 'country_code' => 'NG', 'name' => 'Abuja'],
  ['id' => 2, 'country_code' => 'NG', 'name' => 'Edo'],
  ['id' => 3, 'country_code' => 'NG', 'name' => 'Lagos'],
  ['id' => 4, 'country_code' => 'US', 'name' => 'Alaska'],
  ['id' => 5, 'country_code' => 'US', 'name' => 'Califonia'],
  ['id' => 6, 'country_code' => 'US', 'name' => 'Florida'],
  ['id' => 7, 'country_code' => 'GB', 'name' => 'Belfast'],
  ['id' => 8, 'country_code' => 'GB', 'name' => 'London'],
  // ...
];
```

Create a livewire component as the form page
```php
<?php

namespace App\Http\Livewire;

use Livewire\Component;

class CreateUser extends Component
{
    public $countries = [];
    public $states = [];

    public $name;
    public $country;
    public $state;

    protected function rules()
    {
        // 
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function store()
    {
        $this->validate();
        // Store the data
    }

    public function mount()
    {
        $this->countries = \App\Models\Country::orderBy('name')->get()->toArray();             
    }

    public function updatedCountry($countryCode)
    {   
        if ($countryCode) {
            $this->states = \App\Models\State::where('country_code', $countryCode)->orderBy('name')->get()->toArray();  
        } else {
            $this->states = [];            
        }   
        $this->state = null;
    }

    public function render()
    {
        return view('livewire.create-user');
    }
}

```
In your component view
```html
 <form wire:submit.prevent="store">

  <label for="name">Name</label>
  <div class="mt-1">
    <input       
        wire:model="name"
        name="name"
        id="name"
        placeholder="Enter name"                                            
        class="form-input"     
    />
  </div>

  <label for="country">Country</label>
  <div class="mt-1">
    <x-simple-select       
        wire:model="country"
        name="country"
        id="country"
        :options="$options"
        value-field='code'
        text-field='name'
        placeholder="Select Country"
        search-input-placeholder="Search Country"
        :searchable="true"                                               
        class="form-select"     
    />
  </div>

  <label for="state">State</label>
  <div class="mt-1">
    <x-simple-select       
        wire:model="state"
        name="state"
        id="state"
        :options="$states"
        value-field='id'
        text-field='name'
        placeholder="Select State"
        search-input-placeholder="Search State"
        :searchable="true"                       
        class="form-select"
    />
  </div>
</form>
```
<a name="event-listener"></a>

### Event Listener
```javascript
window.addEventListener('select', function(option) {
    console.log(option.detail.value); // Select option value(s)
    console.log(option.detail.name); // The select element name
    console.log(option.detail.id); // The select element ID
});
```

<a name="positioning"></a>

## Positioning

The simple-select component makes use of `Popper.js` for positioning the select menu. This should remove the need for fixed positioning the select menu now. In addition to positioning the menu when opened, Popper.js will also re-position the menu as needed when the page is scrolled.

<a name="props"></a>

## Props / Attributes

| Name | Type | Default | Required | Description |
| --- | --- | --- | --- | --- | --- |
| **id** | `Integer||String` | | Yes | Used to identify the component in events. |
| **name** | `Integer||String` | | Yes | Specifies a name for component. |
| **options** | `Array` | | Yes | Array of available options: Objects, Strings or Integers. If array of objects, visible text/label will default to `option.text` and value default to `option.value`. |
| **value-field** | `String` | `'value'` | No | Array key for option value if `options` is an associative array. |
| **text-field** | `String` | `'text'` | No | Array key for option text if `options` is an associative array. |
| **value** | `Array||String||Integer	` | `null` | No | Presets the selected options. |
| **placeholder** | `String` | `'Select Option'` | No | Equivalent to the `placeholder` attribute on a `<select>` input. | 
| **searchable** | `Boolean` | `true` | No | Show / hide options search input. | 
| **search-input-placeholder** | `String` | `'Search...'` | No | Equivalent to the `placeholder` attribute on a `<input>`. | 
| **class** | `String` |  | No | Equivalent to the `class` attribute on a `<select>` input. | 
| **multiple** | `Boolean` | `false` | No | Equivalent to the `multiple` attribute on a `<select>` input. This also enable multiple options tagging if set | 
| **max-selection** | `Integer` | | No | Limit number of allowed selected options. | 
| **required** | `Boolean` | `false` | No | Equivalent to the `required` attribute on a `<select>` input. | 
| **disabled** | `Boolean` | `false` | No | Equivalent to the `disabled` attribute on a `<select>` input. | 
| **no-options** | `String` | `'No option data.'` | No | Message to show when options list is empty.|
| **no-result** | `String` | `'No results match your search.'` | No | Message to show when no option.|
| **on-select** | `String` | `'select'` | No | Customize event name of an event emitted after selecting an option. |

<a name="slots"></a>

## Slots / Custom Display

| Name | Description |
| --- | --- |
| **customOption** | Slot for custom option text template. See [example](custom-option-slot) above. |
| **customDeselectOptionIcon**| Slot for custom deselect option icon markup. See [example](custom-icon-slot) above. |
| **customCaretDownIcon**| Slot for custom caret down icon markup. See [example](custom-icon-slot) above. |
| **customCaretUpIcon**| Slot for custom caret up icon markup. See [example](custom-icon-slot) above. |

<a name="events"></a>

## Events

| Name | Listen to |  Description |
| --- | --- |  --- |
| **Select** | `select` | Emitted after selecting an option. See [example](event-listener) above. |


## Testing

```bash
composer test
```

## Changelog

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
