<?php

namespace App\Repositories\Admin;

use App\Contracts\Admin\DashboardInterface as DashboardInterface;
use App\Models\Admin\Base;
use App\Models\Admin\User;
use App\Models\Admin\Dashboard;

class DashboardRepository extends UserRepository implements DashboardInterface {

    private $dashboard;

    public function __construct(Base $base, User $user, Dashboard $dashboard) {
        parent::__construct($base, $user);
        $this->dashboard = $dashboard;
    }

    public function getDashboardData(){ return $this->dashboard->getDashboardData(); }
    public function getProfileDetails($arg1){ return $this->dashboard->getProfileDetails($arg1); }
    public function updateProfile($arg1,$arg2){ return $this->dashboard->updateProfile($arg1,$arg2); }
}
