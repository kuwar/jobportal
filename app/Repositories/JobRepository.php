<?php
namespace App\Repositories;

use Illuminate\Http\Request;
use App\Http\Requests;

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

}