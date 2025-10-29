<?php

use Livewire\Component;
use Livewire\Attributes\Layout;

new
#[Layout('layouts.app')] 
class extends Component
{
    public int $cols = 1;
    public int $rows = 1;
}
?>

<div>
    <div class="border-2 border-slate-600">
            @for($i = 0; $i < $rows; $i++)
                <div class="flex" wire:key="row-{{ $i }}">
                    @for($j = 0; $j < $cols; $j++)
                        <livewire:cell coords="{{ $i }},{{ $j }}" wire:key="{{ $i }}-{{ $j }}" />
                    @endfor
                </div>
            @endfor
    </div>
</div>