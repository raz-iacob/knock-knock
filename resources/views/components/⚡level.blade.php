<?php

use Livewire\Component;
use Livewire\Attributes\On;

new class extends Component
{
    public int $id = 0;
    public string $name = 'Level 1';

    public array $board = [8, 8];

    public string $direction = 'down';

    public array $position = ['x' => 2, 'y' => 2];
    public array $target = ['x' => 5, 'y' => 5];

    public bool $success = false;

    public array $instructions = [];

    public function run()
    {
        $this->restart();
        foreach($this->instructions as $instruction) {
            $method = $instruction['method'];
            if(method_exists($this, $method)) {
                $this->$method();
                $this->stream(  
                    to: 'player',
                    content: $this->position,
                    replace: true,
                );
                sleep(1);
            }
        }
    }

    public function up()
    {
        if($this->position['x'] <= 0) {
            return;
        }

        $this->position['x']--;

        $this->checkTargetReached();
    }

    public function down()
    {
        if($this->position['x'] >= $this->board[1] - 1) {
            return;
        }

        $this->position['x']++;

        $this->checkTargetReached();
    }

    public function left()
    {
        if($this->position['y'] <= 0) {
            return;
        }

        $this->position['y']--;

        $this->checkTargetReached();
    }

    public function right()
    {
        if($this->position['y'] >= $this->board[0] - 1) {
            return;
        }

        $this->position['y']++;

        $this->checkTargetReached();
    }

    public function move()
    {
        switch($this->direction) {
            case 'up':
                $this->up();
                break;
            case 'down':
                $this->down();
                break;
            case 'left':
                $this->left();
                break;
            case 'right':
                $this->right();
                break;
        }
    }

    public function rotateRight()
    {
        $this->direction = match($this->direction) {
            'up' => 'right',
            'right' => 'down',
            'down' => 'left',
            'left' => 'up',
        };
    }

    public function rotateLeft()
    {
        $this->direction = match($this->direction) {
            'up' => 'left',
            'left' => 'down',
            'down' => 'right',
            'right' => 'up',
        };
    }

    public function checkTargetReached()
    {
        if($this->position['x'] === $this->target['x'] && $this->position['y'] === $this->target['y']) {
            $this->success = true;
        }
    }

    public function restart()
    {
        $this->position = ['x' => 2, 'y' => 2];
        $this->direction = 'down';
        $this->success = false;
    }
};
?>

<div>
    <div class="flex inset-0 justify-center items-center flex-col p-6 gap-6">
        <h2 class="mb-3 font-semibold text-3xl">{{ $name }}</h2>
        <div class="flex items-center justify-center gap-25">
            <div>
                <div class="mb-4 p-4">
                    <p>Build the instruction set to get the player to the treasure.</p>
                    <p>Press RUN when you're ready.</p>
                </div>
                <livewire:workspace wire:model.live="instructions" />
                <button class="bg-blue-500 flex items-center justify-center text-white rounded-md w-full text-center h-10 mt-4" wire:click="run">Run</button>
            </div>
            <div class="relative" style="background-image: url('https://i.imgur.com/Xf3Idv5.jpg');" wire:stream="player">
                <livewire:map :cols="$board[0]" :rows="$board[1]" />

                <div class="absolute top-0 left-0 transform z-20 transition-all p-1"
                    style="transform: translate({{ $position['y'] * 80 }}px, {{ $position['x'] * 80 }}px);">
                    <livewire:player :facing="$direction" />
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
            case 'Enter':
                event.preventDefault();
                this.$call('move')
                break;
            case 'Escape':
                event.preventDefault();
                this.$call('restart')
                break;
        }
    });
</script>
