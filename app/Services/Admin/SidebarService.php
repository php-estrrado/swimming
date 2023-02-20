<?php

namespace App\Services\Admin;

use App\Models\Admin\Base;

class SidebarService {

    private $base;

    public function __construct(Base $base) {
        $this->base = $base;
    }

    public function getPages() {

        $tablename = "pages";
        $field = "id";
        $order = "asc";
        $active = 1;
        $status = 1;

        $result = $this->base->getAllRows($tablename, $field, $order, $active, $status);
        return $result;
    }

}
