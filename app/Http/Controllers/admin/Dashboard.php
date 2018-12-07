<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class Dashboard extends Controller{
    public function __construct(){
	}

	public function index(){
		if(!session()->has('jcmAdmin')){
			return redirect('admin/login');
		}

		return view('admin.dashboard');
	}
	 public function home(){
		/* job shift query */
		//$jobShifts = DB::table('jcm_job_shift')->get();

		/* companies query */
		$companies = DB::table('jcm_companies')->get();
		$admin = DB::table('jcm_users')->get();

		/* jobs query */
		$jobs = DB::table('jcm_jobs')->select('jcm_jobs.*','jcm_payments.title as p_title','jcm_companies.companyId','jcm_companies.companyName','jcm_companies.companyLogo','jcm_users.email')->leftJoin('jcm_payments','jcm_jobs.p_Category','=','jcm_payments.id')->leftJoin('jcm_users','jcm_users.companyId','=','jcm_jobs.companyId')->leftJoin('jcm_companies','jcm_companies.companyId','=','jcm_jobs.companyId')->where('jcm_jobs.jType','=','Paid')->where('jcm_jobs.expiryDate','>',date('Y-m-d'))->orderBy('jcm_jobs.jobId','desc')->paginate(12);
		

		return view('admin.order',compact('jobs'));
	}
	 public function receive(){
		/* job shift query */
		//$jobShifts = DB::table('jcm_job_shift')->get();

		/* companies query */
		$companies = DB::table('jcm_companies')->get();
		$admin = DB::table('jcm_users')->get();

		/* jobs query */
		$orders = DB::table('jcm_make_payment')->orderBy('id','desc')->paginate(12);
		

		return view('admin.receive_payment',compact('orders'));
	}
}
