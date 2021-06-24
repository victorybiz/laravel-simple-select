<?php

namespace Victorybiz\SimpleLivewireSelect;

use Illuminate\View\Component;

class SimpleLivewireSelect extends Component
{
    public $id;
    public $name;
    public $options;
    public $valueField;
    public $textField;
    public $placeholder;
    public $searchPlaceholder;
    public $emptyOptionsMessage;
    public $emptyOptionsMessageAfterSearch;
    public $disabled;
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
        $name = '',
        $id = '', 
        $valueField = 'value', 
        $textField = 'text' , 
        $placeholder = 'Select Option',
        $searchPlaceholder = 'Search...',
        $emptyOptionsMessage = 'No data.',
        $emptyOptionsMessageAfterSearch = 'No results match your search.',
        $maxSelection = 0,
        $searchable = true,
    )
    {
        $this->options = $options;
        $this->name = $name;
        $this->id = $id;
        $this->valueField = $valueField;
        $this->textField = $textField;
        $this->placeholder = $placeholder;
        $this->searchPlaceholder = $searchPlaceholder;
        $this->emptyOptionsMessage = $emptyOptionsMessage;
        $this->emptyOptionsMessageAfterSearch = $emptyOptionsMessageAfterSearch;
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
        return view('components.select');
    }
}