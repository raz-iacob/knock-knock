<?php

use Livewire\Component;

new class extends Component {
    public $palette = [];

    public array $instructions = [];

    public function mount()
    {
        $this->palette = [
            ['id' => 1, 'method' => 'move', 'label' => 'Move forward'],
            ['id' => 2, 'method' => 'rotate', 'label' => 'Rotate'],
        ];
    }
};
?>

<div class="flex flex-col md:flex-row gap-8 w-full max-w-5xl">
    <livewire:palette :blocks="$palette"/>
    <livewire:instruction-set :blocks="$instructions"/>
</div>
