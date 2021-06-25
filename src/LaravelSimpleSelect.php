<?php

namespace Victorybiz\LaravelSimpleSelect;

use Illuminate\View\Component;

class LaravelSimpleSelect extends Component
{
    public $id;
    public $name;
    public $options;
    public $valueField;
    public $textField;
    public $placeholder;
    public $searchInputPlaceholder;
    public $noOptions;
    public $noResult;
    public $disabled;
    public $required;
    public $multiple;
    public $maxSelection;
    public $searchable;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(
        $options,
        $id, 
        $name,
        $valueField = 'value', 
        $textField = 'text' , 
        $placeholder = 'Select Option',
        $searchInputPlaceholder = 'Search...',
        $noOptions = 'No option data.',
        $noResult = 'No results match your search.',
        $maxSelection = 0,
        $searchable = true
    )
    {
        $this->options = $options;
        $this->id = $id;
        $this->name = $name;
        $this->valueField = $valueField;
        $this->textField = $textField;
        $this->placeholder = $placeholder;
        $this->searchInputPlaceholder = $searchInputPlaceholder;
        $this->noOptions = $noOptions;
        $this->noResult = $noResult;
        $this->maxSelection = $maxSelection;
        $this->searchable = $searchable;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.laravel-simple-select');
    }
}