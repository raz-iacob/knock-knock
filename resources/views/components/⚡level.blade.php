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

    #[On('playerUp')] 
    public function up()
    {
        if($this->player['x'] <= 0) {
            return;
        }
        
        $this->player['x']--;

        $this->checkTargetReached();
    }

    #[On('playerDown')]
    public function down()
    {
        if($this->player['x'] >= $this->board[1] - 1) {
            return;
        }

        $this->player['x']++;

        $this->checkTargetReached();
    }

    #[On('playerLeft')]
    public function left()
    {
        if($this->player['y'] <= 0) {
            return;
        }

        $this->player['y']--;

        $this->checkTargetReached();
    }

    #[On('playerRight')]
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

@assets
<script>
    document.addEventListener('livewire:init', () => {
        window.addEventListener('keydown', (event) => {
            event.preventDefault();
            switch(event.key) {
                case 'ArrowUp':
                    Livewire.dispatch('playerUp')
                    break;
                case 'ArrowDown':
                    Livewire.dispatch('playerDown')
                    break;
                case 'ArrowLeft':
                    Livewire.dispatch('playerLeft')
                    break;
                case 'ArrowRight':
                    Livewire.dispatch('playerRight')
                    break;
            }
        });
    });
</script>
@endassets