<?php

namespace Tests\Browser\Lazy;

use Livewire\Component as BaseComponent;

class LazyInputsWithUpdatesDisplayedComponent extends BaseComponent
{
    public $name;
    public $description;

    public $updates = [];

    public function submit()
    {
        $this->updates = request('updates');
    }

    public function render()
    {
        return
<<<'html'
<div>
    <input dusk="name" wire:model.lazy="name">
    <input dusk="description" wire:model.lazy="description">

    <div dusk="totalNumberUpdates">{{ count($updates) }}</div>

    <div dusk="updatesList">
        @foreach($updates as $update)
            <div>
                @if($update['type'] == 'syncInput')
                    {{ $update['type'] . ' - ' . $update['payload']['name'] }}
                @elseif($update['type'] == 'callMethod')
                    {{ $update['type'] . ' - ' . $update['payload']['method'] }}
                @endif
            </div>
        @endforeach
    </div>

    <button dusk="submit" type="button" wire:click="submit">Submit</button>
</div>
html;
    }
}
