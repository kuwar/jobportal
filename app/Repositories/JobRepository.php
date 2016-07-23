<?php
namespace App\Repositories;

use Illuminate\Http\Request;
use App\Http\Requests;
use Carbon;
use Illuminate\Database\Eloquent\ModelNotFoundException;

use App\Library\General;
use App\Library\SendEmail;
use App\Library\AjaxResponse;

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

    /**
     * Update job
     */
    public function updateJob($id) {
        $input = $this->request->all();

        try {
            //updating job
            Job::where('id', $id)
                ->update([
                    'title' => $input['title'],
                    'description' => $input['description'],
                ]);
            return true;
        }
        catch (ModelNotFoundException $ex) {
            return false;
        }
    }

    /** 
     * Update Skill
     */
    public function updateSkill(){
        $input = $this->request->all();

        try {
            //updating skill
            Skill::where('id', $input['skill_id'])
                ->update([
                    'title' => $input['title'],
                ]);
            return true;
        }
        catch (ModelNotFoundException $ex) {
            return false;
        }
    }

    /**
     * Delete job skill
     */
    public function deleteJob($id){

        try {
            $job = Job::findOrFail($id);
            
            if ($job->delete()) {
                return true;
            }
            return false;
        } catch (ModelNotFoundException $e) {
            return false;
        }
    }

    /** 
     * Add job's skills
     */
    public function addSkills(){
        $input = $this->request->all();

        // Retrive skills from array and add
        for ($i = 0; $i < count($input['skills']); $i++) {
            $skills = [
                'job_id' => $input['job_id'],
                'title' => $input['skills'][$i]
            ];
            Skill::create($skills);
        }

        return true;
    }

    /**
     * Delete job skill
     */
    public function deleteJobSkill(){
        $input = $this->request->all();

        try {
            $skill = Skill::findOrFail($input['skill_id']);

            if ($skill->delete()) {
                return AjaxResponse::sendResponse("Successfully deleted skill", false, 200);
            }

            return AjaxResponse::sendResponse("Sorry! Error occured", true, 200);
        } catch (ModelNotFoundException $e) {
            return AjaxResponse::sendResponse("Sorry! Error occured", true, 200);
        }
    }
}