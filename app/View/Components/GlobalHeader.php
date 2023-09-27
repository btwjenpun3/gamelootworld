<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use Illuminate\Support\Facades\Auth;

class GlobalHeader extends Component
{
    /**
     * Create a new component instance.
     */
    public $name;

    public function __construct()
    {
        $this->name = auth()->user()->name;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.global-header');
    }
}
