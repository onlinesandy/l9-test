<?php

namespace App\View\Components;

use Illuminate\View\Component;

class breadcrumbs extends Component
{


    public $title;
    public $breadcrumb;
    public $help;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($title,$breadcrumb,$help)
    {
        $this->title = $title;
        $this->breadcrumb = $breadcrumb;
        $this->help = $help;

    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.breadcrumbs');
    }
}
