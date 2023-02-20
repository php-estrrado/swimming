<?php

namespace App\Services\Admin;

use App\Models\Admin\User;

class UserService {

    private $user;

    public function __construct(User $user) {
        $this->user = $user;
    }

    public function getMembershipDetails($id) {

        $result = $this->user->getMembershipDetails($id);
        return $result;
    }

    public function checkMembershipUsers($id) {

        $result = $this->user->checkMembershipUsers($id);
        return $result;
    }

}
