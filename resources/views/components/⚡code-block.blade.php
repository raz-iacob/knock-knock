<?php

use Livewire\Component;

new class extends Component
{
    public array $data;

    public function mount($data)
    {
        $this->data = $data;
    }
};
?>

@php
    $instructionClasses = [
        'moveForward' => 'bg-blue-400',
        'looks' => 'bg-purple-500',
        'sound' => 'bg-pink-400',
        'event' => 'bg-yellow-300 text-gray-900',
        'rotateRight' => 'bg-orange-400',
        'rotateLeft' => 'bg-orange-400',
        'sensing' => 'bg-cyan-400',
        'operator' => 'bg-green-500',
        'variable' => 'bg-orange-600',
        'default' => 'bg-gray-300',
    ];
    $blockClass = $instructionClasses[$this->data['method']] ?? $instructionClasses['default'];
    $textClass = str_contains($blockClass, 'text-gray-900') ? 'text-gray-900' : 'text-white';
@endphp

<div
    x-data
    class="inline-block min-w-[180px] rounded-xl px-5 py-3 font-semibold shadow-md text-base font-sans {{ $blockClass }} {{ $textClass }} select-none"
    draggable="true"
    @dragstart="event.dataTransfer.setData('block', JSON.stringify(@js($data)))"
    wire:sort:item="{{ $data['id'] }}"
>
    <span>
        {{ $data['label'] }}
    </span>
</div>
