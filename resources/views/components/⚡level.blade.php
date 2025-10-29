<?php

use Livewire\Component;
use Livewire\Attributes\On;

new class extends Component
{
    public int $id = 0;
    public string $name = 'Level 1';

    public array $board = [8, 8];

    public array $player = ['x' => 2, 'y' => 2];

    #[On('playerUp')] 
    public function up()
    {
        if($this->player['x'] <= 0) {
            return;
        }
        
        $this->player['x']--;
    }

    #[On('playerDown')]
    public function down()
    {
        if($this->player['x'] >= $this->board[1] - 1) {
            return;
        }

        $this->player['x']++;
    }

    #[On('playerLeft')]
    public function left()
    {
        if($this->player['y'] <= 0) {
            return;
        }

        $this->player['y']--;
    }

    #[On('playerRight')]
    public function right()
    {
        if($this->player['y'] >= $this->board[0] - 1) {
            return;
        }

        $this->player['y']++;
    }
};
?>

<div>
    <div class="flex inset-0 justify-center items-center flex-col p-6 gap-6">
        <h2 class="mb-3 font-semibold text-3xl">{{ $name }}</h2>
        <div class="flex items-center justify-center gap-25">
            <div class="relative" style="background-image: url('https://i.imgur.com/Xf3Idv5.jpg');">
                <livewire:map :cols="$board[0]" :rows="$board[1]" />

                <div class="absolute top-0 left-0 transform z-10 transition-all p-1"
                    style="transform: translate({{ $player['y'] * 80 }}px, {{ $player['x'] * 80 }}px);">
                    <livewire:player :size="80" />
                </div>
            </div>
            <livewire:controlls />
        </div>
    </div>
</div>