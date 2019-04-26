<?php

namespace App\Http\Controllers\frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Facade\JobCallMe;
use DB;
use PDF;
use Zipper;
use File;
use Redis;

class Jobseeker extends Controller{
	public function post(Request $request){
		$userid = $request->session()->get('jcmUser')->userId;
		$task=DB::table('posts')->select('posts.*','jcm_users.firstName','jcm_users.lastName','jcm_users.profilePhoto')->join('jcm_users','jcm_users.userId','=','posts.user_id')->join('jcm_users_meta','jcm_users_meta.userId','=','posts.user_id')->orderBy('posts.created_at','desc')->get();
		
		foreach($task as &$rec){
			$rec->comment=DB::table('post_comments')->select('post_comments.*','jcm_users.firstName','jcm_users.lastName','jcm_users.profilePhoto')->join('jcm_users','jcm_users.userId','=','post_comments.userId')->join('jcm_users_meta','jcm_users_meta.userId','=','post_comments.userId')->where('pst_id','=',$rec->post_id)->get()->toArray();
			$rec->count=DB::table('post_comments')->select('post_comments.*','jcm_users.firstName','jcm_users.lastName','jcm_users.profilePhoto')->join('jcm_users','jcm_users.userId','=','post_comments.userId')->join('jcm_users_meta','jcm_users_meta.userId','=','post_comments.userId')->where('pst_id','=',$rec->post_id)->count();
			$rec->isFavorited=DB::table('post_like')->where('post_ID','=',$rec->post_id)->where('user_ID','=',$userid)->count();
			$rec->likecount=DB::table('post_like')->where('post_ID','=',$rec->post_id)->count();
			foreach($rec->comment as &$recs){
				$recs->reply=DB::table('post_comments_reply')->select('post_comments_reply.*','jcm_users.firstName','jcm_users.lastName','jcm_users.profilePhoto')->join('jcm_users','jcm_users.userId','=','post_comments_reply.user_Id')->join('jcm_users_meta','jcm_users_meta.userId','=','post_comments_reply.user_Id')->where('parent_id','=',$recs->cmt_id)->get()->toArray();
			}
		}
		
        return request()->json('200',$task);
	}

	public function addpost(Request $request){
		//dd($request->all());
		$userid = $request->session()->get('jcmUser')->userId;
		if($request->get('image'))
       {
          $image = $request->get('image');
          $name = time().'.' . explode('/', explode(':', substr($image, 0, strpos($image, ';')))[1])[1];
          \Image::make($request->get('image'))->save(public_path('images/').$name);
		}
		$input['post_text']=$request->artical;
		$input['image']=$name;
		$input['user_id']=$userid;
		$input['post_type']='post';
		$input['status']='Active';
		$post=DB::table('posts')->insert($input);
		//return $post;
		if($post){
			$task=DB::table('posts')->select('posts.*','jcm_users.firstName','jcm_users.lastName','jcm_users.profilePhoto')->join('jcm_users','jcm_users.userId','=','posts.user_id')->join('jcm_users_meta','jcm_users_meta.userId','=','posts.user_id')->orderBy('posts.created_at','desc')->get();
				
				
				$redis= Redis::connection();
				$redis->publish('message',json_encode($task));
				return request()->json('200',$task);
		}


	}

	public function addcmt(Request $request){
		//dd($request->all());
		$userid = $request->session()->get('jcmUser')->userId;
		if($request->cmt_id){
			$input['comt_text']=$request->comt_text;
			$post=DB::table('post_comments')->where('cmt_id','=',$request->cmt_id)->update($input);
			if($post){
				$task=DB::table('posts')->select('posts.*','jcm_users.firstName','jcm_users.lastName','jcm_users.profilePhoto')->join('jcm_users','jcm_users.userId','=','posts.user_id')->join('jcm_users_meta','jcm_users_meta.userId','=','posts.user_id')->orderBy('posts.created_at','desc')->get();
				
				foreach($task as &$rec){
					$rec->comment=DB::table('post_comments')->select('post_comments.*','jcm_users.firstName','jcm_users.lastName','jcm_users.profilePhoto')->join('jcm_users','jcm_users.userId','=','post_comments.userId')->join('jcm_users_meta','jcm_users_meta.userId','=','post_comments.userId')->where('pst_id','=',$rec->post_id)->get()->toArray();
					$rec->count=DB::table('post_comments')->select('post_comments.*','jcm_users.firstName','jcm_users.lastName','jcm_users.profilePhoto')->join('jcm_users','jcm_users.userId','=','post_comments.userId')->join('jcm_users_meta','jcm_users_meta.userId','=','post_comments.userId')->where('pst_id','=',$rec->post_id)->count();
					$rec->isFavorited=DB::table('post_like')->where('post_ID','=',$rec->post_id)->where('user_ID','=',$userid)->count();
					$rec->likecount=DB::table('post_like')->where('post_ID','=',$rec->post_id)->count();
				}
				
				$redis= Redis::connection();
				$redis->publish('message',json_encode($task));
				return request()->json('200',$task);
			}
		}
		else{
		
		$input['comt_text']=$request->comt_text;
		$input['pst_id']=$request->pst_id;
		$input['userId']=$userid;
		$post=DB::table('post_comments')->insert($input);
		//return $post;
		if($post){
				$task=DB::table('posts')->select('posts.*','jcm_users.firstName','jcm_users.lastName','jcm_users.profilePhoto')->join('jcm_users','jcm_users.userId','=','posts.user_id')->join('jcm_users_meta','jcm_users_meta.userId','=','posts.user_id')->orderBy('posts.created_at','desc')->get();
				
				foreach($task as &$rec){
					$rec->comment=DB::table('post_comments')->select('post_comments.*','jcm_users.firstName','jcm_users.lastName','jcm_users.profilePhoto')->join('jcm_users','jcm_users.userId','=','post_comments.userId')->join('jcm_users_meta','jcm_users_meta.userId','=','post_comments.userId')->where('pst_id','=',$rec->post_id)->get()->toArray();
					$rec->count=DB::table('post_comments')->select('post_comments.*','jcm_users.firstName','jcm_users.lastName','jcm_users.profilePhoto')->join('jcm_users','jcm_users.userId','=','post_comments.userId')->join('jcm_users_meta','jcm_users_meta.userId','=','post_comments.userId')->where('pst_id','=',$rec->post_id)->count();
					$rec->isFavorited=DB::table('post_like')->where('post_ID','=',$rec->post_id)->where('user_ID','=',$userid)->count();
					$rec->likecount=DB::table('post_like')->where('post_ID','=',$rec->post_id)->count();
				}
				
				$redis= Redis::connection();
				$redis->publish('message',json_encode($task));
				return request()->json('200',$task);
			}
		}
	}


	public function cmtperpost(Request $request){
		//dd($request->all());
		$post_id=$request->pst_id;
		$userid = $request->session()->get('jcmUser')->userId;
		if($request->cmt_id){
			$input['comt_text']=$request->comt_text;
			$post=DB::table('post_comments')->where('cmt_id','=',$request->cmt_id)->update($input);
			if($post){
				$task=DB::table('posts')->select('posts.*','jcm_users.firstName','jcm_users.lastName','jcm_users.profilePhoto')->join('jcm_users','jcm_users.userId','=','posts.user_id')->join('jcm_users_meta','jcm_users_meta.userId','=','posts.user_id')->where('post_id','=',$post_id)->get();
				
				foreach($task as &$rec){
					$rec->comment=DB::table('post_comments')->select('post_comments.*','jcm_users.firstName','jcm_users.lastName','jcm_users.profilePhoto')->join('jcm_users','jcm_users.userId','=','post_comments.userId')->join('jcm_users_meta','jcm_users_meta.userId','=','post_comments.userId')->where('pst_id','=',$rec->post_id)->get()->toArray();
					$rec->count=DB::table('post_comments')->select('post_comments.*','jcm_users.firstName','jcm_users.lastName','jcm_users.profilePhoto')->join('jcm_users','jcm_users.userId','=','post_comments.userId')->join('jcm_users_meta','jcm_users_meta.userId','=','post_comments.userId')->where('pst_id','=',$rec->post_id)->count();
					$rec->isFavorited=DB::table('post_like')->where('post_ID','=',$rec->post_id)->where('user_ID','=',$userid)->count();
					$rec->likecount=DB::table('post_like')->where('post_ID','=',$rec->post_id)->count();
				}
				
				$redis= Redis::connection();
				$redis->publish('message',json_encode($task));
				return request()->json('200',$task);
			}
		}
		else{
		
		$input['comt_text']=$request->comt_text;
		$input['pst_id']=$request->pst_id;
		$input['userId']=$userid;
		$post=DB::table('post_comments')->insert($input);
		//return $post;
		if($post){
				$task=DB::table('posts')->select('posts.*','jcm_users.firstName','jcm_users.lastName','jcm_users.profilePhoto')->join('jcm_users','jcm_users.userId','=','posts.user_id')->join('jcm_users_meta','jcm_users_meta.userId','=','posts.user_id')->where('post_id','=',$post_id)->get();
				
				foreach($task as &$rec){
					$rec->comment=DB::table('post_comments')->select('post_comments.*','jcm_users.firstName','jcm_users.lastName','jcm_users.profilePhoto')->join('jcm_users','jcm_users.userId','=','post_comments.userId')->join('jcm_users_meta','jcm_users_meta.userId','=','post_comments.userId')->where('pst_id','=',$rec->post_id)->get()->toArray();
					$rec->count=DB::table('post_comments')->select('post_comments.*','jcm_users.firstName','jcm_users.lastName','jcm_users.profilePhoto')->join('jcm_users','jcm_users.userId','=','post_comments.userId')->join('jcm_users_meta','jcm_users_meta.userId','=','post_comments.userId')->where('pst_id','=',$rec->post_id)->count();
					$rec->isFavorited=DB::table('post_like')->where('post_ID','=',$rec->post_id)->where('user_ID','=',$userid)->count();
					$rec->likecount=DB::table('post_like')->where('post_ID','=',$rec->post_id)->count();
				}
				
				$redis= Redis::connection();
				$redis->publish('message',json_encode($task));
				return request()->json('200',$task);
			}
		}
	}

	public function replycmt(Request $request){
		//dd($request->all());
		$userid = $request->session()->get('jcmUser')->userId;
		$input['reply_text']=$request->reply_text;
		$input['parent_id']=$request->parent_id;
		$input['post_Id']=$request->post_Id;
		$input['user_Id']=$userid;
		$post=DB::table('post_comments_reply')->insert($input);
		//return $post;
		if($post){
				$task=DB::table('posts')->select('posts.*','jcm_users.firstName','jcm_users.lastName','jcm_users.profilePhoto')->join('jcm_users','jcm_users.userId','=','posts.user_id')->join('jcm_users_meta','jcm_users_meta.userId','=','posts.user_id')->orderBy('posts.created_at','desc')->get();
				
				foreach($task as &$rec){
					$rec->comment=DB::table('post_comments')->select('post_comments.*','jcm_users.firstName','jcm_users.lastName','jcm_users.profilePhoto')->join('jcm_users','jcm_users.userId','=','post_comments.userId')->join('jcm_users_meta','jcm_users_meta.userId','=','post_comments.userId')->where('pst_id','=',$rec->post_id)->get()->toArray();
					$rec->count=DB::table('post_comments')->select('post_comments.*','jcm_users.firstName','jcm_users.lastName','jcm_users.profilePhoto')->join('jcm_users','jcm_users.userId','=','post_comments.userId')->join('jcm_users_meta','jcm_users_meta.userId','=','post_comments.userId')->where('pst_id','=',$rec->post_id)->count();
					$rec->isFavorited=DB::table('post_like')->where('post_ID','=',$rec->post_id)->where('user_ID','=',$userid)->count();
				    $rec->likecount=DB::table('post_like')->where('post_ID','=',$rec->post_id)->count();
					foreach($rec->comment as &$recs){
						$recs->reply=DB::table('post_comments_reply')->select('post_comments_reply.*','jcm_users.firstName','jcm_users.lastName','jcm_users.profilePhoto')->join('jcm_users','jcm_users.userId','=','post_comments_reply.user_Id')->join('jcm_users_meta','jcm_users_meta.userId','=','post_comments_reply.user_Id')->where('parent_id','=',$recs->cmt_id)->get()->toArray();
					}
				}
				
				$redis= Redis::connection();
				$redis->publish('message',json_encode($task));
				return request()->json('200',$task);
			}
	}
	public function likepost(Request $request){
		//dd($request->all());
		$userid = $request->session()->get('jcmUser')->userId;
		
		$input['post_ID']=$request->post_ID;
		$input['user_Id']=$userid;
		$post=DB::table('post_like')->insert($input);
		if($post){
			$task=DB::table('posts')->select('posts.*','jcm_users.firstName','jcm_users.lastName','jcm_users.profilePhoto')->join('jcm_users','jcm_users.userId','=','posts.user_id')->join('jcm_users_meta','jcm_users_meta.userId','=','posts.user_id')->orderBy('posts.created_at','desc')->limit(1)->get();
			$ret=array();
			foreach($task as &$rec){
				$rec->isFavorited=DB::table('post_like')->where('post_ID','=',$rec->post_id)->where('user_ID','=',$userid)->count();
				$rec->likecount=DB::table('post_like')->where('post_ID','=',$rec->post_id)->count();
			}
			
			$redis= Redis::connection();
			$redis->publish('message',json_encode($task));
			return request()->json('200',$task);
		}

	}

	public function dislike(Request $request,$id){
		$userid = $request->session()->get('jcmUser')->userId;
		$id=$request->id;
		$del=DB::table('post_like')->where('post_ID','=',$id)->where('user_ID','=',$userid)->delete();
		
		if($del){
			$task=DB::table('posts')->select('posts.*','jcm_users.firstName','jcm_users.lastName','jcm_users.profilePhoto')->join('jcm_users','jcm_users.userId','=','posts.user_id')->join('jcm_users_meta','jcm_users_meta.userId','=','posts.user_id')->orderBy('posts.created_at','desc')->limit(1)->get();
				
				foreach($task as &$rec){
					$rec->isFavorited=DB::table('post_like')->where('post_ID','=',$rec->post_id)->where('user_ID','=',$userid)->count();
					$rec->likecount=DB::table('post_like')->where('post_ID','=',$rec->post_id)->count();
				}
		
				$redis= Redis::connection();
				$redis->publish('message',json_encode($task));
				return request()->json('200',$task);
		}

	}

	public function perlikepost(Request $request){
		//dd($request->all());
		$userid = $request->session()->get('jcmUser')->userId;
		
		$input['post_ID']=$request->post_ID;
		$input['user_Id']=$userid;
		$post=DB::table('post_like')->insert($input);
		if($post){
			$task=DB::table('posts')->select('posts.*','jcm_users.firstName','jcm_users.lastName','jcm_users.profilePhoto')->join('jcm_users','jcm_users.userId','=','posts.user_id')->join('jcm_users_meta','jcm_users_meta.userId','=','posts.user_id')->where('post_ID','=',$request->post_ID)->get();
			foreach($task as &$rec){
				$rec->isFavorited=DB::table('post_like')->where('post_ID','=',$rec->post_id)->where('user_ID','=',$userid)->count();
				$rec->likecount=DB::table('post_like')->where('post_ID','=',$rec->post_id)->count();
			}
			$redis= Redis::connection();
			$redis->publish('message',json_encode($task));
			return request()->json('200',$task);
		}

	}

	public function perdislike(Request $request,$id){
		$userid = $request->session()->get('jcmUser')->userId;
		$id=$request->id;
		$del=DB::table('post_like')->where('post_ID','=',$id)->where('user_ID','=',$userid)->delete();
		
		if($del){
			$task=DB::table('posts')->select('posts.*','jcm_users.firstName','jcm_users.lastName','jcm_users.profilePhoto')->join('jcm_users','jcm_users.userId','=','posts.user_id')->join('jcm_users_meta','jcm_users_meta.userId','=','posts.user_id')->where('post_ID','=',$id)->get();
			foreach($task as &$rec){
				$rec->isFavorited=DB::table('post_like')->where('post_ID','=',$rec->post_id)->where('user_ID','=',$userid)->count();
				$rec->likecount=DB::table('post_like')->where('post_ID','=',$rec->post_id)->count();
			}
				$redis= Redis::connection();
				$redis->publish('message',json_encode($task));
				return request()->json('200',$task);
		}

	}

	public function deletedata(Request $request,$id){

		$id=$request->id;
		$del=DB::table('posts')->where('post_id',$id)->delete();
		DB::table('post_comments_reply')->where('parent_id',$id)->delete();
		if($del){
			$task=DB::table('posts')->select('posts.*','jcm_users.firstName','jcm_users.lastName','jcm_users.profilePhoto')->join('jcm_users','jcm_users.userId','=','posts.user_id')->join('jcm_users_meta','jcm_users_meta.userId','=','posts.user_id')->orderBy('posts.created_at','desc')->get();
			
				foreach($task as &$rec){
					$rec->comment=DB::table('post_comments')->select('post_comments.*','jcm_users.firstName','jcm_users.lastName','jcm_users.profilePhoto')->join('jcm_users','jcm_users.userId','=','post_comments.userId')->join('jcm_users_meta','jcm_users_meta.userId','=','post_comments.userId')->where('pst_id','=',$rec->post_id)->get()->toArray();
					$rec->count=DB::table('post_comments')->select('post_comments.*','jcm_users.firstName','jcm_users.lastName','jcm_users.profilePhoto')->join('jcm_users','jcm_users.userId','=','post_comments.userId')->join('jcm_users_meta','jcm_users_meta.userId','=','post_comments.userId')->where('pst_id','=',$rec->post_id)->count();
				}
				
				$redis= Redis::connection();
				$redis->publish('message',json_encode($task));
				return request()->json('200',$task);
		}

	}

	public function deletecmt(Request $request,$id){

		$id=$request->id;
		$del=DB::table('post_comments')->where('cmt_id',$id)->delete();
		if($del){
			$task=DB::table('posts')->select('posts.*','jcm_users.firstName','jcm_users.lastName','jcm_users.profilePhoto')->join('jcm_users','jcm_users.userId','=','posts.user_id')->join('jcm_users_meta','jcm_users_meta.userId','=','posts.user_id')->orderBy('posts.created_at','desc')->get();
				$ret=array();
				foreach($task as &$rec){
					$rec->comment=DB::table('post_comments')->select('post_comments.*','jcm_users.firstName','jcm_users.lastName','jcm_users.profilePhoto')->join('jcm_users','jcm_users.userId','=','post_comments.userId')->join('jcm_users_meta','jcm_users_meta.userId','=','post_comments.userId')->where('pst_id','=',$rec->post_id)->get()->toArray();
					$rec->count=DB::table('post_comments')->select('post_comments.*','jcm_users.firstName','jcm_users.lastName','jcm_users.profilePhoto')->join('jcm_users','jcm_users.userId','=','post_comments.userId')->join('jcm_users_meta','jcm_users_meta.userId','=','post_comments.userId')->where('pst_id','=',$rec->post_id)->count();
					$rec->comment=DB::table('post_comments')->select('post_comments.*','jcm_users.firstName','jcm_users.lastName','jcm_users.profilePhoto')->join('jcm_users','jcm_users.userId','=','post_comments.userId')->join('jcm_users_meta','jcm_users_meta.userId','=','post_comments.userId')->where('pst_id','=',$rec->post_id)->get()->toArray();
					$rec->count=DB::table('post_comments')->select('post_comments.*','jcm_users.firstName','jcm_users.lastName','jcm_users.profilePhoto')->join('jcm_users','jcm_users.userId','=','post_comments.userId')->join('jcm_users_meta','jcm_users_meta.userId','=','post_comments.userId')->where('pst_id','=',$rec->post_id)->count();
					$rec->isFavorited=DB::table('post_like')->where('post_ID','=',$rec->post_id)->where('user_ID','=',$userid)->count();
				    $rec->likecount=DB::table('post_like')->where('post_ID','=',$rec->post_id)->count();
					foreach($rec->comment as &$recs){
						$recs->reply=DB::table('post_comments_reply')->select('post_comments_reply.*','jcm_users.firstName','jcm_users.lastName','jcm_users.profilePhoto')->join('jcm_users','jcm_users.userId','=','post_comments_reply.user_Id')->join('jcm_users_meta','jcm_users_meta.userId','=','post_comments_reply.user_Id')->where('parent_id','=',$recs->cmt_id)->get()->toArray();
					}
				}
				
				$redis= Redis::connection();
				$redis->publish('message',json_encode($task));
				return request()->json('200',$task);
		}

	}
	public function editcmt(Request $request,$id){
		$id=$request->id;
		$edit=DB::table('post_comments')->where('cmt_id',$id)->get();
		return request()->json('200',$edit);
	}
	
	public function perpost(Request $request,$id){
		$userid = $request->session()->get('jcmUser')->userId;
		$task=DB::table('posts')->select('posts.*','jcm_users.firstName','jcm_users.lastName','jcm_users.profilePhoto')->join('jcm_users','jcm_users.userId','=','posts.user_id')->join('jcm_users_meta','jcm_users_meta.userId','=','posts.user_id')->where('post_id','=',$id)->get();
		foreach($task as &$rec){
			        $rec->comment=DB::table('post_comments')->select('post_comments.*','jcm_users.firstName','jcm_users.lastName','jcm_users.profilePhoto')->join('jcm_users','jcm_users.userId','=','post_comments.userId')->join('jcm_users_meta','jcm_users_meta.userId','=','post_comments.userId')->where('pst_id','=',$rec->post_id)->get()->toArray();
					$rec->count=DB::table('post_comments')->select('post_comments.*','jcm_users.firstName','jcm_users.lastName','jcm_users.profilePhoto')->join('jcm_users','jcm_users.userId','=','post_comments.userId')->join('jcm_users_meta','jcm_users_meta.userId','=','post_comments.userId')->where('pst_id','=',$rec->post_id)->count();
					$rec->comment=DB::table('post_comments')->select('post_comments.*','jcm_users.firstName','jcm_users.lastName','jcm_users.profilePhoto')->join('jcm_users','jcm_users.userId','=','post_comments.userId')->join('jcm_users_meta','jcm_users_meta.userId','=','post_comments.userId')->where('pst_id','=',$rec->post_id)->get()->toArray();
					$rec->count=DB::table('post_comments')->select('post_comments.*','jcm_users.firstName','jcm_users.lastName','jcm_users.profilePhoto')->join('jcm_users','jcm_users.userId','=','post_comments.userId')->join('jcm_users_meta','jcm_users_meta.userId','=','post_comments.userId')->where('pst_id','=',$rec->post_id)->count();
					$rec->isFavorited=DB::table('post_like')->where('post_ID','=',$rec->post_id)->where('user_ID','=',$userid)->count();
				    $rec->likecount=DB::table('post_like')->where('post_ID','=',$rec->post_id)->count();
					foreach($rec->comment as &$recs){
						$recs->reply=DB::table('post_comments_reply')->select('post_comments_reply.*','jcm_users.firstName','jcm_users.lastName','jcm_users.profilePhoto')->join('jcm_users','jcm_users.userId','=','post_comments_reply.user_Id')->join('jcm_users_meta','jcm_users_meta.userId','=','post_comments_reply.user_Id')->where('parent_id','=',$recs->cmt_id)->get()->toArray();
					}
				}
		
		return request()->json('200',$task);
	}

	public function homefeed(Request $request){
		    	$app = $request->session()->get('jcmUser');
				$user = DB::table('jcm_users')->where('userId',$app->userId)->first();
				$lear_record = DB::table('jcm_upskills')->orderBy('skillId','desc')->limit(6)->get();
				$company = DB::table('jcm_companies');
		    	$company->orderBy('companyId','desc');
				$company->where('category','!=','');
		    	$company->limit(4);
		    	$companies = $company->inRandomOrder()->get();
    	    	$followArr = array();
    			if($request->session()->has('jcmUser')){
    				$meta = JobCallMe::getUserMeta($request->session()->get('jcmUser')->userId);
    				$savedJobArr = @explode(',', $meta->saved);
    				$followArr = @explode(',', $meta->follow);
    			}
				return view('frontend.jobseeker.userHome',compact('user','lear_record','companies','followArr'));
	}

	public function home(Request $request){
		if(!$request->session()->has('jcmUser')){
    		return redirect('account/login?next='.$request->route()->uri);
    	}
    	$app = $request->session()->get('jcmUser');
		$user = DB::table('jcm_users')->where('userId',$app->userId)->first();
		$meta = JobCallMe::getUserMeta($app->userId);
		$savedJobArr = @explode(',', $meta->saved);
		$followArr = @explode(',', $meta->follow);

		/* Saved Jobs*/
		$savedJobs = DB::table('jcm_jobs')->select('jcm_jobs.*','jcm_companies.companyName','jcm_companies.companyLogo')
						->join('jcm_companies','jcm_companies.companyId','=','jcm_jobs.companyId')
						->whereIn('jcm_jobs.jobId',$savedJobArr)
						->get();

		/* suggested jobs */
		$suggested = $this->suggestedJob($meta);
		/* job application */
		$application = $this->jobApplication();

		/* job interviews */
		$interview = $this->jobInterviews();

		/* companies */
		$company = DB::table('jcm_companies');
    	$company->orderBy('companyId','desc');
		$company->where('category','!=','');
    	$company->limit(4);
    	$companies = $company->inRandomOrder()->get();

    	$followArr = array();
		if($request->session()->has('jcmUser')){
			$meta = JobCallMe::getUserMeta($request->session()->get('jcmUser')->userId);
			$savedJobArr = @explode(',', $meta->saved);
			$followArr = @explode(',', $meta->follow);
		}
        $lear_record = DB::table('jcm_upskills')->orderBy('skillId','desc')->limit(6)->get();
	/* Related read */
		$readQry = DB::table('jcm_writings')->join('jcm_users','jcm_users.userId','=','jcm_writings.userId');
    	$readQry->leftJoin('jcm_categories','jcm_categories.categoryId','=','jcm_writings.category');
    	$readQry->select('jcm_writings.*','jcm_users.firstName','jcm_users.lastName','jcm_users.profilePhoto','jcm_categories.name');
    	if($request->input('category') != '0' && $request->input('category') != ''){
    		$readQry->where('jcm_writings.category','=',$request->input('category'));
    	}
    	if($request->input('keyword') != ''){
    		$readQry->where('jcm_writings.title','LIKE','%'.$request->input('keyword').'%');
    	}
      $readQry->orderBy('jcm_writings.writingId','desc')->groupBy('jcm_writings.title')->limit(6);
    	$read_record = $readQry->get();
		//dd($read_record );
		return view('frontend.jobseeker.dashboard',compact('user','savedJobs','savedJobArr','suggested','application','interview','companies','followArr','lear_record','read_record'));
	}

	public function suggestedJob($meta){
		$app = Session()->get('jcmUser');
		$country = $app->country;

		$jobs = DB::table('jcm_jobs')->select('jcm_jobs.*','jcm_companies.companyName','jcm_companies.companyLogo');
		$jobs->join('jcm_companies','jcm_jobs.companyId','=','jcm_companies.companyId');
		$jobs->where('jcm_jobs.country','=',$country);
		$jobs->where('jcm_jobs.amount','>=','1');
		$jobs->where('jcm_jobs.jobStatus','=','Publish');
		$jobs->where('jcm_jobs.status','=','1');
		$jobs->where('jcm_jobs.expiryDate','>=',date('Y-m-d'));
		if(count($meta) > 0){
			$jobs->where('jcm_jobs.category','=',$meta->industry);
		}
		$jobs->orderBy('jobId','desc')->limit(20);
		return $jobs->get();
	}

	public function jobApplication(){
		$app = Session()->get('jcmUser');

		$appl = DB::table('jcm_jobs')->select('jcm_jobs.*','jcm_companies.companyName','jcm_companies.companyLogo','jcm_job_applied.applyTime')
					->join('jcm_companies','jcm_companies.companyId','=','jcm_jobs.companyId')
					->join('jcm_job_applied','jcm_job_applied.jobId','=','jcm_jobs.jobId')
					->where('jcm_job_applied.userId','=',$app->userId)
					->orderBy('jcm_job_applied.applyId','desc')
					->get();

		return $appl;
	}

	public function jobInterviews(){
		$app = Session()->get('jcmUser');

		$appl = DB::table('jcm_jobs')->select('jcm_jobs.*','jcm_companies.companyName','jcm_companies.companyLogo','jcm_job_applied.applyTime')
					->join('jcm_companies','jcm_companies.companyId','=','jcm_jobs.companyId')
					->join('jcm_job_applied','jcm_job_applied.jobId','=','jcm_jobs.jobId')
					->where('jcm_job_applied.userId','=',$app->userId)
					->where('jcm_job_applied.applicationStatus','Interview')
					->orderBy('jcm_job_applied.applyId','desc')
					->get();

		return $appl;
	}

	public function resume(Request $request){
		if(!$request->session()->has('jcmUser')){
    		return redirect('account/login?next='.$request->route()->uri);
    	}
		$app = $request->session()->get('jcmUser');
		$user = DB::table('jcm_users')->where('userId',$app->userId)->first();
		$comments = DB::table('comments')->where('jobseeker_id',$app->userId)->where('table_name','resume')->get();
		$offers = DB::table('jcm_offer_interview')->where('jobseeker_id',$app->userId)->where('table_name','offer')->get();
		$totalReview = count($comments);
		$meta = DB::table('jcm_users_meta')->where('userId',$app->userId)->first();
		$resume = $this->userResume($app->userId);
		$privacy = JobCallMe::getprivacy($app->userId);
		//dd($user);exit;
		return view('frontend.jobseeker.resume',compact('offers','totalReview','comments','user','meta','resume','privacy'));
	}

	public function userResume($userId){
		$record = DB::table('jcm_resume')->where('userId','=',$userId)->orderBy('resumeId','asc')->get();
		$return = array();
		foreach($record as $rec){
			$return[$rec->type][$rec->resumeId] = @json_decode($rec->resumeData);
		}
		
		return $return;
	}

	public function getState(Request $request){
		if(!$request->ajax()){
			exit('Directory access is forbidden');
		}
		$countryId = $request->segment(3);
		$cities = JobCallMe::getJobStates($countryId);
		return view('frontend.jobseeker.stateCatView',compact('cities'));
		/*echo @json_encode($cities);*/
	}

	public function getCity(Request $request){
		if(!$request->ajax()){
			exit('Directory access is forbidden');
		}
		$stateId = $request->segment(3);
		/*$cities = JobCallMe::getJobCities($stateId);*/
		$cities2 = JobCallMe::getJobCities($stateId);
		return view('frontend.jobseeker.cityCatView',compact('cities2'));
		/*echo @json_encode($cities2);*/
	}

	public function getSubCategory(Request $request){
		if(!$request->ajax()){
			exit('Directory access is forbidden');
		}
		$categoryId = $request->segment(3);
		$result = JobCallMe::getSubCategories($categoryId);
		return view('frontend.jobseeker.subCatView',compact('result'));
		/*echo @json_encode($result);*/
	}

	public function getSubCategory2(Request $request){
		if(!$request->ajax()){
			exit('Directory access is forbidden');
		}
		$categoryId2 = $request->segment(3);
		$result2 = JobCallMe::getSubCategories2($categoryId2);
		return view('frontend.jobseeker.subCatView2',compact('result2'));
		/*echo @json_encode($result2);*/
	}

	public function savePersonalInfo(Request $request){
		if(!$request->ajax()){
			exit('Directory access is forbidden');
		}
		$app = $request->session()->get('jcmUser');
		$this->validate($request, [
				'firstName' => 'required|min:1|max:50',
				'lastName' => 'required|min:1|max:50',
				'fatherName' => 'required|min:1|max:50',
				'cnicNumber' => 'required|max:20',
				'gender' => 'required',
				'maritalStatus' => 'required',
				'dateOfBirth' => 'required|date',
				'email' => 'required|email',
				'phoneNumber' => 'required|max:20',
				'address' => 'required|max:255',
				'country' => 'required',
				'city' => 'required',
				'state' => 'required',
				'education' => 'required',
				'industry' => 'required',
				'experiance' => 'required',
				//'currentSalary' => 'required|numeric',
				//'expectedSalary' => 'required|numeric',
				'currency' => 'required',
				'expertise' => 'required',
				'about' => 'required',
				'facebook' => 'nullable|url',
				'linkedin' => 'nullable|url',
				'twitter' => 'nullable|url',
				'website' => 'nullable|url',
			]);

		extract(array_map('trim', $request->all()));

		$isUser = DB::table('jcm_users')->where('userId','=',$app->userId)->where('email','=',$email)->first();
		if(count($isUser) > 1){
			exit('User with give email already exist');
		}

		$userQry = array('firstName' => $firstName, 'lastName' => $lastName, 'email' => $email, 'phoneNumber' => $phoneNumber, 'country' => $country, 'state' => $state, 'city' => $city, 'about' => $about);
		DB::table('jcm_users')->where('userId',$app->userId)->update($userQry);

		$metaQry = array('fatherName' => $fatherName, 'dateOfBirth' => $dateOfBirth, 'gender' => $gender, 'maritalStatus' => $maritalStatus, 'experiance' => $experiance, 'education' => $education, 'industry' => $industry, 'subCategoryId' => $subCategoryId, 'subCategoryId2' => $subCategoryId2, 'shift' => $shift, 'currency' => $currency, 'currentSalary' => $currentSalary, 'expectedSalary' => $expectedSalary, 'expectedSalary2' => $expectedSalary2,  'cnicNumber' => $cnicNumber, 'address' => $address, 'address2' => $address2, 'expertise' => $expertise, 'facebook' => '', 'linkedin' => '', 'twitter' => '', 'website' => '');
		if($facebook != '') $metaQry['facebook'] = $facebook;
		if($linkedin != '') $metaQry['linkedin'] = $linkedin;
		if($twitter != '') $metaQry['twitter'] = $twitter;
		if($website != '') $metaQry['website'] = $website;

		if($metaId != '' && $metaId != '0' && $metaId != NULL){
			DB::table('jcm_users_meta')->where('metaId','=',$metaId)->update($metaQry);
		}else{
			$metaQry['follow'] = '';
			$metaQry['saved'] = '';
			$metaQry['userId'] = $app->userId;
			$metaQry['createdTime'] = date('Y-m-d H:i:s');
			DB::table('jcm_users_meta')->insert($metaQry);
		}
		exit('1');
	}

	public function saveAcademic(Request $request){
		if(!$request->ajax()){
			exit('Directory access is forbidden');
		}

		$app = $request->session()->get('jcmUser');
		$this->validate($request, [
				'degreeLevel' => 'required',				
				'completionDate' => 'required|date',				
				'institution' => 'required|max:150',
				'country' => 'required',
			]);
		extract(array_map('trim', $request->all()));
		if($request->file('academicfile') != ''){
			$image = $request->file('academicfile');

			$imagename = time().'.'.$image->getClientOriginalExtension();

			$destinationPath = public_path('/resume_images');

			$image->move($destinationPath, $imagename);
		}else{
			$imagename = $old_academicfile;
		}
	    
		$academicQry = array('academicfile'=>$imagename,'degreeLevel' => $degreeLevel, 'graduationstatus' => $graduationstatus, 'transferstatus' => $transferstatus, 'degree' => $degree, 'minor' => $minor, 'enterDate' => $enterDate,'completionDate' => $completionDate, 'grade' => $grade, 'grade2' => $grade2, 'institution' => $institution, 'country' => $country,'state' => $state,'city' => $city, 'details' => $details);

		$input = array('type' => 'academic', 'resumeData' => @json_encode($academicQry));

		if($resumeId != '' && $resumeId != '0' && $resumeId != NULL){
			DB::table('jcm_resume')->where('resumeId','=',$resumeId)->update($input);
		}else{
			$input['userId'] = $app->userId;
			$input['createdTime'] = date('Y-m-d H:i:s');
			DB::table('jcm_resume')->insert($input);
		}
		exit('1');
 	}

	public function getResume(Request $request){
		if(!$request->ajax()){
			exit('Directory access is forbidden');
		}
		$resumeId = $request->segment(5);
		$record = DB::table('jcm_resume')->select('resumeData')->where('resumeId','=',$resumeId)->first();
		echo $record->resumeData;
	}

	public function deleteResume(Request $request){
		if(!$request->ajax()){
			exit('Directory access is forbidden');
		}
		$resumeId = $request->segment(5);
		DB::table('jcm_resume')->where('resumeId','=',$resumeId)->delete();
	}

	public function saveCertification(Request $request){
		if(!$request->ajax()){
			exit('Directory access is forbidden');
		}
		$app = $request->session()->get('jcmUser');
		$this->validate($request, [
				'certificate' => 'required|max:100',
				'completionDate' => 'required|date',
				'score' => 'required|max:10',
				'institution' => 'required|max:150',
				//'country' => 'required'
			]);

		extract(array_map('trim', $request->all()));

		if($request->file('certificatefile') != ''){
			$image = $request->file('certificatefile');

			$imagename = time().'.'.$image->getClientOriginalExtension();

			$destinationPath = public_path('/resume_images');

			$image->move($destinationPath, $imagename);
		}else{
			$imagename = $old_certificatefile;
		}
		$certificationQry = array('certificatefile'=>$imagename,'certificate' => $certificate, 'completionDate' => $completionDate, 'score' => $score, 'institution' => $institution, 'country' => $country,'state' => $state,'city' => $city,  'details' => $details);

		$input = array('type' => 'certification', 'resumeData' => @json_encode($certificationQry));

		if($resumeId != '' && $resumeId != '0' && $resumeId != NULL){
			DB::table('jcm_resume')->where('resumeId','=',$resumeId)->update($input);
		}else{
			$input['userId'] = $app->userId;
			$input['createdTime'] = date('Y-m-d H:i:s');
			DB::table('jcm_resume')->insert($input);
		}
		exit('1');
	}

	public function saveExperience(Request $request){
		if(!$request->ajax()){
			exit('Directory access is forbidden');
		}
		$app = $request->session()->get('jcmUser');
		$this->validate($request, [
				'jobTitle' => 'required|max:255',
				//'organization' => 'required|max:255',
				'startDate' => 'required|date',
				'country' => 'required'
			]);

		extract(array_map('trim', $request->all()));
		if($request->file('experiencefile') != ''){
			$image = $request->file('experiencefile');

			$imagename = time().'.'.$image->getClientOriginalExtension();

			$destinationPath = public_path('/resume_images');

			$image->move($destinationPath, $imagename);
		}else{
			$imagename = $old_experiencefile;
		}
		if($currently != 'yes'){
			$this->validate($request, ['endDate' => 'required|date']);
			$currently = 'no';
		}

		$experienceQry = array('experiencefile'=>$imagename,'jobTitle' => $jobTitle, 'organization' => $organization, 'currently' => $currently, 'startDate' => $startDate, 'expptitle' => $expptitle, 'reasonleaving' => $reasonleaving, 'expposition' => $expposition, 'responsibilities' => $responsibilities, 'country' => $country,'state' => $state,'city' => $city, 'details' => $details);
		if($currently == 'no'){
			$experienceQry['endDate'] = $endDate;
		}

		$input = array('type' => 'experience', 'resumeData' => @json_encode($experienceQry));

		if($resumeId != '' && $resumeId != '0' && $resumeId != NULL){
			DB::table('jcm_resume')->where('resumeId','=',$resumeId)->update($input);
		}else{
			$input['userId'] = $app->userId;
			$input['createdTime'] = date('Y-m-d H:i:s');
			DB::table('jcm_resume')->insert($input);
		}
		exit('1');
	}

	public function saveSkills(Request $request){
		if(!$request->ajax()){
			exit('Directory access is forbidden');
		}
		$app = $request->session()->get('jcmUser');
		$this->validate($request, [
				'skill' => 'required|max:255',
				'level' => 'required'
			]);

		extract(array_map('trim', $request->all()));

		$skillsQry = array('skill' => $skill, 'level' => $level);

		$input = array('type' => 'skills', 'resumeData' => @json_encode($skillsQry));

		if($resumeId != '' && $resumeId != '0' && $resumeId != NULL){
			DB::table('jcm_resume')->where('resumeId','=',$resumeId)->update($input);
		}else{
			$input['userId'] = $app->userId;
			$input['createdTime'] = date('Y-m-d H:i:s');
			DB::table('jcm_resume')->insert($input);
		}
		exit('1');
	}
	
	public function saverefer(Request $request){
		if(!$request->ajax()){
			exit('Directory access is forbidden');
		}
		$app = $request->session()->get('jcmUser');
		$this->validate($request, [
				'name' => 'required|max:255',
				'phone' => 'required'
			]);
 
		extract(array_map('trim', $request->all()));

		$skillsQry = array('name' => $name, 'jobtitle' => $jobtitle, 'organization' => $organization, 'phone' => $phone, 'email' => $email, 'country' => $country,'state' => $state,'city' => $city,'type' => $type);

		$input = array('type' => 'reference', 'resumeData' => @json_encode($skillsQry));

		if($resumeId != '' && $resumeId != '0' && $resumeId != NULL){
			DB::table('jcm_resume')->where('resumeId','=',$resumeId)->update($input);
		}else{
			$input['userId'] = $app->userId;
			$input['createdTime'] = date('Y-m-d H:i:s');
			DB::table('jcm_resume')->insert($input);
		}
		exit('1');
	}
	
	public function savepublish(Request $request){
		if(!$request->ajax()){
			exit('Directory access is forbidden');
		}
		$app = $request->session()->get('jcmUser');
		$this->validate($request, [
				'pu_type' => 'required|max:255',
				'title' => 'required'
			]);

		extract(array_map('trim', $request->all()));
		if($request->file('publicationfile') != ''){
			$image = $request->file('publicationfile');

			$imagename = time().'.'.$image->getClientOriginalExtension();

			$destinationPath = public_path('/resume_images');

			$image->move($destinationPath, $imagename);
		}else{
			$imagename = $old_publicationfile;
		}
		$skillsQry = array('publicationfile'=>$imagename,'pu_type' => $pu_type, 'title' => $title, 'author' => $author, 'publisher' => $publisher, 'year' => $year, 'month' => $month, 'country' => $country,'state' => $state,'city' => $city, 'detail' => $detail);

		$input = array('type' => 'publish', 'resumeData' => @json_encode($skillsQry));

		if($resumeId != '' && $resumeId != '0' && $resumeId != NULL){
			DB::table('jcm_resume')->where('resumeId','=',$resumeId)->update($input);
		}else{
			$input['userId'] = $app->userId;
			$input['createdTime'] = date('Y-m-d H:i:s');
			DB::table('jcm_resume')->insert($input);
		}
		exit('1');
	}
	
	public function saveproject(Request $request){
		if(!$request->ajax()){
			exit('Directory access is forbidden');
		}
		$app = $request->session()->get('jcmUser');
		$this->validate($request, [
				'type' => 'required|max:255',
				'title' => 'required'
			]);

		extract(array_map('trim', $request->all()));
		if($request->file('projectfile') != ''){
			$image = $request->file('projectfile');

			$imagename = time().'.'.$image->getClientOriginalExtension();

			$destinationPath = public_path('/resume_images');

			$image->move($destinationPath, $imagename);
		}else{
			$imagename = $old_projectfile;
		}
		$skillsQry = array('projectfile'=>$imagename,'title' => $title, 'position' => $position, 'type' => $type, 'occupation' => $occupation, 'organization' => $organization, 'startyear' => $startyear, 'startmonth' => $startmonth,'currently' => $currently,'detail' => $detail);
            if($currently == 'no'){
			    $skillsQry['endyear'] = $endyear;
				$skillsQry['endmonth'] = $endmonth;
	        	}
		$input = array('type' => 'project', 'resumeData' => @json_encode($skillsQry));

		if($resumeId != '' && $resumeId != '0' && $resumeId != NULL){
			DB::table('jcm_resume')->where('resumeId','=',$resumeId)->update($input);
		}else{
			$input['userId'] = $app->userId;
			$input['createdTime'] = date('Y-m-d H:i:s');
			DB::table('jcm_resume')->insert($input);
		}
		exit('1');
	}
	//Affilation
	public function saveaffiliation(Request $request){
		if(!$request->ajax()){
			exit('Directory access is forbidden');
		}
		$app = $request->session()->get('jcmUser');
		$this->validate($request, [
				'pos' => 'required|max:255',
				'org' => 'required'
			]);

		extract(array_map('trim', $request->all()));

		if($currently != 'yes'){
			$this->validate($request, ['enyear' => 'required']);
			$this->validate($request, ['enmonth' => 'required']);
			$currently = 'no';
		}

		if($request->file('affiliationfile') != ''){
			$image = $request->file('affiliationfile');

			$imagename = time().'.'.$image->getClientOriginalExtension();

			$destinationPath = public_path('/resume_images');

			$image->move($destinationPath, $imagename);
		}else{
			$imagename = $old_affiliationfile;
		}
		$skillsQry = array('affiliationfile'=>$imagename,'org' => $org,'pos' => $pos,'stayear' => $stayear, 'stamonth' => $stamonth,'enyear' => $enyear, 'enmonth' => $enmonth, 'currently' => $currently, 'country' => $country, 'state' => $state, 'city' => $city);

		$input = array('type' => 'affiliation', 'resumeData' => @json_encode($skillsQry));

		if($resumeId != '' && $resumeId != '0' && $resumeId != NULL){
			DB::table('jcm_resume')->where('resumeId','=',$resumeId)->update($input);
		}else{
			$input['userId'] = $app->userId;
			$input['createdTime'] = date('Y-m-d H:i:s');
			DB::table('jcm_resume')->insert($input);
		}
		exit('1');
	}
	//
	
	public function savelanguage(Request $request){
		if(!$request->ajax()){
			exit('Directory access is forbidden');
		}
		$app = $request->session()->get('jcmUser');
		$this->validate($request, [
				'language' => 'required|max:255',
				'level' => 'required'
			]);

		extract(array_map('trim', $request->all()));

		if($request->file('languagefile') != ''){
			$image = $request->file('languagefile');

			$imagename = time().'.'.$image->getClientOriginalExtension();

			$destinationPath = public_path('/resume_images');

			$image->move($destinationPath, $imagename);
		}else{
			$imagename = $old_languagefile;
		}

		$skillsQry = array('languagefile'=>$imagename,'language' => $language, 'level' => $level, 'certifiedexam' => $certifiedexam, 'classscore' => $classscore, 'languageyear' => $languageyear, 'languagemonth' => $languagemonth);

		$input = array('type' => 'language', 'resumeData' => @json_encode($skillsQry));

		if($resumeId != '' && $resumeId != '0' && $resumeId != NULL){
			DB::table('jcm_resume')->where('resumeId','=',$resumeId)->update($input);
		}else{
			$input['userId'] = $app->userId;
			$input['createdTime'] = date('Y-m-d H:i:s');
			DB::table('jcm_resume')->insert($input);
		}
		exit('1');
	}

	public function savepreference(Request $request){
		if(!$request->ajax()){
			exit('Directory access is forbidden');
		}
		$app = $request->session()->get('jcmUser');
		$this->validate($request, [
				'veteran' => 'required|max:255',
				'jobprotection' => 'required'
			]);


			//if($request->hasFile('references_file')){
                //$this->validate($request, [
                    //'references_file' => 'required|image|mimes:jpeg,png,jpg|max:2048',
                //]);
            //}
            //if($request->hasFile('references_file')){
                //$image = $request->file('references_file');

                //$references_file = 'references-'.time().'-'.rand(000000,999999).'.'.$image->getClientOriginalExtension();
				//$references_file_name = $references_file;
                //$destinationPath = public_path('/resume-images');
                //$image->move($destinationPath, $references_file);

                //if($request->input('prevreferences') != ''){
                    //@unlink(public_path('/resume-images/'.$request->input('prevreferences')));
                //}
            //}


		extract(array_map('trim', $request->all()));

		$skillsQry = array('veteran' => $veteran,'jobprotection' => $jobprotection, 'subsidy' => $subsidy, 'disability' => $disability, 'disabilitygrade' => $disabilitygrade, 'militaryservice' => $militaryservice, 'militarystartyear' => $militarystartyear, 'militarystartmonth' => $militarystartmonth, 'militaryendyear' => $militaryendyear, 'militaryendmonth' => $militaryendmonth, 'militarytype' => $militarytype, 'militaryclasses' => $militaryclasses);

		$input = array('type' => 'preference', 'resumeData' => @json_encode($skillsQry));

		if($resumeId != '' && $resumeId != '0' && $resumeId != NULL){
			DB::table('jcm_resume')->where('resumeId','=',$resumeId)->update($input);
		}else{
			$input['userId'] = $app->userId;
			$input['createdTime'] = date('Y-m-d H:i:s');
			
			DB::table('jcm_resume')->insert($input);
		}
		exit('1');
	}
	
	public function saveaward(Request $request){
		if(!$request->ajax()){
			exit('Directory access is forbidden');
		}
		$app = $request->session()->get('jcmUser');
		$this->validate($request, [
				//'type' => 'required|max:255',
				'title' => 'required'
			]);

		extract(array_map('trim', $request->all()));
		if($request->file('awardfile') != ''){
			$image = $request->file('awardfile');

			$imagename = time().'.'.$image->getClientOriginalExtension();

			$destinationPath = public_path('/resume_images');

			$image->move($destinationPath, $imagename);
		}else{
			$imagename = $old_awardfile;
		}

		$skillsQry = array('awardfile'=>$imagename,'title' => $title,'type' => $type, 'occupation' => $occupation, 'organization' => $organization, 'startyear' => $startyear, 'startmonth' => $startmonth, 'detail' => $detail);

		$input = array('type' => 'award', 'resumeData' => @json_encode($skillsQry));

		if($resumeId != '' && $resumeId != '0' && $resumeId != NULL){
			DB::table('jcm_resume')->where('resumeId','=',$resumeId)->update($input);
		}else{
			$input['userId'] = $app->userId;
			$input['createdTime'] = date('Y-m-d H:i:s');
			DB::table('jcm_resume')->insert($input);
		}
		exit('1');
	}
	
		public function saveportfolio(Request $request){
		if(!$request->ajax()){
			exit('Directory access is forbidden');
		}
		$app = $request->session()->get('jcmUser');
		$this->validate($request, [
				'type' => 'required|max:255',
				'title' => 'required'
			]);

		extract(array_map('trim', $request->all()));
		if($request->file('portfoliofile') != ''){
			$image = $request->file('portfoliofile');

			$imagename = time().'.'.$image->getClientOriginalExtension();

			$destinationPath = public_path('/resume_images');

			$image->move($destinationPath, $imagename);
		}else{
			$imagename = $old_portfoliofile;
		}
		$skillsQry = array('portfoliofile'=>$imagename,'title' => $title,'type' => $type, 'occupation' => $occupation, 'startyear' => $startyear, 'startmonth' => $startmonth, 'website' => $website, 'detail' => $detail);

		$input = array('type' => 'portfolio', 'resumeData' => @json_encode($skillsQry));

		if($resumeId != '' && $resumeId != '0' && $resumeId != NULL){
			DB::table('jcm_resume')->where('resumeId','=',$resumeId)->update($input);
		}else{
			$input['userId'] = $app->userId;
			$input['createdTime'] = date('Y-m-d H:i:s');
			DB::table('jcm_resume')->insert($input);
		}
		exit('1');
	}

	public function savehopeworking(Request $request){
		if(!$request->ajax()){
			exit('Directory access is forbidden');
		}
		$app = $request->session()->get('jcmUser');
		$this->validate($request, [
				'hopejobtype' => 'required|max:255',
				'country' => 'required'
			]);

		extract(array_map('trim', $request->all()));

		$skillsQry = array('hopejobtype' => $hopejobtype,'country' => $country, 'state' => $state, 'city' => $city);

		$input = array('type' => 'hopeworking', 'resumeData' => @json_encode($skillsQry));

		if($resumeId != '' && $resumeId != '0' && $resumeId != NULL){
			DB::table('jcm_resume')->where('resumeId','=',$resumeId)->update($input);
		}else{
			$input['userId'] = $app->userId;
			$input['createdTime'] = date('Y-m-d H:i:s');
			DB::table('jcm_resume')->insert($input);
		}
		exit('1');
	}


	public function savePassword(Request $request){
		if(!$request->ajax()){
			exit('Directory access is forbidden');
		}
		$app = $request->session()->get('jcmUser');
		$this->validate($request, [
				'oldPassword' => 'required|max:16',
				'password' => 'required|min:6|max:16|confirmed',
				'password_confirmation' => 'required|min:6|max:16',
			]);

		extract(array_map('trim', $request->all()));

		$isUser = DB::table('jcm_users')->where('userId','=',$app->userId)->where('password','=',md5($oldPassword))->first();
		if(count($isUser) == 0){
			exit('Exisitng password is not valid');
		}

		$input = array('password' => md5($password));
		DB::table('jcm_users')->where('userId','=',$app->userId)->update($input);
		exit('1');
	}

	public function saveProfile(Request $request){
		if(!$request->ajax()){
			exit('Directory access is forbidden');
		}
		$app = $request->session()->get('jcmUser');
		//dd($request->all());
		$this->validate($request, [
				'firstName' => 'required|max:50',
				'lastName' => 'required|max:50',
				'email' => 'required|max:255|email',
				'phoneNumber' => 'required',
				'city' => 'required',
				'state' => 'required',
				'address' => 'required',
			]);

		extract(array_map('trim', $request->all()));



		$isUser = DB::table('jcm_users')->where('userId','<>',$app->userId)->where('email','=',$email)->first();
		if(count($isUser) > 0){
			exit('Email alrady exist');
		}



		$input = array('firstName' => $firstName, 'lastName' => $lastName, 'email' => $email, 'phoneNumber' => $phoneNumber, 'city' => $city, 'state' => $state, 'country' => $country);

		//dd($input);

		DB::table('jcm_users')->where('userId','=',$app->userId)->update($input);


		if(count(JobCallMe::getUserMeta($app->userId)) > 0){
			DB::table('jcm_users_meta')->where('userId','=',$app->userId)->update(array('address' => $address));
		}else{
			$input = array('userId' => $app->userId, 'address' => $address, 'createdTime' => date('Y-m-d H:i:s'));
			DB::table('jcm_users_meta')->insert($input);
		}
		exit('1');
	}

	public function profilePicture(Request $request){
		if(!$request->ajax()){
			exit('Directory access is forbidden');
		}
		$app = $request->session()->get('jcmUser');
		if($request->file('profilePicture') != ''){

		$fName = $_FILES['profilePicture']['name'];
		$ext = @end(@explode('.', $fName));
		if(!in_array(strtolower($ext), array('png','jpg','jpeg'))){
			exit('1');
		}

		$user = DB::table('jcm_users')->where('userId',$app->userId)->first();
		
		$image = $request->file('profilePicture');
		$profilePicture = 'profile-'.time().'-'.rand(000000,999999).'.'.$image->getClientOriginalExtension();       
        $destinationPath = public_path('/profile-photos');
        $image->move($destinationPath, $profilePicture);

        }
        if($request->input('chat') == 'yes'){
        	$pImage = '';
        	$data = array();
        	if($user->chatImage != ''){
        		$pImage = $user->chatImage;
        	}
        	if($pImage != ''){
        	    @unlink(public_path('/profile-photos/'.$pImage));
        	}
        	if($request->input('nickName') != ''){
        		$data['nickName'] = $request->input('nickName');
        	}
        	if($request->file('profilePicture') != ''){
        		$data['chatImage'] = $profilePicture;
        	}
        	DB::table('jcm_users')->where('userId',$app->userId)->update($data);
        	if($request->file('profilePicture') != ''){
        		echo url('profile-photos/'.$profilePicture);
        	}else{
        		echo 'noUrl';
        	}
        	
        }else{
        	$pImage = '';
        	if($user->profilePhoto != ''){
        		$pImage = $user->profilePhoto;
        	}
        	if($pImage != ''){
        	    @unlink(public_path('/profile-photos/'.$pImage));
        	}
        	DB::table('jcm_users')->where('userId',$app->userId)->update(array('profilePhoto' => $profilePicture));
        	echo url('profile-photos/'.$profilePicture);
        }
        
	}

	public function jobAction(Request $request){
		if(!$request->ajax()){
			exit('Directory access is forbidden');
		}
		$app = $request->session()->get('jcmUser');
		$jobId = $request->input('jobId');
		$type = $request->input('type');

		if(!$request->session()->has('jcmUser')){
    		exit('redirect');
    	}
    	
    	$meta = JobCallMe::getUserMeta($app->userId);
    	if(count($meta) > 0){
    		$savedJobs = array();
    		if($meta->saved != ''){
    			$savedJobs = @explode(',', $meta->saved);
    		}
    		$savedJobs = JobCallMe::doArrayAction($type,$jobId,$savedJobs);
    		$input['saved'] = @implode(',', $savedJobs);
    		DB::table('jcm_users_meta')->where('metaId','=',$meta->metaId)->update($input);
    	}else{
    		$savedJobs = array($jobId);
    		$input = array('userId' => $app->userId, 'saved' => @implode(',', $savedJobs), 'createdTime' => date('Y-m-d H:i:s'), 'fatherName' => '', 'dateOfBirth' => '1979-12-31', 'gender' => '', 'maritalStatus' => '', 'experiance' => '', 'education' => '', 'industry' => '0', 'currentSalary' => '', 'expectedSalary' => '', 'currency' => '', 'cnicNumber' => '', 'address' => '', 'expertise' => '', 'facebook' => '', 'linkedIn' => '', 'twitter' => '', 'website' => '', 'follow' => '');
    		DB::table('jcm_users_meta')->insert($input);
    	}
    	exit('done');
	}

	public function followAction(Request $request){
		if(!$request->ajax()){
			exit('Directory access is forbidden');
		}
		$app = $request->session()->get('jcmUser');
		$companyId = $request->input('companyId');
		$type = $request->input('type');

		if(!$request->session()->has('jcmUser')){
    		exit('redirect');
    	}
    	
    	$meta = JobCallMe::getUserMeta($app->userId);
    	if(count($meta) > 0){
    		$followArr = array();
    		if($meta->follow != ''){
    			$followArr = @explode(',', $meta->follow);
    		}
    		$followArr = JobCallMe::doArrayAction($type,$companyId,$followArr);
    		$input['follow'] = @implode(',', $followArr);
    		DB::table('jcm_users_meta')->where('metaId','=',$meta->metaId)->update($input);
    	}else{
    		$followArr = array($companyId);
    		$input = array('userId' => $app->userId, 'follow' => @implode(',', $followArr), 'createdTime' => date('Y-m-d H:i:s'), 'fatherName' => '', 'dateOfBirth' => '1979-12-31', 'gender' => '', 'maritalStatus' => '', 'experiance' => '', 'education' => '', 'industry' => '0', 'currentSalary' => '', 'expectedSalary' => '', 'currency' => '', 'cnicNumber' => '', 'address' => '', 'expertise' => '', 'facebook' => '', 'linkedIn' => '', 'twitter' => '', 'website' => '', 'saved' => '');
    		DB::table('jcm_users_meta')->insert($input);
    	}
    	exit('done');
	}

	public function application(Request $request){
		if(!$request->session()->has('jcmUser')){
    		return redirect('account/login?next='.$request->route()->uri);
    	}

		$app = $request->session()->get('jcmUser');
		$user_name = $app->firstName.' '.$app->lastName;

		return view('frontend.jobseeker.view-application',compact('user_name'));
	}

	public function getApplication(Request $request){
		if(!$request->ajax()){
			exit('Directory access is forbidden');
		}
		$app = $request->session()->get('jcmUser');
		$type = $request->segment(4);

		switch ($type) {
			case 'delivered':
				$record = DB::table('jcm_job_applied')
					->select('jcm_jobs.title','jcm_job_applied.applyId','jcm_job_applied.applyTime','jcm_job_applied.jobId','jcm_users.*','jcm_users_meta.*','jcm_jobs.companyId')
					->join('jcm_users','jcm_users.userId','=','jcm_job_applied.userId')
					->join('jcm_users_meta','jcm_users_meta.userId','=','jcm_job_applied.userId')
					->join('jcm_jobs','jcm_jobs.jobId','=','jcm_job_applied.jobId')
					->where('jcm_job_applied.userId','=',$app->userId)
					->orderBy('jcm_job_applied.applyId','desc')
					->get();
			break;
			
			default:
				$record = DB::table('jcm_job_applied')
					->select('jcm_jobs.title','jcm_job_applied.applyId','jcm_job_applied.applyTime','jcm_job_applied.jobId','jcm_users.*','jcm_users_meta.*','jcm_jobs.companyId')
					->join('jcm_users','jcm_users.userId','=','jcm_job_applied.userId')
					->join('jcm_users_meta','jcm_users_meta.userId','=','jcm_job_applied.userId')
					->join('jcm_jobs','jcm_jobs.jobId','=','jcm_job_applied.jobId')
					->where('jcm_job_applied.userId','=',$app->userId)
					->where('jcm_job_applied.applicationStatus','=',ucfirst($type))
					->orderBy('jcm_job_applied.applyId','desc')
					->get();
		}
		

		if(count($record) > 0){
			$appType = $type;
			if($appType == 'reject') $appType = 'unsuccessful';
			$vhtml  = '<ul>';


			switch ($type) {
				case 'shortlist':
					$fontIcon = 'thumbs-o-up';
				break;

				case 'interview':
					$fontIcon = 'car';
				break;

				case 'offer':
					$fontIcon = 'thumbs-up';
				break;

				case 'reject':
					$fontIcon = 'thumbs-down';
				break;
				
				default:
					$fontIcon = 'check';
				break;
			}
			foreach($record as $rec){
				$company = JobCallMe::getCompany($rec->companyId);
				$companyPhoto = url('compnay-logo/'.$company->companyLogo);

				$vhtml .= '<li id="apply-'.$rec->applyId.'">';
					$vhtml .= '<span class="ja-applyDate">'.date('M d, Y',strtotime($rec->applyTime)).' <a href="javascript:;" class="application-remove" title="Remove/Cancel Application" onclick="removeApplication('.$rec->applyId.')">&times;</a></span>';
					$vhtml .= '<img src="'.$companyPhoto.'" class="ja-item-img">';
					$vhtml .= '<div class="ja-item-details">';
						$vhtml .= '<p class="ja-item-title"><a href="'.url('jobs/'.$rec->jobId).'" >'.$rec->title.'</a></p>';
						$vhtml .= '<p class="ja-item-organization">'.$company->companyName.'</p>';
						if($type == 'interview'){
							$getInterview = JobCallMe::getJobInterview($rec->jobId,$rec->userId);
							$interviewUrl = url('account/jobseeker/interview/'.$getInterview->interviewId);
							$vhtml .= '<p class="ja-item-status"><a href="'.$interviewUrl.'"><i class="fa fa-'.$fontIcon.'"></i> '.trans('home.'.ucfirst($appType)).'</a></p>';
						}else{
							$vhtml .= '<p class="ja-item-status"><i class="fa fa-'.$fontIcon.'"></i> '.ucfirst($appType).'</p>';
						}
					$vhtml .= '</div>';
				$vhtml .= '</li>';
			}
			$vhtml .= '</ul>';
		}else{
			$vhtml = '<div class="col-md-12 ea-no-record">No records found.</div>';
		}
		echo $vhtml;
	}

	public function removeApplication(Request $request){
		if(!$request->ajax()){
			exit('Directory access is forbidden');
		}
		$applyId = $request->segment(5);
		//echo $applyId;

		DB::table('jcm_job_applied')->where('applyId','=',$applyId)->delete();
	}

	public function showInterview(Request $request, $interviewId){
		$app = $request->session()->get('jcmUser');
		/* get interview */
		$interview = DB::table('jcm_job_interviews')
						->select('jcm_job_interviews.*','jcm_jobs.title')
						->join('jcm_jobs','jcm_jobs.jobId','=','jcm_job_interviews.jobId')
						->where('jcm_job_interviews.interviewId','=',$interviewId)
						->where('jcm_job_interviews.jobseekerId','=',$app->userId)
						->first();
		/* end */

		if(count($interview) != 1){
			return redirect('account/jobseeker/application');
		}
		return view('frontend.jobseeker.view-interview',compact('interview'));
	}
	public function convertpdf(Request $request){
		$app = $request->session()->get('jcmUser');
		
		$user = DB::table('jcm_users')->where('userId',$app->userId)->first();
		$name= $user->firstName;
		//return $name;
		$meta = DB::table('jcm_users_meta')->where('userId',$app->userId)->first();
		$resume = $this->userResume($app->userId);
		//dd($resume);
		
	//return view('frontend.jobseeker.resume');
    	 $pdf = PDF::loadView('frontend.cv',compact('user','meta','resume'));
		 //$pdf->SetFont('Courier', 'B', 18);
        return $pdf->download($name.'_cv.pdf');
		   //return view('frontend.cv',compact('user','meta','resume'));
	}
	
		public function convertpdffile(Request $request, $id){
		$app = $request->session()->get('jcmUser');
		
		
	}
	public function removeProPic(Request $request){
		 $id = $request->input('userId');
		if($request->input('chat') == 'yes'){
			DB::table('jcm_users')->where('userId',$id)->update(['chatImage'=>'']);
			echo 1;
		}else{
			DB::table('jcm_users')->where('userId',$id)->update(['profilePhoto'=>'']);
			echo 1;
		}
		
	}

	public function resume_pckg(Request $request, $id){

		$app = $request->session()->get('jcmUser');
		$userid = $request->session()->get('jcmUser')->userId;
		$plan = DB::table('jcm_save_packeges')->where('user_id',$userid)->where('quantity','>','0')->where('duration','=','0')->where('status','=','1')->where('type','=','Resume Download')->get();
		//dd($plan);
		$pckg_id= $plan[0]->id;
		$pckgs_id= $plan[0]->pckg_id;
		$quantity= $plan[0]->quantity;
		$remain = $quantity - 1;
		$inputs['quantity']=$remain;
		$input['emp_id']=$userid;
		$input['pckg_id']=$pckgs_id;
		$input['seeker_id']=$id;
			if(count($plan) == 0)
			{
				return redirect('account/manage?plan');
			}
				else{
                    DB::table('jcm_download')->insert($input);
                    DB::table('jcm_save_packeges')->where('user_id','=',$app->userId)->where('id','=',$pckg_id)->update($inputs);
					$user = DB::table('jcm_users')->where('userId',$id)->first();
					$name= $user->firstName;
						
					$meta = DB::table('jcm_users_meta')->where('userId',$id)->first();
					$resume = $this->userResume($id);
				
					$pdf = PDF::loadView('frontend.cv',compact('user','meta','resume'));
					return $pdf->download($name.'_cv.pdf');
				}
				
		}
		public function downloadmulticv(Request $request){
			$ids = $request->input('id_array');
			$array=count($ids);
			//dd($array);
				$app = $request->session()->get('jcmUser');
		$userid = $request->session()->get('jcmUser')->userId;
		$plan = DB::table('jcm_save_packeges')->where('user_id',$userid)->where('quantity','>','0')->where('duration','=','0')->where('status','=','1')->where('type','=','Resume Download')->get();
		//dd($plan);
		$pckg_id= $plan[0]->id;
		$pckgs_id= $plan[0]->pckg_id;
		$quantity= $plan[0]->quantity;
		$remain = $quantity - $array;
		$inputs['quantity']=$remain;
		
			if(count($plan) == 0)
			  {
				return redirect('account/manage?plan');
				//exit();
			  }
			else{

					DB::table('jcm_save_packeges')->where('user_id','=',$app->userId)->where('id','=',$pckg_id)->update($inputs);
					$dirname = rand();
					mkdir("resumefiles/".$dirname);
					foreach ($ids as $id) {
						$input['emp_id']=$userid;
						$input['pckg_id']=$pckgs_id;
						$input['seeker_id']=$id;
						 DB::table('jcm_download')->insert($input);
						$user = DB::table('jcm_users')->where('userId',$id)->first();
						$name= $user->firstName.rand(0,20);
							
						$meta = DB::table('jcm_users_meta')->where('userId',$id)->first();
						$resume = $this->userResume($id);
						$pdf = PDF::loadView('frontend.cv',compact('user','meta','resume'));
						
						file_put_contents("resumefiles/".$dirname."/".$name.".pdf", $pdf->output());
						}
					$files = glob("resumefiles/".$dirname.'/*');
					Zipper::make('resumeZip/'.$dirname.'/'.$dirname.'.zip')->add($files)->close();
					echo 'resumeZip/'.$dirname.'/'.$dirname.'.zip';
		        }
		}
		public function deletedownloadedcv(Request $request){
			$dirname = $request->input('dir');
			$success = File::deleteDirectory("resumefiles/".$dirname);
			echo $success = File::deleteDirectory("resumeZip/".$dirname);
		}
		
}
