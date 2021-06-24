<div
    class="relative mt-1"
    x-data="Select({
        dataSource: {{ json_encode($options) }},
        selected: @entangle($attributes->wire('model')),
        placeholder: '{{ $placeholder }}',
        valueField: '{{ $valueField }}',
        textField: '{{ $textField }}',
        name: '{{ $name }}',
        id: '{{ $id }}',
        searchPlaceholder: '{{ $searchPlaceholder }}',
        emptyOptionsMessage: '{{ $emptyOptionsMessage }}',
        emptyOptionsMessageAfterSearch: '{{ $emptyOptionsMessageAfterSearch }}',
        multiple: {{ isset($attributes['multiple']) ? 'true' : 'false' }},
        maxSelection: '{{ $maxSelection }}',
        disabled: {{ isset($attributes['disabled']) ? 'true' : 'false' }},
        searchable: {{ $searchable ? 'true' : 'false' }},
    })"
    x-init="init();"
    x-on:click.outside="closeSelect()"
    x-on:keydown.escape="closeSelect()"
    :wire:key="name ?? generateID()"
>
    <div
        x-ref="simpleLivewireSelectButton"
        x-on:click="toggleSelect()"
        x-on:keyup.enter="toggleSelect()"
        tabindex="0"
        x-bind:class="{
            'rounded-md': !open,
            'rounded-t-md': open,
            'bg-gray-200 cursor-default': disabled
        }"
        {{ $attributes->class('block w-full border border-gray-300 rounded-md shadow-sm focus:ring-0 focus:ring-gray-400 focus:border-gray-400 sm:text-sm sm:leading-5')->only('class'); }}
        
    > 
        <div x-cloak x-show="!selected || selected.length === 0" class="flex flex-wrap">
            <div class="text-gray-800 rounded-sm w-full truncate px-2 py-0.5 my-0.5 flex flex-row items-center">
                <div class="w-full px-2 truncate" x-text="placeholder">&nbsp;</div>
                <div x-show="!disabled" x-bind:class="{ 'cursor-pointer': !disabled }" class="h-4" x-on:click.prevent.stop="toggleSelect()">
                    <span x-show="!open">
                        @isset($customToggleDownIcon)
                            {{ $customToggleDownIcon }}
                        @else
                            {{-- Heroicon: outline/chevron-down --}}
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                            </svg>
                        @endisset 
                    </span>
                    <span x-show="open">
                        @isset($customToggleUpIcon)
                            {{ $customToggleUpIcon }}
                        @else
                            {{-- Heroicon: outline/chevron-up --}}
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7" />
                            </svg>
                        @endisset 
                    </span>
                </div>
            </div>
        </div>
        @isset($attributes['multiple'])
            <div x-cloak x-show="selected != null && typeof selected === 'object' && selected.length > 0" class="flex flex-wrap space-x-1">
                <template x-for="(value, index) in selected" :key="index">
                    <div class="text-gray-800 rounded-full truncate bg-gray-300 px-2 py-0.5 my-0.5 flex flex-row items-center">
                        <div class="px-2 truncate" x-text="getTextFromSelectedValue(value)"></div>
                        <div
                            x-show="!disabled"
                            x-bind:class="{ 'cursor-pointer': !disabled }"
                            x-on:click.prevent.stop="deselectOption(index)"
                            x-on:keyup.enter="deselectOption(index)"
                            class="w-4"
                            tabindex="0"
                        >
                            @isset($customDeselectOptionIcon)
                                {{ $customDeselectOptionIcon }}
                            @else
                                {{-- Heroicon solid/x-circle --}}
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class = 'h-4 fill-current'>
                                    <path d="M12 2c5.514 0 10 4.486 10 10s-4.486 10-10 10-10-4.486-10-10 4.486-10 10-10zm0-2c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm6 16.538l-4.592-4.548 4.546-4.587-1.416-1.403-4.545 4.589-4.588-4.543-1.405 1.405 4.593 4.552-4.547 4.592 1.405 1.405 4.555-4.596 4.591 4.55 1.403-1.416z"/>
                                </svg>
                            @endisset 
                        </div>
                    </div>
                </template>
            </div>
        @else            
            <div x-cloak x-show="selected" class="flex flex-wrap"> 
                <div class="text-gray-800 rounded-sm w-full truncate px-2 py-0.5 my-0.5 flex flex-row items-center">
                    <div class="w-full px-2 truncate" x-text="getTextFromSelectedValue(selected)"></div>
                    <div
                        x-show="!disabled"
                        x-bind:class="{ 'cursor-pointer': !disabled }"
                        x-on:click.prevent.stop="deselectOption()"
                        x-on:keyup.enter="deselectOption()"
                        class="h-4"
                        tabindex="0"
                    >
                        @isset($customDeselectOptionIcon)
                            {{ $customDeselectOptionIcon }}
                        @else
                            {{-- Heroicon solid/x-circle --}}
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class = 'h-4 fill-current'>
                                <path d="M12 2c5.514 0 10 4.486 10 10s-4.486 10-10 10-10-4.486-10-10 4.486-10 10-10zm0-2c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm6 16.538l-4.592-4.548 4.546-4.587-1.416-1.403-4.545 4.589-4.588-4.543-1.405 1.405 4.593 4.552-4.547 4.592 1.405 1.405 4.555-4.596 4.591 4.55 1.403-1.416z"/>
                            </svg>
                        @endisset                        
                    </div>
                </div>
            </div>
        @endisset
    </div>
    {{-- style="height: 17.2rem;" --}}
    <div x-ref="simpleLivewireSelectOptionsContainer" x-bind:style="open ? 'height: ' + popperHeight : ''" class="absolute w-full">
        <div x-show="open">
            <input
                type="search"
                x-show="searchable"
                x-ref="simpleLivewireSelectOptionsSearch"
                x-model="search"
                x-on:click.prevent.stop="open=true"
                :placeholder="searchPlaceholder"
                class="block w-full p-2 bg-gray-100 border border-gray-300 shadow-md focus:border-gray-200 focus:ring-0 sm:text-sm sm:leading-5"
            />
            <ul                
                x-ref="simpleLivewireSelectOptionsList"
                class="absolute z-10 w-full py-1 overflow-auto text-base bg-white shadow-lg rounded-b-md max-h-60 ring-1 ring-black ring-opacity-5 focus:outline-none sm:text-sm"
                tabindex="-1"
                role="listbox"
            >
                <div x-cloak x-show="Object.values(options).length == 0 && search.toString().trim() == ''" x-text="emptyOptionsMessage" class="px-2 py-2">&nbsp;</div>
                <div x-cloak x-show="Object.values(options).length == 0 && search.toString().trim() != ''" x-text="emptyOptionsMessageAfterSearch" class="px-2 py-2">&nbsp;</div>
                <template x-for="(option, index) in Object.values(options)" :key="index">
                    <li               
                        :tabindex="index"             
                        class="relative py-2 pl-3 select-none pr-9 "
                        @isset($attributes['multiple'])
                            x-bind:class="{
                                'bg-gray-300 text-black hover:none': selected && selected.includes(getOptionValue(option, index)),
                                'text-gray-900 cursor-defaul hover:bg-gray-200 hover:cursor-pointer focus:bg-gray-200': !(selected && selected.includes(getOptionValue(option, index))),
                            }"
                        @else
                            x-bind:class="{
                                'bg-gray-300 text-black hover:none': selected == getOptionValue(option, index),
                                'text-gray-900 cursor-defaul hover:bg-gray-200 hover:cursor-pointer focus:bg-gray-200': !(selected == getOptionValue(option, index)),
                            }"
                        @endisset
                        x-on:click="selectOption(getOptionValue(option, index))"
                        x-on:keyup.enter="selectOption(getOptionValue(option, index))"
                    >
                        @isset($customOption)
                            {{ $customOption }}
                        @else
                            <span x-text="getOptionText(option, index)"></span>
                        @endisset
                    </li>
                </template>
            </ul>
        </div>
    </div>
</div>

<script>
    function Select(config) {
        return {
            open: false,
            search: '',
            dataSource: config.dataSource,
            options: {},
            valueField: config.valueField,
            textField: config.textField,
            placeholder: config.placeholder,
            selected: config.selected,
            searchable: config.searchable,
            disabled: config.disabled,
            multiple: config.multiple,
            maxSelection: config.maxSelection,
            name: config.name,
            id: config.id,
            searchPlaceholder: config.searchPlaceholder,
            emptyOptionsMessage: config.emptyOptionsMessage,
            emptyOptionsMessageAfterSearch: config.emptyOptionsMessageAfterSearch,
            isLoading: false,
            popperInstance: null,
            popperHeight: '0px', // 17.2rem

            init: function() {
                if(!this.selected || this.selected == null){
                    if (this.multiple) {
                        this.selected = []
                    } else {
                        this.selected = ''
                    }
                }
                this.resetOptions();

                // this.$watch('dataSource', ((dataSource) => {
                //     if(!this.selected || this.selected == null){
                //         if (this.multiple) {
                //             this.selected = []
                //         } else {
                //             this.selected = ''
                //         }
                //     }
                //     setTimeout(() =>  this.resetOptions(dataSource), 1000)
                //     // this.resetOptions(dataSource);
                // }));

                this.$watch('search', ((search) => {
                    this.resetOptions();
                    this.options = Object.values(this.dataSource)
                        .filter((value, index) => this.getOptionText(value, index).toString().toLowerCase().includes(search.toLowerCase().trim()));
                    
                    setTimeout(() => {
                        this.popper();
                        this.scrollToOption();
                    }, 100);
                }));
            },

            generateID: () => {
                return '_' + Math.random().toString(36).substr(2, 9)
            },
            
            resetOptions: function(dataSource = null) {                
                if (!dataSource) {
                    dataSource = this.dataSource;
                }
                this.options = Object.values(dataSource);       
            },

            toggleSelect: function() {
                if (!this.disabled) {
                    if (this.open) {
                        this.closeSelect();
                    } else {
                        this.open = true;
                                                
                        setTimeout(() => {
                            this.popper();
                            this.scrollToOption();      
                            this.checkMaxSelectionReached();  
                        }, 700);          
                    }                      
                }
            },

            closeSelect: function() {
                this.open = false;
                this.search = '';
            },

            selectOption: function(value) {
                if(!this.disabled) {
                    // If multiple push to the array, if not, keep that value and close menu
                    if (this.multiple) {
                        // If it's not already in there
                        if (!this.selected.includes(value)) {
                            if (this.maxSelection == 0 || (this.maxSelection > 0 && this.selected.length < this.maxSelection)) {
                                this.selected.push(value)                                
                            }
                            let reached = this.checkMaxSelectionReached();
                            if (reached) {
                                this.closeSelect();
                            }
                        }
                    } else {
                        this.selected = value;
                        this.closeSelect();
                    }
                }
            },
            
            deselectOption: function(index = null) {
                if (this.multiple) {
                    this.selected.splice(index, 1)
                } else {
                    this.selected = ''
                }
            },

            checkMaxSelectionReached: function() {
                if (this.multiple && this.$refs.simpleLivewireSelectOptionsList) {
                    if (this.maxSelection > 0 && this.selected.length >= this.maxSelection) {
                        this.$refs.simpleLivewireSelectOptionsList.querySelectorAll(':scope > li').forEach((el) => {
                            el.style.pointerEvents = 'none';
                            el.style.opacity = '0.4';
                        });
                        return true;
                    } else {
                        this.$refs.simpleLivewireSelectOptionsList.querySelectorAll(':scope > li').forEach((el) => {
                            el.style.pointerEvents = 'auto';
                            el.style.opacity = '1';
                        });
                    }
                }
                return false;
            },

            getOptionValue: function(option, index) {
                return typeof option === 'object' && this.options[index] ? this.options[index][this.valueField] : option;
            },

            getOptionText: function(option, index) {
                return typeof option === 'object' && this.options[index] ? this.options[index][this.textField] : option;
            },

            getIndexFromSelectedValue: function(value) {    
                let valueField = this.valueField;
                return Object.values(this.dataSource).findIndex(function(x) {
                    if (typeof x === 'object') {
                        return x[valueField] === value;
                    } else {
                        return x === value;
                    }
                });       
            },

            getTextFromSelectedValue: function(value) {
                let index = this.getIndexFromSelectedValue(value);
                let valueField = this.valueField;
                let foundValue = Object.values(this.dataSource).find(function(x) {
                    if (typeof x === 'object') {
                        return x[valueField] === value;
                    } else {
                        return x === value;
                    }
                });
                return typeof foundValue === 'object' && this.dataSource[index] ? this.dataSource[index][this.textField] : foundValue;
            },

            popper: function() {
                // update popper position
                if (this.$refs.simpleLivewireSelectOptionsList && this.$refs.simpleLivewireSelectOptionsList.offsetHeight) {
                    this.popperHeight = (this.$refs.simpleLivewireSelectOptionsList.offsetHeight + 20) + 'px';
                }                
                            
                if (window.createPopper && this.$refs.simpleLivewireSelectButton && this.$refs.simpleLivewireSelectOptionsContainer) {
                    this.popperInstance = createPopper(this.$refs.simpleLivewireSelectButton, this.$refs.simpleLivewireSelectOptionsContainer, {
                        placement: "bottom-start",
                        modifiers: [
                            // {
                            //     name: 'offset',
                            //     options: {
                            //         offset: [0, 8],
                            //     },
                            // },
                            {
                                name: "preventOverflow",
                                options: { 
                                    boundary: "clippingParents" 
                                },
                            },
                            { name: "flip", options: { padding: 50 } },
                        ]
                    });
                }
            },

            scrollToOption: function () {                
                try {
                    if (this.selected && this.$refs.simpleLivewireSelectOptionsList) {
                        let focusIndex = 0;
                        if (this.multiple) {
                            let lastSelected = this.selected.length > 0 ? this.selected[this.selected.length - 1] : '';
                            focusIndex = lastSelected ? this.getIndexFromSelectedValue(lastSelected) : 0;
                        } else {
                            focusIndex = this.getIndexFromSelectedValue(this.selected);
                        }                        
                        // let nonListItem = 3;
                        // let totalListItem = this.$refs.simpleLivewireSelectOptionsList.children.length > nonListItem ? this.$refs.simpleLivewireSelectOptionsList.children.length - nonListItem : 0;
                        let optionsList = this.$refs.simpleLivewireSelectOptionsList.querySelectorAll(':scope > li');
                        let totalOptionsList = optionsList.length;
                        if (totalOptionsList > 0) {
                            let offsetTop = optionsList[focusIndex].offsetTop;
                            this.$refs.simpleLivewireSelectOptionsList.scrollTop = offsetTop || 0;
                            // optionsList[focusIndex].focus();                            
                        } else {
                            this.$refs.simpleLivewireSelectOptionsList.scrollTop = 0;                            
                        }                        
                    } else {
                        this.$refs.simpleLivewireSelectOptionsList.scrollTop = 0;
                    }
                    this.$refs.simpleLivewireSelectOptionsSearch.focus();
                } catch (e) {}                    
                
            }
        }
    }
    window.Select = Select;
</script>