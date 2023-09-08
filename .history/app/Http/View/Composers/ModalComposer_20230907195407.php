<?php

namespace App\Http\View\Composers;

use Illuminate\View\View;

class ModalComposer {
    public function __construct() {}

    public function compose(View $view): void
    {
        $productId = $view->getData();
        dd($productId);
        // $view->with('product', []);
    }
}