<?php

namespace App\Repositories\Admin;

use App\Contracts\Admin\PageInterface as PageInterface;
use App\Models\Admin\Base;
use App\Models\Admin\User;
use App\Models\Admin\Page;

class PageRepository extends UserRepository implements PageInterface {

    private $page;

    public function __construct(Base $base, User $user, Page $page) {
        parent::__construct($base, $user);
        $this->page = $page;
    }

}
