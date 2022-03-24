<?php

namespace App\DatabaseNotifications;

use App\Models\User;
use Illuminate\Notifications\DatabaseNotification;

class UserDatabaseNotification extends DatabaseNotification
{
    public function getCandidateVendorAttribute(){
        $candidate_vendor = User::find($this->data["candidate_vendor_id"]);
        return $candidate_vendor;
    }
}
