<span x-show="!open">
  @isset($customCaretDownIcon)
      {{ $customCaretDownIcon }}
  @else
      {{-- Heroicon: outline/chevron-down --}}
      <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
      </svg>
  @endisset 
</span>
<span x-show="open">
  @isset($customCaretUpIcon)
      {{ $customCaretUpIcon }}
  @else
      {{-- Heroicon: outline/chevron-up --}}
      <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7" />
      </svg>
  @endisset 
</span>