<?php

namespace App\Library;

use Hash;
use Illuminate\Support\Str;

use App\Models\Job;

class General
{
    public function __construct()
    {
    }

    /**
     * Generate job edit and delete verification token
     */
    static function generateVerificationToken()
    {
        $verificationToken = md5(Str::random(10));
        $user = Job::where('link_id', $verificationToken)->first();
        if($user) {
            self::generateVerificationToken();
        }
        return $verificationToken;
    }

}