<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class HeroSection extends Component
{
    public $title;
    public $subtitle;
    public $breadcrumbs;

    public function __construct($title, $subtitle = null, $breadcrumbs = [])
    {
        $this->title = $title;
        $this->subtitle = $subtitle;
        $this->breadcrumbs = $breadcrumbs;
    }

    public function render()
    {
        return view('components.hero-section');
    }
}
