<?php

use Livewire\Component;

new class extends Component {
    public array $blocks;

    public function mount($blocks = [])
    {
        $this->blocks = $blocks;
    }

    public function add($block)
    {
        $block['id'] = now()->timestamp . rand(1000, 9999);
        $this->blocks[] = $block;
    }
};
?>

<div class="w-full md:w-2/3">
    <h2 class="text-lg font-bold mb-2">Instruction Set</h2>
    <div
        x-data
        class="p-6 bg-white border-2 border-dashed border-gray-300 rounded-2xl min-h-[300px] flex flex-col gap-2"
        @dragover.prevent
        x-on:drop="
            const block = JSON.parse(event.dataTransfer.getData('block'));
            $wire.add(block);
        "
    >
        @foreach ($blocks as $block)
            <livewire:code-block :data="$block" wire:key="instruction-{{ $block['id'] }}"/>
        @endforeach
    </div>
</div>
