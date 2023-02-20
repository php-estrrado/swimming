<?php

namespace App\Repositories\Admin;

use App\Contracts\Admin\WidgetInterface as WidgetInterface;
use App\Models\Admin\Base;
use App\Models\Admin\User;
use App\Models\Admin\Widget;

class WidgetRepository extends UserRepository implements WidgetInterface {

    private $widget;

    public function __construct(Base $base, User $user, Widget $widget) {
        parent::__construct($base, $user);
        $this->widget = $widget;
    }

}
