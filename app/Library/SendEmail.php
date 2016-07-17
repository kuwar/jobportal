<?php

namespace App\Library;

use Mail;
use Log;

class SendEmail
{
    public function __construct()
    {
    }

    /**
     * send email
     *
     */
    static function sendEmail($user, $emailView, $subject){
        try {
            Mail::send($emailView, ['user' => $user, 'logo' => '', 'path' => url('/verify/'.$user->verification_token) ], function ($m) use ($user, $subject) {
                $m->from(env('FROM_EMAIL'), env('FROM_USERNAME'));

                $m->to($user->email, $user->first_name)->subject($subject);
            });
        }
        catch (\Exception $ex) {
            Log::info('Error occured on sending email.');
        }
    }

    /** 
     * Send job created email
     */
    static function sendEmailOnJobCreation($user, $token, $jobId){
        try {
            Mail::send('emails.job', ['token' => $token, 'user' => $user, 'jobId' => $jobId], function ($m) use ($user) {
                $m->from(env('MAIL_FROM_EMAIL'), env('MAIL_FROM_NAME'));

                $m->to($user->email, "")->subject("You create a job");
            });
        }
        catch (\Exception $ex) {
            Log::info('Error occured on sending email.');
        }
    }

}