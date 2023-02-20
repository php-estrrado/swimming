<?php

namespace App\Repositories\Admin;

use App\Contracts\Admin\LocationInterface as LocationInterface;
use App\Models\Admin\Base;
use App\Models\Admin\User;
use App\Models\Admin\Location;

class LocationRepository extends UserRepository implements LocationInterface {

    private $location;

    public function __construct(Base $base, User $user, Location $location) {
        parent::__construct($base,$user);
        $this->location = $location;
    }

    public function getLocations() {
        return $this->location->getLocations();
    }

}
