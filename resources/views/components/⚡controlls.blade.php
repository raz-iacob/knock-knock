<?php

use Livewire\Component;

new class extends Component
{
    public function up()
    {
        $this->dispatch('playerUp');
    }

    public function down()
    {
        $this->dispatch('playerDown');
    }

    public function left()
    {
        $this->dispatch('playerLeft');
    }

    public function right()
    {
        $this->dispatch('playerRight');
    }
};
?>

<div>
    <div class="flex flex-col justify-center items-center">
        <button class="bg-blue-500 flex items-center justify-center text-white rounded size-16" wire:click="up">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6 rotate-180">
                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 13.5 12 21m0 0-7.5-7.5M12 21V3" />
            </svg>
        </button>
        <div class="flex justify-center items-center my-2 gap-2">
            <button class="bg-blue-500 flex items-center justify-center text-white rounded size-16" wire:click="left">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18" />
                </svg>
            </button>
            <button class="bg-blue-500 flex items-center justify-center text-white rounded size-16" wire:click="right">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6 rotate-180">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18" />
                </svg>
            </button>
        </div>
        <button class="bg-blue-500 flex items-center justify-center text-white rounded size-16" wire:click="down">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 13.5 12 21m0 0-7.5-7.5M12 21V3" />
            </svg>
        </button>
    </div>
</div>