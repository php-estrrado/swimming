<?php

namespace App\Repositories\Admin;

use App\Contracts\Admin\UserInterface as UserInterface;
use App\Models\Admin\Base;
use App\Models\Admin\User;

class UserRepository extends BaseRepository implements UserInterface {

    private $user;

    public function __construct(Base $base, User $user) {
        parent::__construct($base);
        $this->user = $user;
    }

    public function getUsers($args) {
        return $this->user->getUsers($args);
    }

    public function getUser($type, $userid) {
        return $this->user->getUser($type, $userid);
    }

    public function createUser($data, $type) {
        return $this->user->createUser($data, $type);
    }

    public function updateUser($data, $type, $userid) {
        return $this->user->updateUser($data, $type, $userid);
    }

    public function deleteUser($tablename, $userid) {
        return $this->user->deleteUser($tablename, $userid);
    }

    public function deleteUsers($tablename, $userids) {
        return $this->user->deleteUsers($tablename, $userids);
    }

    public function checkUserDetails($tablename, $field, $value, $userid) {
        return $this->user->checkUserDetails($tablename, $field, $value, $userid);
    }

    public function getLastCustomerCode($userid) {
        return $this->user->getLastCustomerCode($userid);
    }

    public function upgradeMembership($data, $type, $userid) {
        return $this->user->upgradeMembership($data, $type, $userid);
    }

    public function renewMembership($data, $type, $userid) {
        return $this->user->renewMembership($data, $type, $userid);
    }

    public function getAllMemberships($status) {
        return $this->user->getAllMemberships($status);
    }

    public function getUserMembership($type, $mid) {
        return $this->user->getUserMembership($type, $mid);
    }

    public function getMembershipById($id) {
        return $this->user->getMembershipById($id);
    }

    public function getAllMembershipValidity() {
        return $this->user->getAllMembershipValidity();
    }

    public function getMembershipValidity($id) {
        return $this->user->getMembershipValidity($id);
    }

    public function getMemberValidity($id) {
        return $this->user->getMemberValidity($id);
    }

    public function getMembershipPlanById($id) {
        return $this->user->getMembershipPlanById($id);
    }

    public function saveMembership($data, $id) {
        return $this->user->saveMembership($data, $id);
    }

    public function deleteMembership($id) {
        return $this->user->deleteMembership($id);
    }

    public function deleteMemberships($ids) {
        return $this->user->deleteMemberships($ids);
    }

    public function getCallHistory($args) {
        return $this->user->getCallHistory($args);
    }

    public function getStaff($args) {
        return $this->user->getStaff($args);
    }

    public function getStaffCount($args) {
        return $this->user->getStaffCount($args);
    }
    
    public function saveMessageDetails($args) {
        return $this->user->saveMessageDetails($args);
    }

}
