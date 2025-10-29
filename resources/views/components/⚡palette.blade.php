<?php

use Livewire\Component;

new class extends Component
{
    public array $blocks;

    public function mount($blocks = [])
    {
        $this->blocks = $blocks;
    }
};
?>

<div class="p-6 bg-gray-100 rounded-2xl min-h-[300px] flex flex-col gap-2">
    <h2 class="text-lg font-bold mb-2">Palette</h2>
    @foreach($blocks as $block)
        <livewire:code-block :data="$block" wire:key="palette-block-{{ $block['id'] }}" />
    @endforeach
</div>