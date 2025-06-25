<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View; // Đảm bảo có dòng này
use Illuminate\View\Component;

class AdminLayout extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View // Sửa lại kiểu trả về ở đây
    {
        return view('layouts.admin');
    }
}