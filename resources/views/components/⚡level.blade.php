<?php

use Livewire\Component;
use Livewire\Attributes\On;

new class extends Component
{
    public int $id = 0;
    public string $name = 'Level 1';

    public array $board = [8, 8];

    public array $player = ['x' => 2, 'y' => 2];
    public array $target = ['x' => 5, 'y' => 5];

    public bool $success = false;

    public function up()
    {
        if($this->player['x'] <= 0) {
            return;
        }
        
        $this->player['x']--;

        $this->checkTargetReached();
    }

    public function down()
    {
        if($this->player['x'] >= $this->board[1] - 1) {
            return;
        }

        $this->player['x']++;

        $this->checkTargetReached();
    }

    public function left()
    {
        if($this->player['y'] <= 0) {
            return;
        }

        $this->player['y']--;

        $this->checkTargetReached();
    }

    public function right()
    {
        if($this->player['y'] >= $this->board[0] - 1) {
            return;
        }

        $this->player['y']++;

        $this->checkTargetReached();
    }

    public function checkTargetReached()
    {
        if($this->player['x'] === $this->target['x'] && $this->player['y'] === $this->target['y']) {
            $this->success = true;
        }
    }

    public function restart()
    {
        $this->player = ['x' => 2, 'y' => 2];
        $this->success = false;
    }
};
?>

<div>
    <div class="flex inset-0 justify-center items-center flex-col p-6 gap-6">
        <h2 class="mb-3 font-semibold text-3xl">{{ $name }}</h2>
        <div class="flex items-center justify-center gap-25">
            <div class="relative" style="background-image: url('https://i.imgur.com/Xf3Idv5.jpg');">
                <livewire:map :cols="$board[0]" :rows="$board[1]" />

                <div class="absolute top-0 left-0 transform z-20 transition-all p-1"
                    style="transform: translate({{ $player['y'] * 80 }}px, {{ $player['x'] * 80 }}px);">
                    <livewire:player />
                </div>

                <div class="absolute top-0 left-0 transform z-10 transition-all p-1"
                    style="transform: translate({{ $target['y'] * 80 }}px, {{ $target['x'] * 80 }}px);">
                    <livewire:target />
                </div>
            </div>
        </div>
    </div>

    <div class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center {{ $success ? 'block' : 'hidden' }}">
        <div class="bg-white p-6 rounded-lg shadow-lg text-center">
            <h2 class="text-2xl font-semibold mb-4">Congratulations!</h2>
            <p class="mb-4">You've found the treasure!</p>
            <button wire:click="$set('success', false)" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Close</button>
        </div>
    </div>
</div>

<script>
    window.addEventListener('keydown', (event) => {
        switch(event.key) {
            case 'ArrowUp':
                event.preventDefault();
                this.$call('up')
                break;
            case 'ArrowDown':
                event.preventDefault();
                this.$call('down')
                break;
            case 'ArrowLeft':
                event.preventDefault();
                this.$call('left')
                break;
            case 'ArrowRight':
                event.preventDefault();
                this.$call('right')
                break;
            case 'Escape':
                event.preventDefault();
                this.$call('restart')
                break;
        }
    });
</script>