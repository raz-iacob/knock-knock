<?php

use Livewire\Component;
use Livewire\Attributes\Modelable;
use Livewire\Attributes\Renderless;

new class extends Component {
    public $palette = [];

    #[Modelable]
    public array $instructions = [];

    public function mount()
    {
        $this->palette = [
            ['id' => 1, 'method' => 'move', 'label' => 'Move Forward'],
            ['id' => 2, 'method' => 'rotateRight', 'label' => 'Turn Right'],
            ['id' => 3, 'method' => 'rotateLeft', 'label' => 'Turn Left'],
        ];
    }

    #[Renderless]
    public function saveOrder($orderedIds)
    {
        // save order
    }

    public function add($instruction)
    {
        $instruction['id'] = now()->timestamp . rand(1000, 9999);
        $this->instructions[] = $instruction;
    }
};
?>

<div class="flex flex-col md:flex-row gap-8 w-full max-w-5xl">
    <div class="p-6 bg-gray-100 rounded-2xl min-h-[300px] flex flex-col gap-2">
        <h2 class="text-lg font-bold mb-2">Palette</h2>
        @foreach($palette as $block)
            <livewire:code-block :data="$block" wire:key="palette-block-{{ $block['id'] }}" />
        @endforeach
    </div>
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
            wire:sort="saveOrder"

        >
            @foreach ($instructions as $instruction)
                <livewire:code-block :data="$instruction" wire:key="instruction-{{ $instruction['id'] }}" wire:sort:item="{{ $instruction['id'] }}"/>
            @endforeach
        </div>
    </div>
</div>
