<?php

namespace App\Http\View\Composers;

use Illuminate\View\View;

class ModalComposer {
    public function __construct() {}

    public function compose(View $view)
    {
        $dataView = $view->getData();
        $data = join(' ', $dataView);
        $view->with('testing', $data);
    }
}