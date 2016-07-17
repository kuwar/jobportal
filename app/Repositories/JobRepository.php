<?php
namespace App\Repositories;

use Illuminate\Http\Request;
use App\Http\Requests;
use Carbon;
use Illuminate\Database\Eloquent\ModelNotFoundException;

use App\Library\General;
use App\Library\SendEmail;

use App\Models\Job;
use App\Models\User;
use App\Models\Skill;

class JobRepository {

    protected $request;

    /**
     * Defining constructor
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /** 
     * Get all jobs
     */
    public function getJobs() {

    	$jobs = Job::with('user', 'skills')->get();
    	
    	return $jobs;
    }

    /**
     * Get single job with its data
     */
    public function getJob($id) {
    	
    	$jobs = Job::with('user', 'skills')->where('id', $id)->first();
    	
    	return $jobs;
    }

    /** 
     * Insert new jobs
     */
    public function insertNewJob() {
        $input = $this->request->all();

        try {
            // get user data
            $user = User::firstOrCreate(['email' => $input['email']]);
            // get unique random token
            $linkId = General::generateVerificationToken();

            $jobId = Job::insertGetId([
                'user_id' => $user->id,
                'title' => $input['title'],
                'description' => $input['description'],
                'link_id' => $linkId,
            ]);
            // insert skills
            for ($i = 0; $i < count($input['skills']); $i++) {
                $skills = [
                    'job_id' => $jobId,
                    'title' => $input['skills'][$i]
                ];
                Skill::create($skills);
            }
            SendEmail::sendEmailOnJobCreation($user, $linkId, $jobId);
            return true;
        }
        catch(ModelNotFoundException $ex) {
            return false;
        }
        catch(Exception $ex) {
            return false;
        }
        
        
    }

}