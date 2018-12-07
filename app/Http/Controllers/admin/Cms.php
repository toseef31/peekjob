<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Facade\JobCallMe;
use DB;
use App\UpskillType;

class Cms extends Controller{
    
    public function viewCategories(Request $request){
    	$startI = $request->input('page',1);
    	$startI = ($startI - 1) * 25;
    	if($request->isMethod('post')){
    		$request->session()->put('categorySearch',$request->all());
    	}

    	if($request->input('reset') && $request->input('reset') == 'true'){
    		$request->session()->forget('categorySearch');
    		return redirect('admin/cms/category');
    	}

    	/* category query*/
        $s_app = $request->session()->get('categorySearch');
    	$categories = DB::table('jcm_categories')
                    ->where(function ($query) use ($s_app) {
                        if(count($s_app) > 0){
                            if($s_app['search'] != ''){
                                $query->where('name', 'like', '%'.$s_app['search'].'%');
                            }
                        }
                    })->orderBy('categoryId','desc')->paginate(25);
    	/* end */
    	return view('admin.cms.categories',compact('categories','startI'));
    }

    public function saveCategory(Request $request){
    	if(!$request->ajax()){
    		exit('Directory access is forbidden');
    	}
		$categoryId = trim($request->input('categoryId'));
		$name = trim($request->input('name'));

		if($name == ''){
			exit('Please enter category name.');
		}
		$cat = DB::table('jcm_categories')->where('name','=',$name)->where('categoryId','<>',$categoryId)->first();
		if(count($cat) > 0){
			exit('Category with name <b>'.$name.'</b> already exist.');
		}

		$input = array('name' => $name, 'modifiedTime' => date('Y-m-d H:i:s'));
		if($categoryId != '0'){
			DB::table('jcm_categories')->where('categoryId','=',$categoryId)->update($input);
			$sMsg = 'Category Updated';
		}else{
			$input['createdTime'] = date('Y-m-d H:i:s');
			DB::table('jcm_categories')->insert($input);
			$sMsg = 'New Category Added';
		}
		$request->session()->flash('alert',['message' => $sMsg, 'type' => 'success']);
		exit('1');
    }

    public function getCategory(Request $request){
    	if(!$request->ajax()){
    		exit('Directory access is forbidden');
    	}
    	$categoryId = $request->segment(5);
    	$cat = DB::table('jcm_categories')->where('categoryId',$categoryId)->first();
    	echo @json_encode($cat);
    }

    public function deleteCategory(Request $request){
    	if($request->isMethod('delete')){
            $categoryId = trim($request->input('categoryId'));
            
            DB::table('jcm_sub_categories')->where('categoryId',$categoryId)->delete();
            DB::table('jcm_categories')->where('categoryId',$categoryId)->delete();
            $request->session()->flash('alert',['message' => 'Category Deleted','type' => 'success']);
        }
        return redirect(url()->previous());
    }

    public function viewSubCategories(Request $request){
    	$categoryId = $request->segment(4);
    	$cat = DB::table('jcm_categories')->where('categoryId',$categoryId)->first();
    	if(count($cat) == 0){
    		$request->session()->flash('alert',['message' => 'No Record Found', 'type' => 'danger']);
            return redirect('admin/cms/category');
    	}

    	$startI = $request->input('page',1);
    	$startI = ($startI - 1) * 25;
    	if($request->isMethod('post')){
    		$request->session()->put('subcategorySearch',$request->all());
    	}

    	if($request->input('reset') && $request->input('reset') == 'true'){
    		$request->session()->forget('subcategorySearch');
    		return redirect('admin/cms/category/'.$categoryId);
    	}

    	/* category query*/
        $s_app = $request->session()->get('subcategorySearch');
    	$subCategories = DB::table('jcm_sub_categories')
    				->where('categoryId','=',$categoryId)
                    ->where(function ($query) use ($s_app) {
                        if(count($s_app) > 0){
                            if($s_app['search'] != ''){
                                $query->where('subName', 'like', '%'.$s_app['search'].'%');
                            }
                        }
                    })->orderBy('subCategoryId','desc')->paginate(25);
    	/* end */
    	return view('admin.cms.sub-categories',compact('subCategories','cat','startI'));
    }

    public function saveSubCategory(Request $request){
    	if(!$request->ajax()){
    		exit('Directory access is forbidden');
    	}
		$categoryId = trim($request->input('categoryId'));
		$subCategoryId = trim($request->input('subCategoryId'));
		$name = trim($request->input('name'));

		if($name == ''){
			exit('Please enter sub category name.');
		}
		$cat = DB::table('jcm_sub_categories')->where('subName','=',$name)->where('categoryId','=',$categoryId)->where('subCategoryId','<>',$subCategoryId)->first();
		if(count($cat) > 0){
			exit('Sub Category with name <b>'.$name.'</b> already exist.');
		}

		$input = array('categoryId' => $categoryId, 'subName' => $name, 'modifiedTime' => date('Y-m-d H:i:s'));
		if($subCategoryId != '0'){
			DB::table('jcm_sub_categories')->where('subCategoryId','=',$subCategoryId)->update($input);
			$sMsg = 'Sub Category Updated';
		}else{
			$input['createdTime'] = date('Y-m-d H:i:s');
			DB::table('jcm_sub_categories')->insert($input);
			$sMsg = 'New Sub Category Added';
		}
		$request->session()->flash('alert',['message' => $sMsg, 'type' => 'success']);
		exit('1');
    }

    public function getSubCategory(Request $request){
    	if(!$request->ajax()){
    		exit('Directory access is forbidden');
    	}
    	$subCategoryId = $request->segment(5);
    	$cat = DB::table('jcm_sub_categories')->where('subCategoryId',$subCategoryId)->first();
    	echo @json_encode($cat);
    }

    public function deleteSubCategory(Request $request){
    	if($request->isMethod('delete')){
            $subCategoryId = trim($request->input('subCategoryId'));
            
            DB::table('jcm_sub_categories')->where('subCategoryId',$subCategoryId)->delete();
            $request->session()->flash('alert',['message' => 'Sub Category Deleted','type' => 'success']);
        }
        return redirect(url()->previous());
    }

    public function viewJobShift(Request $request){
        $startI = $request->input('page',1);
        $startI = ($startI - 1) * 25;
        if($request->isMethod('post')){
            $request->session()->put('shiftSearch',$request->all());
        }

        if($request->input('reset') && $request->input('reset') == 'true'){
            $request->session()->forget('shiftSearch');
            return redirect('admin/cms/shift');
        }

        /* category query*/
        $s_app = $request->session()->get('shiftSearch');
        $jobShift = DB::table('jcm_job_shift')
                    ->where(function ($query) use ($s_app) {
                        if(count($s_app) > 0){
                            if($s_app['search'] != ''){
                                $query->where('name', 'like', '%'.$s_app['search'].'%');
                            }
                        }
                    })->orderBy('shiftId','desc')->paginate(25);
        /* end */

        return view('admin.cms.job-shifts',compact('jobShift','startI'));
    }

    public function saveJobShift(Request $request){
        if(!$request->ajax()){
            exit('Directory access is forbidden');
        }
        $shiftId = trim($request->input('shiftId'));
        $name = trim($request->input('name'));

        if($name == ''){
            exit('Please enter job shift.');
        }
        $cat = DB::table('jcm_job_shift')->where('name','=',$name)->where('shiftId','<>',$shiftId)->first();
        if(count($cat) > 0){
            exit('Job Shift <b>'.$name.'</b> already exist.');
        }

        $input = array('name' => $name, 'modifiedTime' => date('Y-m-d H:i:s'));
        if($shiftId != '0'){
            DB::table('jcm_job_shift')->where('shiftId','=',$shiftId)->update($input);
            $sMsg = 'Job Shift Updated';
        }else{
            $input['createdTime'] = date('Y-m-d H:i:s');
            DB::table('jcm_job_shift')->insert($input);
            $sMsg = 'New Job Shift Added';
        }
        $request->session()->flash('alert',['message' => $sMsg, 'type' => 'success']);
        exit('1');
    }

    public function getJobShift(Request $request){
        if(!$request->ajax()){
            exit('Directory access is forbidden');
        }
        $shiftId = $request->segment(5);
        $cat = DB::table('jcm_job_shift')->where('shiftId',$shiftId)->first();
        echo @json_encode($cat);
    }

    public function deleteJobShift(Request $request){
        if($request->isMethod('delete')){
            $shiftId = $request->input('shiftId');
            DB::table('jcm_job_shift')->where('shiftId','=',$shiftId)->delete();
            $request->session()->flash('alert',['message' => 'Job Shift Deleted','type' => 'success']);
        }
        return redirect(url()->previous());
    }

    public function viewJobType(Request $request){
        $startI = $request->input('page',1);
        $startI = ($startI - 1) * 25;
        if($request->isMethod('post')){
            $request->session()->put('jobtypeSearch',$request->all());
        }

        if($request->input('reset') && $request->input('reset') == 'true'){
            $request->session()->forget('jobtypeSearch');
            return redirect('admin/cms/jobtype');
        }

        /* category query*/
        $s_app = $request->session()->get('jobtypeSearch');
        $jobType = DB::table('jcm_job_types')
                    ->where(function ($query) use ($s_app) {
                        if(count($s_app) > 0){
                            if($s_app['search'] != ''){
                                $query->where('name', 'like', '%'.$s_app['search'].'%');
                            }
                        }
                    })->orderBy('typeId','desc')->paginate(25);
        /* end */

        return view('admin.cms.job-type',compact('jobType','startI'));
    }
	
	

    public function saveJobType(Request $request){
        if(!$request->ajax()){
            exit('Directory access is forbidden');
        }
        $typeId = trim($request->input('typeId'));
        $name = trim($request->input('name'));

        if($name == ''){
            exit('Please enter job type.');
        }
        $cat = DB::table('jcm_job_types')->where('name','=',$name)->where('typeId','<>',$typeId)->first();
        if(count($cat) > 0){
            exit('Job Type <b>'.$name.'</b> already exist.');
        }

        $input = array('name' => $name, 'modifiedTime' => date('Y-m-d H:i:s'));
        if($typeId != '0'){
            DB::table('jcm_job_types')->where('typeId','=',$typeId)->update($input);
            $sMsg = 'Job Type Updated';
        }else{
            $input['createdTime'] = date('Y-m-d H:i:s');
            DB::table('jcm_job_types')->insert($input);
            $sMsg = 'New Job Type Added';
        }
        $request->session()->flash('alert',['message' => $sMsg, 'type' => 'success']);
        exit('1');
    }

    public function getJobType(Request $request){
        if(!$request->ajax()){
            exit('Directory access is forbidden');
        }
        $typeId = $request->segment(5);
        $cat = DB::table('jcm_job_types')->where('typeId',$typeId)->first();
        echo @json_encode($cat);
    }

    public function deleteJobType(Request $request){
        if($request->isMethod('delete')){
            $typeId = $request->input('typeId');
            DB::table('jcm_job_types')->where('typeId','=',$typeId)->delete();
            $request->session()->flash('alert',['message' => 'Job Type Deleted','type' => 'success']);
        }
        return redirect(url()->previous());
    }
	
	/* UpSkill */
	
	 public function viewupskillType(Request $request){
      
        $startI = $request->input('page',1);
        $startI = ($startI - 1) * 25;
        return view('admin.cms.upskill-type',compact('startI'));
    }

    public function saveupskillType(Request $request){
        if(!$request->ajax()){
            exit('Directory access is forbidden');
        }
        $upskillid = trim($request->input('upskillid'));
        $name = trim($request->input('name'));

        if($name == ''){
            exit('Please enter job type.');
        }
        $cat = UpskillType::where('name','=',$name)->where('upskillid','<>',$upskillid)->first();
        if(count($cat) > 0){
            exit('UpSkill Type <b>'.$name.'</b> already exist.');
        }

        $input = array('name' => $name, 'updated_at' => date('Y-m-d H:i:s'));
        if($upskillid != '0'){
            UpskillType::where('upskillid','=',$upskillid)->update($input);
            $sMsg = 'Job Type Updated';
        }else{
            $input['created_at'] = date('Y-m-d H:i:s');
            UpskillType::insert($input);
            $sMsg = 'New UpSkill Type Added';
        }
        $request->session()->flash('alert',['message' => $sMsg, 'type' => 'success']);
        exit('1');
    }

    public function getupskillType(Request $request){
        if(!$request->ajax()){
            exit('Directory access is forbidden');
        }
        $upskillid = $request->segment(5);
        $cat = UpskillType::where('upskillid',$upskillid)->first();
        echo @json_encode($cat);
    }

    public function deleteupskillType(Request $request){
        if($request->isMethod('delete')){
            $upskillid = $request->input('upskillid');
            UpskillType::where('upskillid','=',$upskillid)->delete();
            $request->session()->flash('alert',['message' => 'UpSkill Type Deleted','type' => 'success']);
        }
        return redirect(url()->previous());
    }
	
	/* End UpSkill */

    public function viewPages(Request $request){
        JobCallMe::necessaryPages();
        $startI = $request->input('page',1);
        $startI = ($startI - 1) * 25;

        /* pages query*/
        $cmsPages = DB::table('jcm_cms_pages')->orderBy('pageId','desc')->paginate(25);
        /* end */
        return view('admin.cms.view-pages',compact('cmsPages','startI'));
    }

    public function addEditPage(Request $request){
        $pageId = 0;
        $rPath = $request->segment(4);
        if($request->isMethod('post')){
            $pageId = $request->input('pageId','0');
            //print_r($request->all());exit;
            $this->validate($request,[
                'title' => 'required|max:255',
                'pageData' => 'required',
                'featuredImage' => 'image|mimes:jpeg,png,jpg|max:2048',
            ]);
            $input = array('featuredImage' => '');
            if($request->hasFile('featuredImage')){
                $image = $request->file('featuredImage');

                $input['featuredImage'] = 'featured-image-'.time().rand(000000,999999).'.'.$image->getClientOriginalExtension();
                $destinationPath = public_path('/featured-photos');
                $image->move($destinationPath, $input['featuredImage']);
            }
            $input['title'] = $request->input('title');
            if($request->input('slug') != ''){
                $input['slug'] = $request->input('slug');
            }else{
                $input['slug'] = JobCallMe::slugify($request->input('title'));
            }
            $input['pageData'] = $request->input('pageData');
            $input['modifiedTime'] = date('Y-m-d H:i:s');
            if($pageId != '0'){
                DB::table('jcm_cms_pages')->where('pageId','=',$pageId)->update($input);
                $rMsg = 'Page Updated';
            }else{
                $input['createdTime'] = date('Y-m-d H:i:s');
                DB::table('jcm_cms_pages')->insert($input);
                $rMsg = 'Page Added';
            }
            $request->session()->flash('alert',['message' => $rMsg, 'type' => 'success']);
            return redirect('admin/cms/pages');
        }else{
            $cpage = array();
            $pageId = '0';
            if($rPath == 'edit'){
                $pageId = $request->segment(5);
                $cpage = DB::table('jcm_cms_pages')->where('pageId','=',$pageId)->first();
                if(count($cpage) == 0){
                    $request->session()->flash('alert',['message' => 'No Record Found', 'type' => 'danger']);
                    return redirect('admin/cms/pages');
                }
                $cpage = (array) $cpage;
            }
            return view('admin.cms.add-edit-page',compact('cpage','pageId','rPath'));
        }
    }

    public function deletePage(Request $request){
        if($request->isMethod('delete')){
            $pageId = trim($request->input('pageId'));
            
            $cpage = DB::table('jcm_cms_pages')->where('pageId','=',$pageId)->first();
            @unlink(public_path('/featured-photos/'.$cpage->featuredImage));

            DB::table('jcm_cms_pages')->where('pageId','=',$pageId)->delete();
            $request->session()->flash('alert',['message' => 'Page Deleted','type' => 'success']);
        }
        return redirect(url()->previous());
    }
    public function writing(Request $request){
        $writings = DB::table('jcm_writings')->groupBy('title')->orderBy('writingId','desc')->paginate(10);
        return view('admin.cms.writing',compact('writings'));
    }
    public function writestatupdate(Request $request){
        $id = $request->input('id');
        $wr_id = $request->input('wr_id');
        $status = $request->input('status');
        $wrstatus = $request->input('wrstatus');
        $check = DB::table('jcm_writings')->where('title',$id)->update(['status'=>$status]);
        DB::table('jcm_orders')->where('wr_id',$wr_id)->update(['status'=>$wrstatus]);
        DB::table('jcm_make_payment')->where('wr_id',$wr_id)->update(['status'=>$wrstatus]);
        if($check){
            echo 1;
        }else{
            echo 2;
        }
    }
    public function jobstatupdate(Request $request){
        $id = $request->input('id');
        $jobstatus = $request->input('jobstatus');
        $userid = $request->input('userId');
        $orderstatus = $request->input('orderstatus');
        $status = $request->input('status');
        $check = DB::table('jcm_jobs')->where('jobId',$id)->update(['jobStatus'=>$jobstatus,'status'=>$status]);
        DB::table('jcm_orders')->where('job_id',$id)->update(['status'=>$orderstatus]);
        DB::table('jcm_make_payment')->where('job_id',$id)->update(['status'=>$orderstatus]);

        if($check){
            echo 1;
        }else{
            echo 2;
        }
    }
    public function viewwriting(Request $request){
        $id = $request->input('id');
        
        $check = DB::table('jcm_writings')->where('writingId',$id)->first();
        $check->description = strip_tags($check->description);
      
        if($check){
          echo json_encode($check);
        }else{
            echo 2;
        }

    }
    
    public function deletewriting(Request $request){
        $id = $request->input('id');
        
        $check = DB::table('jcm_writings')->where('writingId',$id)->delete();
        if($check){
          echo 1;
        }else{
            echo 2;
        }
    }
    
    /* Approve upskills*/
    public function upskills(Request $request){
        $upskills = DB::table('jcm_upskills')->orderBy('skillId','desc')->paginate(10);
     //   dd($upskills);
        return view('admin.cms.upskills',compact('upskills'));
    }
    public function viewskill(Request $request){
        $id = $request->input('id');
        
        $check = DB::table('jcm_upskills')->where('skillId',$id)->first();
        $check->description = strip_tags($check->description);
        if($check){
          echo json_encode($check);
        }else{
            echo 2;
        }

    }
    public function deleteskill(Request $request){
        $id = $request->input('id');
        
        $check = DB::table('jcm_upskills')->where('skillId',$id)->delete();
        if($check){
          echo 1;
        }else{
            echo 2;
        }
    }
    public function upskillstatupdate(Request $request){
        $id = $request->input('id');
        $status = $request->input('status');
        $upstatus = $request->input('upstatus');
        $poststatus = $request->input('poststatus');
        $check = DB::table('jcm_upskills')->where('skillId',$id)->update(['status'=>$status]);
        DB::table('jcm_orders')->where('upskill_id',$id)->update(['status'=>$upstatus]);
        DB::table('posts')->where('learn_id',$id)->update(['status'=>$poststatus]);
        DB::table('jcm_make_payment')->where('upskill_id',$id)->update(['status'=>$upstatus]);
        if($check){
            echo 1;
        }else{
            echo 2;
            
        }
    }
    public function viewjobs(Request $request){
    if($request->isMethod('post')){
            $request->session()->put('jobSearch',$request->all());
        }

        if($request->input('reset') && $request->input('reset') == 'true'){
            $request->session()->forget('jobSearch');
            return redirect('admin/cms/alljobs');
        }

       $s_app = $request->session()->get('jobSearch');
        $jobs = DB::table('jcm_jobs as job')
       ->select('jcm_users.*','job.*','cat.name','subcat.subName','subcat2.subName as cat2')
        ->leftJoin('jcm_users','jcm_users.userId','=','job.userId')
        ->leftJoin('jcm_categories as cat','cat.categoryId','=','job.category')
        ->leftJoin('jcm_sub_categories as subcat','subcat.subCategoryId','=','job.subCategory')
        ->leftJoin('jcm_sub_categories2 as subcat2','subcat2.subCategoryId2','=','job.subCategory2')
          ->where(function ($query) use ($s_app) {
                        if(count($s_app) > 0){
                            if($s_app['search'] != ''){
                                $query->where('job.title', 'like', '%'.$s_app['search'].'%');
                            }
                        }
          })
        ->orderBy('job.jobId','des')
        ->paginate(15);
        //dd($jobs);

      return view('admin.cms.viewjobs',compact('jobs'));
    }

 public function publishjobs(Request $request){
        $data = DB::table('jcm_jobs as job');
       $data->select('jcm_users.*','job.*','cat.name','subcat.subName','subcat2.subName as cat2');
      $data->leftJoin('jcm_users','jcm_users.userId','=','job.userId');
        $data->leftJoin('jcm_categories as cat','cat.categoryId','=','job.category');
        $data->leftJoin('jcm_sub_categories as subcat','subcat.subCategoryId','=','job.subCategory');
        $data->leftJoin('jcm_sub_categories2 as subcat2','subcat2.subCategoryId2','=','job.subCategory2');
        $data->where('job.jobStatus','=','Publish');
        $data->orderBy('job.jobId','des');
        $jobs = $data->paginate(15);

      return view('admin.cms.publishjobs',compact('jobs'));
    }

     public function draftjobs(Request $request){
        $data = DB::table('jcm_jobs as job');
        $data->select('jcm_users.*','job.*','cat.name','subcat.subName','subcat2.subName as cat2');
        $data->leftJoin('jcm_users','jcm_users.userId','=','job.userId');
        $data->leftJoin('jcm_categories as cat','cat.categoryId','=','job.category');
        $data->leftJoin('jcm_sub_categories as subcat','subcat.subCategoryId','=','job.subCategory');
        $data->leftJoin('jcm_sub_categories2 as subcat2','subcat2.subCategoryId2','=','job.subCategory2');
        $data->where('job.jobStatus','=','Draft');
        $data->orderBy('job.jobId','des');
        $jobs = $data->paginate(15);

      return view('admin.cms.draftjobs',compact('jobs'));
    }

    public function deleteJob(Request $request){
         $jobId = $request->input('jobId');

        if(DB::table('jcm_jobs')->where('jobId','=',$jobId)->delete()){
           return  redirect('admin/cms/alljobs');
        }else{
            return " there is an error on CMS controller line number 539";
        }
    }
    public function editjob($id){
        $data = DB::table('jcm_jobs')->where('jobId','=',$id)->first();
        $recs = DB::table('jcm_payments')->get();
        
        return view('frontend.employer.job-update-admin',compact('result','recs'));

        
    }

    // package Plan //

        public function viewplan(Request $request){
        $startI = $request->input('page',1);
        $startI = ($startI - 1) * 25;
        if($request->isMethod('post')){
            $request->session()->put('jobtypeSearch',$request->all());
        }

        if($request->input('reset') && $request->input('reset') == 'true'){
            $request->session()->forget('jobtypeSearch');
            return redirect('admin/cms/plan');
        }

        /* category query*/
        $s_app = $request->session()->get('jobtypeSearch');
        $plan = DB::table('jcm_package_plan')
                    ->where(function ($query) use ($s_app) {
                        if(count($s_app) > 0){
                            if($s_app['search'] != ''){
                                $query->where('type', 'like', '%'.$s_app['search'].'%');
                            }
                        }
                    })->orderBy('pckg_id','desc')->paginate(25);
        /* end */

        return view('admin.cms.package_plan',compact('plan','startI'));
    }
	
	

    public function saveplan(Request $request){
        if(!$request->ajax()){
            exit('Directory access is forbidden');
        }
       // dd($request->all());
        $typeId = trim($request->input('pckg_id'));
        $name = trim($request->input('type'));
            $result_explode = explode('|', $name);
            $type = $result_explode[0];
            $p_category = $result_explode[1];
        
        $amount = trim($request->input('amount'));
        $quantity = trim($request->input('quantity'));
        $duration = trim($request->input('duration'));
        $expiryDays = trim($request->input('expiryDays'));

        if($name == ''){
            exit('Please enter job type.');
        }
       
        $input = array('type' => $type, 'amount' => $amount,'cat_id' => $p_category, 'quantity' => $quantity, 'duration' => $duration );
        if($typeId != '0'){
            DB::table('jcm_package_plan')->where('pckg_id','=',$typeId)->update($input);
            $sMsg = 'Job Type Updated';
        }else{
           // $input['createdTime'] = date('Y-m-d H:i:s');
            DB::table('jcm_package_plan')->insert($input);
            $sMsg = 'New Job Type Added';
        }
        $request->session()->flash('alert',['message' => $sMsg, 'type' => 'success']);
        exit('1');
    }

    public function getplan(Request $request){
        if(!$request->ajax()){
            exit('Directory access is forbidden');
        }
        $typeId = $request->segment(5);
        $cat = DB::table('jcm_package_plan')->where('pckg_id',$typeId)->first();
        echo @json_encode($cat);
    }

    public function deleteplan(Request $request){
        if($request->isMethod('delete')){
            $typeId = $request->input('pckg_id');
            DB::table('jcm_package_plan')->where('pckg_id','=',$typeId)->delete();
            $request->session()->flash('alert',['message' => 'Job Type Deleted','type' => 'success']);
        }
        return redirect(url()->previous());
    }

     public function allpackage(Request $request){
        $data = DB::table('jcm_save_packeges');
        $data->select('jcm_users.email','jcm_save_packeges.*');
       $data->leftJoin('jcm_users','jcm_users.userId','=','jcm_save_packeges.user_id');
        $data->orderBy('id','des');
        $jobs = $data->paginate(15);
    //    / dd($jobs);

      return view('admin.cms.pakages',compact('jobs'));
    }

       public function resumepackage(Request $request){
        $data = DB::table('jcm_save_packeges');
        $data->select('jcm_users.email','jcm_save_packeges.*');
       $data->leftJoin('jcm_users','jcm_users.userId','=','jcm_save_packeges.user_id');
       $data->where('jcm_save_packeges.type','Resume Download');
        $data->orderBy('id','des');
        $jobs = $data->paginate(15);
    //    / dd($jobs);

      return view('admin.cms.resumepakages',compact('jobs'));
    }

      public function jobspackage(Request $request){
        $data = DB::table('jcm_save_packeges');
        $data->select('jcm_users.email','jcm_save_packeges.*');
       $data->leftJoin('jcm_users','jcm_users.userId','=','jcm_save_packeges.user_id');
       $data->where('jcm_save_packeges.type','!=','Resume Download');
        $data->orderBy('id','des');
        $jobs = $data->paginate(15);
    //    / dd($jobs);

      return view('admin.cms.jobspakages',compact('jobs'));
    }
  public function pckgstatupdate(Request $request){
        $id = $request->input('id');
        $status = $request->input('status');
         $jobstatus = $request->input('jobstatus');
        
        $orderstatus = $request->input('orderstatus');
        $check = DB::table('jcm_save_packeges')->where('id',$id)->update(['status'=>$status]);
        DB::table('jcm_orders')->where('pckg_id',$id)->update(['status'=>$orderstatus]);
        DB::table('jcm_make_payment')->where('pckg_id',$id)->update(['status'=>$orderstatus]);
       
        if($check){
            echo 1;
        }else{
            echo 2;
            
        }
    }
	
}
