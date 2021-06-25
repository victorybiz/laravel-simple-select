<?php

namespace Victorybiz\SimpleSelect;

use Illuminate\View\Component;

class SimpleSelect extends Component
{
    public $id;
    public $name;
    public $options;
    public $valueField;
    public $textField;
    public $value;
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
        Array $options,
        String $id, 
        String $name,
        $valueField = 'value', 
        $textField = 'text' , 
        $value = null , 
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
        $this->value = $value;
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
        return view('simple-select::components.simple-select');
    }
}