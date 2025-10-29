<?php

use Livewire\Component;
use App\Enums\Diraction;
use Livewire\Attributes\Reactive;

new class extends Component
{
    #[Reactive]
    public string $facing = 'down';
};
?>

<div>
    <img class="size-20 {{ match($facing) {
            'up' => 'rotate-180',
            'right' => 'rotate-270',
            'down' => 'rotate-0',
            'left' => 'rotate-90',
        } }}" src="https://media0.giphy.com/media/v1.Y2lkPTZjMDliOTUyYnN6cDZoaWUxbzFzcHU1dDZ5Ym1uNWQ1bnh0YnhqNDFyemIwcGo1ZiZlcD12MV9zdGlja2Vyc19zZWFyY2gmY3Q9cw/BHCFcibksBxAV0FDoL/giphy.gif" alt="Player Avatar" />
</div>