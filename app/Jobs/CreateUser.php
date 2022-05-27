<?php namespace App\Jobs;

use DB;
use Str;
use App\Models\User;
use App\Abstracts\Job;

class CreateUser extends Job
{

    protected $request, $user;

    /**
     * Create a new job instance.
     *
     * @param  $request
     */
    public function __construct($request)
    {
        $this->request = $this->getRequestInstance($request);
    }

    /**
     * Execute the job.
     *
     */
    public function handle()
    {
        $data = $this->request->all();
        
        $data = array_merge($data, [
            'name'      => ucfirst($this->request['name']),
            'uuid'      => Str::uuid(),
            'enabled'   => 0,
            'suspend'   => 1,
            'verify'    => 0
        ]);

        try {
            DB::beginTransaction();
                
                $newUser = User::create($data);
                // Attach new user for user role
                $newUser->roles()->attach(2);
                
                $this->user = $newUser;

            DB::commit();
        }catch (\Exception $e) {
            DB::rollback();
        }

        return $this->user;
    }
}