<?php

function getAuthDetails() {
    $user = Auth::user();

    $data = [
        'id' => $user->id,
        'username' => $user->name,
        'userid' => $user->id,
        'email' => $user->email,
        'phone' => $user->phone,
        'role' => $user->role
    ];

    return $data;
}
