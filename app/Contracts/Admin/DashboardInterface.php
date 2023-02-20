<?php

namespace App\Contracts\Admin;

interface DashboardInterface extends UserInterface {

    public function getDashboardData();
    public function getProfileDetails($arg1);
    public function updateProfile($arg1,$arg2);

}
