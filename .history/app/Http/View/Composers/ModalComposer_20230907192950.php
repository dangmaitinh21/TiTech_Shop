<?php

namespace App\Http\View\Composers;

use Illuminate\View\View;

class ModalComposer {
    public function __construct() {}

    public function compose(View $view): void
    {
        $view->with('product', []);
    }
}