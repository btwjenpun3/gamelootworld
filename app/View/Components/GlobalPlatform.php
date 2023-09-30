<?php

namespace App\View\Components;

use Closure;
use App\Models\Platform;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class GlobalPlatform extends Component
{
    /**
     * Create a new component instance.
     */
    public $platforms;

    public function __construct()
    {
        $this->platforms = Platform::get();
        // $this->platforms = $data;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.global-platform');
    }
}
