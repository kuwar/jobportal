<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Job;

class JobLinkIdVerification
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if ($request->session()->has('jobLinkId')) {
            $jobId = $request->job;
            $linkId = $request->session()->get('jobLinkId');
            $job = Job::where('id', $jobId)->where('link_id', $linkId)->first();
            if ($job) {
                return $next($request);
            }            
        }

        $request->session()->flash('warning', 'Not allowed to edit job. You are not owner of this job post.');
        return redirect('/job');
    }
}
