<?php

namespace App\Policies;

use App\Models\Member;
use App\Models\HealthRecord;
use Illuminate\Auth\Access\HandlesAuthorization;

class HealthRecordPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the health record.
     *
     * @param  \App\Models\Member  $member
     * @param  \App\Models\HealthRecord  $healthRecord
     * @return mixed
     */
    public function view(Member $member, HealthRecord $healthRecord)
    {
        return $member->id === $healthRecord->member_id;
    }
}