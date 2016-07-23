<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Session;

use App\Repositories\JobRepository;
use App\Http\Requests\JobRequest;

class JobController extends Controller
{
    protected $jobRepo;

    /**
     * Constructor function to initialize repository
     */
    public function __construct(JobRepository $jobRepository) {
        $this->jobRepo = $jobRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $jobs = $this->jobRepo->getJobs();

        return view('jobs.index')->with(['items' => $jobs]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Get the groups
        return view('jobs.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(JobRequest $request)
    {
        $jobInsertStatus = $this->jobRepo->insertNewJob();
        
        if ($jobInsertStatus) {
            Session::flash('success', "New job created successfully.");
        }
        else {
            Session::flash('error', "Sorry! error occured");
        }
        
        return redirect('/job');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $job = $this->jobRepo->getJob($id);

        return view('jobs.view')->with(['item' => $job]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $job = $this->jobRepo->getJob($id);
        return view('jobs.edit')->with(['item' => $job]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(JobRequest $request, $id)
    {

        $jobUpdateStatus = $this->jobRepo->updateJob($id);

        if ($jobUpdateStatus) {
            Session::flash('success', "Successfully updated job");
            return redirect()->back();
        }
        else {
            Session::flash('warning', "Something went wrong while updating job");
            return redirect()->back();
        }
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $jobDeleteStatus = $this->jobRepo->deleteJob($id);

        if ($jobDeleteStatus) {
            Session::flash('success', 'Successfully deleted job');
        }
        else {
            Session::flash('warning', "Sorry! Error occured");
        }
        return redirect()->back();
    }

    /**
     * Delete job's skill
     */
    public function deleteSkill() {
        $jobSkillDeleteData = $this->jobRepo->deleteJobSkill();
        return $jobSkillDeleteData;
    }
}
