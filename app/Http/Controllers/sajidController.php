<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Facade\JobCallMe;
use DB;
use Sajid;
use Mail;
use App;
use Session;
class sajidController extends Controller{
	public function savecomment(Request $request){

		$data['post_id'] = $request->input('post_id');
		$data['table_name'] = $request->input('table_name');
        $data['comment'] = $request->input('comment');
        $id = $request->input('comment_id');
        $type = $request->input('type');
        
        if($type == 'delete'){
            DB::table('jcm_comments')->where('comment_id',$id)->delete();
        }
		else if($type == 'edit'){
			$data['update_comment'] = date("Y-m-d h:i:s");
			DB::table('jcm_comments')->where('comment_id',$id)->update($data);
		}
        else if($type == 'insert'){
			$data['commenter_id'] = $request->input('commenter_id');
			$id = DB::table('jcm_comments')->insertGetid($data);
		}
        $comment = DB::table('jcm_comments')->leftJoin('jcm_users','jcm_users.userId','=','jcm_comments.commenter_id')->where('post_id',$data['post_id'])->where('table_name',$data['table_name'])->where('comment_id',$id)->first();

        event(new \App\Events\comments($comment,$data,$id,$type));
        
        $temp ='<div class="col-md-2 col-xs-2" style="padding: 0px;">
            <div class="btns">
                    <i class="fa fa-edit edit-comment-btn"></i>
                    <i delcommentId="'.$comment->comment_id.'" class="fa fa-trash del-comment-btn" aria-hidden="true"></i>
  
            </div>
            <div class="btns-update" style="display: none">
                <button commentId="'.$comment->comment_id.'" class="btn btn-success update-comment-btn">Update</button>
                <button class="btn btn-danger cancel">Cancel</button>
            </div>
        </div>';

    echo json_encode(array("temp"=>$temp,"comment_id"=>$comment->comment_id));
	}


public function jobreviews($jobid){
    $userId = Session::get('jcmUser')->userId;
    
    if($jobid == 'all'){
        $data = DB::table('comments')->leftJoin('jcm_users','comments.jobseeker_id','=','jcm_users.userId')->where('employeer_id',$userId)->get();
    }else{
        $data = DB::table('comments')->leftJoin('jcm_users','comments.jobseeker_id','=','jcm_users.userId')->where('employeer_id',$userId)->where('job_id',$jobid)->get();
    }

    return view('frontend.employer.jobreviews',compact('data'));
}
public function delete(Request $request){
    $table = $request->input('table');
    $field = $request->input('field');
    $id = $request->input('id');
    if(DB::table($table)->where($field,$id)->delete()){
        echo 1;
    }else{
        echo 2;
    }
}
public function update(Request $request){
    $table = $request->input('table');
    $field = $request->input('field');
    $id = $request->input('id');
    $data = $request->input('data');
    
    if(DB::table($table)->where($field,$id)->update($data)){
        echo 1;
    }else{
        echo 2;
    }
}
public function offersinterview(){
    $userId = Session::get('jcmUser')->userId;
    
        $data = DB::table('jcm_offer_interview')->leftJoin('jcm_users','jcm_offer_interview.jobseeker_id','=','jcm_users.userId')->where('jcm_offer_interview.emp_id',$userId)->get();
    

    return view('frontend.employer.offerinterview',compact('data'));
}

public function offers_interview(){
    $userId = Session::get('jcmUser')->userId;
    
        $data = DB::table('jcm_offer_interview')->leftJoin('jcm_users','jcm_offer_interview.jobseeker_id','=','jcm_users.userId')->where('jcm_offer_interview.jobseeker_id',$userId)->get();
    

    return view('frontend.jobseeker.offer_interview',compact('data'));
}

public function offerdelete(Request $request){
    $table = $request->input('table');
    $field = $request->input('field');
    $id = $request->input('id');
    if(DB::table($table)->where($field,$id)->delete()){
        echo 1;
    }else{
        echo 2;
    }
}
public function offerupdate(Request $request){
    $table = $request->input('table');
    $field = $request->input('field');
    $id = $request->input('id');
    $data = $request->input('data');
    
    if(DB::table($table)->where($field,$id)->update($data)){
        echo 1;
    }else{
        echo 2;
    }
}


}