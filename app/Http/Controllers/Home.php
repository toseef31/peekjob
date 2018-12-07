<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//use app\Mail\jobsnotifications;
use Mail;
use Storage;
use App\Jobs;
use App\CometChat;
use App\JobsApplied;
use App\User; 
use App\Package; 
use App\Write; 
use App\Skill; 
use DB;
class Home extends Controller{
    
    public function notFound(){
    	echo 'here';
    }
    public function sendMessage(Request $request){
    	$message = $request->message;
    	event( new \App\Events\TaskEvent($message));
    }
	public function testCron(){
		/*get non communicating users*/
		$comet=CometChat::whereNull('custom_data')->get()->toArray();
		$emailSent=[];
		if(count($comet)>0):
			echo "Comet count: ".count($comet).' ////<br/>';
			foreach($comet as $items): 
				if(!in_array("{$items['from']}-{$items['to']}",$emailSent)):
					$where=['from'=>$items['to'],'to'=>$items['from']]; //check if 'to' has replied back?
					$foundTo=CometChat::where($where)->count();
					if($foundTo>0): //if yes (update both two user as communicating)
						$orWhere=['to'=>$items['to'],'from'=>$items['from']];
						CometChat::where($where)->orWhere($orWhere)->update(['custom_data' => 1]); 
						echo "Found: {$items['from']} -- {$items['to']} <br/>";
					else:
						echo "Not Found: {$items['from']} -- {$items['to']} <br/>";
						//Employer check (email should always sent from employer to applicant)
						$cJobs=Jobs::where('userId',$items['from'])->get();
						if(count($cJobs)>0):
							foreach($cJobs as $jobs): 
								$jobWhere=['userId'=>$items['to'],'jobId'=>$jobs->jobId];
								$jApplied=JobsApplied::where($jobWhere)->count();
								if($jApplied>0): //to has applied on from job
									//send email 
									$employer=User::where('userId',$items['from'])->first();
									$empName="{$employer->firstName} {$employer->lastName}";
									$applicant=User::where('userId',$items['to'])->first();
									$appName="{$applicant->firstName} {$applicant->lastName}";
									$myContent="
									Dear {$appName}, <br/>
									Employer ({$empName}) has sent you message, reply him back by logging at https://www.jobcallme.com
									<br/><br/>
									Regards.";
									echo "{$myContent} <br/>";
									$subject="Employer Message: JobCallMe";
									$email=$applicant->email;
									Mail::send([],[], function ($message) use($email,$myContent,$subject){  
										$message->to($email, $email)->subject($subject)->setBody($myContent,'text/html');
									}); 
									array_push($emailSent,"{$items['from']}-{$items['to']}");
								endif;
							endforeach;	 
							$orWhere=['to'=>$items['to'],'from'=>$items['from']];
							CometChat::where($where)->orWhere($orWhere)->update(['custom_data' => 1]);
						endif; 
					endif;
				endif;
			endforeach;
		endif; 
	}

    public function sendEmail(Request $request){
    	$message = 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
proident, sunt in culpa qui officia deserunt mollit anim id est laborum.';
    	$event = array('name' => 'M Umair', 'msgBody' => $message, 'subject' => 'Welcome');
    	//print_r($event);exit;
    	/*Mail::to('muhammadsajid9005@gmail.com')->send(new jobsnotifications($name = 'sajid'));*/
    	
    	Mail::send('emails.jobs', $event, function($message){
		    $message->to('muhammadsajid9005@gmail.com')->subject('Welcome!');
		});
		
    }

	 public function jobCallMePayResult()
    {  
		/*$postedData='{"resultCode":"3001","resultMsg":"\uce74\ub4dc \uacb0\uc81c \uc131\uacf5                                                                                      ","authDate":"180113205258","authCode":"31976428                      ","buyerName":"66                            ","mallUserID":"                    ","goodsName":"jobcallme                               ","mid":"nicepay00m","tid":"nicepay00m01011801131153025658","moid":"mnoid1234567890                                                 ","amt":"000000022330","cardCode":"01 ","cardQuota":"00","cardName":"\ube44\uc528                                                                                                ","bankCode":"","bankName":"","rcptAuthCode":"","carrier":"","dstAddr":"","vbankBankCode":"","vbankBankName":"","vbankNum":"","vbankExpDate":""}';*/
		/*echo $jId;
		die('hmmmm');*/
		$data=json_encode($_POST); 		
		$postedData=json_decode($data); 
		$jId=rtrim($postedData->buyerName);
		$authCode=rtrim($postedData->authCode);
		 
		$fileName='test.txt';
		$fileContents= Storage::disk('local')->get($fileName);
		$fileContents.=$data." ================================================== ";
        Storage::disk('local')->put($fileName, $fileContents);
		/*$fileName='test.txt';
		$jId='53'; 
		$authCode='hmmm'; */
		if($jId){ 
			$fileContents= Storage::disk('local')->get($fileName);
			$fileContents.=" ======== IN TESTING ====== ";
			Storage::disk('local')->put($fileName, $fileContents);
			$newid=explode('-',$jId);

			if($newid[1] == 'package'){
			DB::table('jcm_save_packeges')->where('id','=',$newid[0])->update(['status'=>1]);
            
			}
			elseif($newid[1] == 'write'){
			$jobData=Write::findOrFail($newid[0]); 
			$jobData->status='Publish';
			$jobData->save();
			}
			elseif($newid[1] == 'upskill'){
			$jobData=Skill::findOrFail($newid[0]); 
			$jobData->status='Active';
			$jobData->save();
			}
			else{
			$jobData=Jobs::findOrFail($newid[0]); 
			$jobData->status=1;
			$jobData->pay_id=$authCode;
			$jobData->p_Category=$newid[1];
			$jobData->package_start_time=date('Y-m-d H:i:s');
			$jobData->save();
			}

			$fileContents= Storage::disk('local')->get($fileName);
			$fileContents.=" <== Run Successfully ====== > ";
			Storage::disk('local')->put($fileName, $fileContents);
		}
		die('hmm');
    }

	public function paymentCompleted(){
		return view('frontend.paymentCompleted');
	}
}
?>