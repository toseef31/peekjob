<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use DB;
use Mail;
use Session;
class LogDemo extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sendjobs';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'send latest jobs to jobseeker on daily base related to his field';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    { 
    $yesterday = date('Y-m-d',strtotime("-1 days"));
    $allusers = DB::table('jcm_users')->where('subscribe','Y')->get();
    //echo $yesterday;
    foreach ($allusers as $user) {
        //echo $user->email;
        $getCat = DB::table('jcm_users_meta')->where('userId',$user->userId)->first()->industry;
        $jobs = DB::table('jcm_jobs')->where('category',$getCat)->whereDate('createdTime','=',$yesterday)->get();
        if(count($jobs) > 0){
            $jobstoview = array('jobs' => $jobs);
            Mail::send('emails.jobs',$jobstoview,function($message) use ($user){
                $message->to($user->email)->subject('Latest jobs');
            });
        }
        
    }
    }
}
