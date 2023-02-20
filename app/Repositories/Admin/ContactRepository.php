<?php

namespace App\Repositories\Admin;

use App\Contracts\Admin\ContactInterface as ContactInterface;
use App\Models\Admin\Base;
use App\Models\Admin\User;
use App\Models\Admin\Contact;

class ContactRepository extends UserRepository implements ContactInterface {

    private $contact;

    public function __construct(Base $base, User $user, Contact $contact) {
        parent::__construct($base, $user);
        $this->contact = $contact;
    }

}
