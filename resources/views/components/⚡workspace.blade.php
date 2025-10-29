<?php

use Livewire\Component;

new class extends Component
{
    public $palette = [];
    public $canvas = [];

    public function mount()
    {
        $this->palette = [
            ['id' => 1, 'type' => 'motion', 'label' => 'move forward'],
            ['id' => 2, 'type' => 'motion', 'label' => 'turn right'],
            ['id' => 3, 'type' => 'control', 'label' => 'repeat'],
        ];
        $this->canvas = [
            ['id' => 4, 'type' => 'event', 'label' => 'on run'],
        ];
    }
};
?>

<div class="flex flex-col md:flex-row gap-8 w-full max-w-5xl">
    <livewire:palette :blocks="$palette" />
    <livewire:canvas :blocks="$canvas" />
</div>
