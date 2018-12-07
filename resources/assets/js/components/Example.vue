<template>
<section id="relate-to-job" class="user-dashboard" style="margin-bottom:50px">
  <div class="container">
    <div class="row">
      <!-- left sideBar -->
      <div class="col-md-3">
        <div class="left-sideBar">
          <div class="timeline-cover" style="background-color: #009BAB">
            <!-- <img src="../frontend-assets/images/timelineCover.svg"> -->
          </div>
          <div class="user-section text-center">
            <a :href="'/account/manage?profiles'">
              <div class="user-profile-img">
                <img :src="userimg">
              </div>
              <h5><strong>{{ userinfo}}</strong></h5>
              <span>Designation</span>
            </a>  
          </div>
          <div class="user-section text-center">
            <a :href="'/account/employer'">
              <div class="profile-img">
                <i class="fa fa-user fa-2x"></i>
              </div>
              <h5><strong>Employee Section</strong></h5>
            </a>  
          </div>
          <div class="user-section text-center">
            <a :href="'/account/jobseeker'">
              <div class="profile-img">
                <i class="fa fa-search-plus fa-2x"></i>
              </div>
              <h5><strong>Jobseeker</strong></h5>
            </a>  
          </div>
        </div>
      </div>
      <!-- End LeftSide Bar -->
      <!--RTJ- center start-->
      <div class="col-md-6 posts-user">
        <div class="post-section">
          <textarea class="form-control" rows="3" cols="8" placeholder="Write post" v-model="artical"></textarea>
          <hr>
          <!-- Add New Post -->
          
          <div class="col-md-12" style="margin-bottom: 11px;" v-if="image">
             <img :src="image" class="img-responsive" style="border: 6px solid gray;" height="70" width="90">
                </div> 
          <div>
            <button class="btn btn-default"><a :href="'/account/jobseeker'"><i class="fa fa-edit"></i>Write an article</a></button>
            <label for="fileUpload" class="btn btn-default"><input type="file" v-on:change="onImageChange" id="fileUpload" class="btn btn-default" name="hello"><i class="fa fa-camera"></i>Images</label>
            <button class="btn btn-default"><i class="fa fa-video-camera"></i>Video</button>
            <div class="pull-right">
              <!-- <select class="btn btn-default">
                <option>Post Setting</option>
                <option>Public</option>
                <option>Private</option>
              </select> -->
              <button class="btn btn-primary btn-sm" @click="adddata" :disabled="not_working">Post</button>
             
            </div>
          </div>
          <!-- End -->
                            
        </div>
        <hr>


        <div class="post-section" style="margin-bottom: 17px;" v-for="t in task.data" v-if="t.status=='Active'">
          <div v-if="t.post_type=='post'">
          <div class="user-feed-section"  >
            <div class="col-md-1 col-xs-2 user-newsfeed-img" v-if="t.profilePhoto">
              <img :src="'/profile-photos/'+t.profilePhoto">
              
            </div>
            <div class="col-md-1 col-xs-2 user-newsfeed-img" v-else>
              <img :src="'/profile-photos/profile-logo.png'">
              
            </div>
           
            <div class="col-md-11 col-xs-10">
               <div class="dropdown" style="float: right" v-if="t.user_id==showdata">
                 <i class="fa fa-angle-down" style="font-size: 29px;"></i>
                <div class="dropdown-content">
                  <a href="#">Edit Post</a>
                  <a href="#" @click.prevent="deleteData(t.post_id)">Delete Post</a>
                  <a href="#">Link 3</a>
                </div>
              </div>
              <p>{{t.firstName}} {{t.lastName}}</p>
              <span class="text-muted">POST</span><br>
              <span class="text-muted">4hr</span>
              
            </div>
          </div>
          <div class="post-detail">
            <div class="col-md-12"  v-if="t.image!=NULL">
              <router-link :to="{ name: 'article', params: { userId: showdata ,post_id: t.post_id}}">
              <p>{{t.post_text}}</p>
              <div class="post-img" v-if="t.image">
               <img :src="'/images/'+t.image">
              </div>
              </router-link>
              <span>{{t.likecount}} Likes </span><span> {{t.count}} Comments</span><hr>
            </div>
            <div class="col-md-12"  v-else>
             
              <p>{{t.post_text}}</p>
              
              <span>{{t.likecount}} Likes </span><span> {{t.count}} Comments</span><hr>
            </div>
          </div>
          <hr>


          <!-- Add New Post -->
          <div class="comments-section">
            <div style="margin-bottom: 16px;">
              <a href="#" v-if="t.isFavorited || isFavorited" @click.prevent="unFavorite(t.post_id)">
             <span style="color: dodgerblue;"><i class="fa fa-thumbs-up"></i>Like</span>
            </a>
            <a href="#" v-else @click.prevent="favorite(t.post_id)">
                <span style="color: gray;"><i class="fa fa-thumbs-up"></i>Like</span>
            </a>
            
            <span @click="showcmt(t.post_id)"><i class="fa fa-comments-o"></i>Comments</span>
            <span><i class="fa fa-share-alt"></i>Share</span>
            </div>


            <div class="row" style="" v-for="cmt in t.comment">
              <div class="col-sm-1">
              <div class="thumbnail" style="border-radius: 50%;width: 33px;margin-bottom: 7px;  !important" v-if="cmt.profilePhoto">
              <img :src="'/profile-photos/'+cmt.profilePhoto" style="border-radius: 50%">
              </div>
              <div class="thumbnail" style="border-radius: 50%;width: 33px;margin-bottom: 7px;  !important"  v-else>
              <img :src="'/profile-photos/profile-logo.png'" style="border-radius: 50%">
            </div>
              </div>
              <div class="col-sm-10" style="" >
             <span style="background-color: #e9ebee;color: #1d2129;padding: 8px;border-radius: 13px;font-size: 12px;"><a :href="'/account/employer/application/applicant/'+cmt.userId">{{cmt.firstName}} {{cmt.lastName}}</a> {{cmt.comt_text}} </span>
             <div class="dropdown" style="float: right" v-if="cmt.userId==showdata">
                 <i class="fa fa-ellipsis-v" style="font-size: 14px;"></i>
                <div class="dropdown-content">
                  <a :href="'#idss'+cmt.pst_id" @click="editcm(cmt.cmt_id)"><span><i class="fa fa-edit" style="font-size: 14px;"></i>Edit</span> </a>
                  <a href="#" @click.prevent="deletecmt(cmt.cmt_id)"><span><i class="fa fa-trash" style="font-size: 14px;"></i>Delete</span></a>
                  
                </div>
              </div>
            <div style="margin: 6px;">
             <p style="font-size: 12px;" @click="showcmtreply(cmt.cmt_id)"> Reply - {{cmt.created_at}} </p>
              </div>
              <br>



              <div class="row" style="" v-for="rply in cmt.reply">
              <div class="col-sm-1">
              <div class="thumbnail" style="border-radius: 50%;width: 33px;margin-bottom: 7px; !important" v-if="rply.profilePhoto">
              <img :src="'/profile-photos/'+rply.profilePhoto" style="border-radius: 50%;">
              </div>
              <div class="thumbnail" style="border-radius: 50%;width: 33px;margin-bottom: 7px;  !important"  v-else>
              <img :src="'/profile-photos/profile-logo.png'" style="border-radius: 50%">
              </div>
              </div>
               <div class="col-sm-10" style="">
               <span style="background-color: #e9ebee;color: #1d2129;padding: 8px;border-radius: 13px; font-size: 12px;"><a :href="'account/employer/application/applicant/'+rply.userId">{{rply.firstName}} {{rply.lastName}}</a> {{rply.reply_text}} </span>
               </div>
              </div>


              <div class="row" style="display:none" :id="'ids'+cmt.cmt_id">
                 <div class="col-md-1">
               <div class="thumbnail" style="border-radius: 50%;width: 33px;margin-bottom: 7px; !important" v-if="showimg">
              <img :src="'/profile-photos/'+showimg" style="border-radius: 50%;">
              </div>
             <div class="thumbnail" style="border-radius: 50%;width: 33px;margin-bottom: 7px;  !important" v-else>
              <img :src="'/profile-photos/profile-logo.png'" style="border-radius: 50%">
            </div></div>
           <div class="col-md-11"> <input type="text"  class="form-control" name="cmt_box" placeholder="Write reply" v-model="replytext" @keydown.enter="replycmt(cmt.cmt_id,cmt.pst_id)">
            </div>
            </div>
              </div><!-- /col-sm-5 -->
            </div>


             <div class="row" style="display:none" :id="'id'+t.post_id">
               <div class="col-md-1">
               <div class="thumbnail" style="border-radius: 50%;width: 33px;margin-bottom: 7px; !important" v-if="showimg">
              <img :src="'/profile-photos/'+showimg" style="border-radius: 50%;">
              </div>
             <div class="thumbnail" style="border-radius: 50%;width: 33px;margin-bottom: 7px;  !important" v-else>
              <img :src="'/profile-photos/profile-logo.png'" style="border-radius: 50%">
            </div></div>
            <div class="col-md-11"> <input type="text"  class="form-control" name="cmt_box" placeholder="Write Comment" v-model="cmttext" @keydown.enter="addcmt(t.post_id)">
            </div>
            </div>

              <div class="row clickshow" style="display:none" :id="'idss'+t.post_id">
               <div class="col-md-1">
               <div class="thumbnail" style="border-radius: 50%;width: 33px;margin-bottom: 7px; !important" v-if="showimg">
              <img :src="'/profile-photos/'+showimg" style="border-radius: 50%;">
              </div>
             <div class="thumbnail" style="border-radius: 50%;width: 33px;margin-bottom: 7px;  !important" v-else>
              <img :src="'/profile-photos/profile-logo.png'" style="border-radius: 50%">
            </div></div>
            <div class="col-md-11"> <input type="text"  class="form-control" name="cmt_box" placeholder="Write Comment" v-model="editData.comt_text" @keydown.enter="updatecmt(editData.cmt_id)">
            </div>
            </div>

          </div>
          </div>

    <!-- learn -->
            <div v-else-if="t.post_type=='learn' && t.status=='Active' ">
          <div class="user-feed-section"  >
            <div class="col-md-1 col-xs-2 user-newsfeed-img" v-if="t.profilePhoto">
              <img :src="'/profile-photos/'+t.profilePhoto">
              
            </div>
            <div class="col-md-1 col-xs-2 user-newsfeed-img" v-else>
              <img :src="'/profile-photos/profile-logo.png'">
              
            </div>
         
            <div class="col-md-11 col-xs-10">
               <div class="dropdown" style="float: right" v-if="t.user_id==showdata">
                 <i class="fa fa-angle-down" style="font-size: 29px;"></i>
                <div class="dropdown-content">
                  <a :href="'/account/upskill/edit/'+t.learn_id">Edit Post</a>
                  <a href="#" @click="deleteData(t.post_id)">Delete Post</a>
                  <a href="#">Link 3</a>
                </div>
              </div>
              <p>{{t.firstName}} {{t.lastName}}</p>
              <span class="text-muted">Sponsored ·</span><br>
              <span class="text-muted">4hr</span>
              
            </div>
          </div>
          <div class="post-detail">
            <div class="col-md-12">
              <a href="#">
              <p>{{t.post_text}}</p>
              <div class="post-img" v-if="t.image">
               <img :src="'/upskill-images/'+t.image">
              </div>
              </a>
              <span>{{t.likecount}} Likes </span><span> {{t.count}} Comments</span><hr><hr>
            </div>
          </div>
          <hr>
          <!-- Add New Post -->
    <div class="comments-section">
            <div style="margin-bottom: 16px;">
              <a href="#" v-if="t.isFavorited || isFavorited" @click.prevent="unFavorite(t.post_id)">
             <span style="color: dodgerblue;"><i class="fa fa-thumbs-up"></i>Like</span>
            </a>
            <a href="#" v-else @click.prevent="favorite(t.post_id)">
                <span style="color: gray;"><i class="fa fa-thumbs-up"></i>Like</span>
            </a>
            
            <span @click="showcmt(t.post_id)"><i class="fa fa-comments-o"></i>Comments</span>
            <span><i class="fa fa-share-alt"></i>Share</span>
            </div>


            <div class="row" style="" v-for="cmt in t.comment">
              <div class="col-sm-1">
              <div class="thumbnail" style="border-radius: 50%;width: 33px;margin-bottom: 7px;  !important" v-if="cmt.profilePhoto">
              <img :src="'/profile-photos/'+cmt.profilePhoto" style="border-radius: 50%">
              </div>
              <div class="thumbnail" style="border-radius: 50%;width: 33px;margin-bottom: 7px;  !important"  v-else>
              <img :src="'/profile-photos/profile-logo.png'" style="border-radius: 50%">
            </div>
              </div>
              <div class="col-sm-10" style="" >
             <span style="background-color: #e9ebee;color: #1d2129;padding: 8px;border-radius: 13px;font-size: 12px;"><a :href="'/account/employer/application/applicant/'+cmt.userId">{{cmt.firstName}} {{cmt.lastName}}</a> {{cmt.comt_text}} </span>
             <div class="dropdown" style="float: right" v-if="cmt.userId==showdata">
                 <i class="fa fa-ellipsis-v" style="font-size: 14px;"></i>
                <div class="dropdown-content">
                  <a :href="'#idss'+cmt.pst_id" @click="editcm(cmt.cmt_id)"><span><i class="fa fa-edit" style="font-size: 14px;"></i>Edit</span> </a>
                  <a href="#" @click.prevent="deletecmt(cmt.cmt_id)"><span><i class="fa fa-trash" style="font-size: 14px;"></i>Delete</span></a>
                  
                </div>
              </div>
            <div style="margin: 6px;">
             <p style="font-size: 12px;" @click="showcmtreply(cmt.cmt_id)"> Reply - {{cmt.created_at}} </p>
              </div>
              <br>



              <div class="row" style="" v-for="rply in cmt.reply">
              <div class="col-sm-1">
              <div class="thumbnail" style="border-radius: 50%;width: 33px;margin-bottom: 7px; !important" v-if="rply.profilePhoto">
              <img :src="'/profile-photos/'+rply.profilePhoto" style="border-radius: 50%;">
              </div>
              <div class="thumbnail" style="border-radius: 50%;width: 33px;margin-bottom: 7px;  !important"  v-else>
              <img :src="'/profile-photos/profile-logo.png'" style="border-radius: 50%">
              </div>
              </div>
               <div class="col-sm-10" style="">
               <span style="background-color: #e9ebee;color: #1d2129;padding: 8px;border-radius: 13px; font-size: 12px;"><a :href="'account/employer/application/applicant/'+rply.userId">{{rply.firstName}} {{rply.lastName}}</a> {{rply.reply_text}} </span>
               </div>
              </div>


              <div class="row" style="display:none" :id="'ids'+cmt.cmt_id">
                 <div class="col-md-1">
               <div class="thumbnail" style="border-radius: 50%;width: 33px;margin-bottom: 7px; !important" v-if="showimg">
              <img :src="'/profile-photos/'+showimg" style="border-radius: 50%;">
              </div>
             <div class="thumbnail" style="border-radius: 50%;width: 33px;margin-bottom: 7px;  !important" v-else>
              <img :src="'/profile-photos/profile-logo.png'" style="border-radius: 50%">
            </div></div>
           <div class="col-md-11"> <input type="text"  class="form-control" name="cmt_box" placeholder="Write reply" v-model="replytext" @keydown.enter="replycmt(cmt.cmt_id,cmt.pst_id)">
            </div>
            </div>
              </div><!-- /col-sm-5 -->
            </div>


             <div class="row" style="display:none" :id="'id'+t.post_id">
               <div class="col-md-1">
               <div class="thumbnail" style="border-radius: 50%;width: 33px;margin-bottom: 7px; !important" v-if="showimg">
              <img :src="'/profile-photos/'+showimg" style="border-radius: 50%;">
              </div>
             <div class="thumbnail" style="border-radius: 50%;width: 33px;margin-bottom: 7px;  !important" v-else>
              <img :src="'/profile-photos/profile-logo.png'" style="border-radius: 50%">
            </div></div>
            <div class="col-md-11"> <input type="text"  class="form-control" name="cmt_box" placeholder="Write Comment" v-model="cmttext" @keydown.enter="addcmt(t.post_id)">
            </div>
            </div>

              <div class="row clickshow" style="display:none" :id="'idss'+t.post_id">
               <div class="col-md-1">
               <div class="thumbnail" style="border-radius: 50%;width: 33px;margin-bottom: 7px; !important" v-if="showimg">
              <img :src="'/profile-photos/'+showimg" style="border-radius: 50%;">
              </div>
             <div class="thumbnail" style="border-radius: 50%;width: 33px;margin-bottom: 7px;  !important" v-else>
              <img :src="'/profile-photos/profile-logo.png'" style="border-radius: 50%">
            </div></div>
            <div class="col-md-11"> <input type="text"  class="form-control" name="cmt_box" placeholder="Write Comment" v-model="editData.comt_text" @keydown.enter="updatecmt(editData.cmt_id)">
            </div>
            </div>

          </div>
          </div>
<!-- /learn -->

<!-- Read -->
       <div v-else-if="t.post_type=='read' && t.status=='Active' ">
          <div class="user-feed-section"  >
            <div class="col-md-1 col-xs-2 user-newsfeed-img" v-if="t.profilePhoto">
              <img :src="'/profile-photos/'+t.profilePhoto">
              
            </div>
            <div class="col-md-1 col-xs-2 user-newsfeed-img" v-else>
              <img :src="'/profile-photos/profile-logo.png'">
              
            </div>
           
            <div class="col-md-11 col-xs-10">
               <div class="dropdown" style="float: right" v-if="t.user_id==showdata">
                 <i class="fa fa-angle-down" style="font-size: 29px;"></i>
                <div class="dropdown-content">
                  <a href="#">Edit Post</a>
                  <a href="#" @click="deleteData(t.post_id)">Delete Post</a>
                  <a href="#">Link 3</a>
                </div>
              </div>
              <p>{{t.firstName}} {{t.lastName}}</p>
              <span class="text-muted">Web developer</span><br>
              <span class="text-muted">4hr</span>
              
            </div>
          </div>
          <div class="post-detail">
           
            <div class="col-md-12">
               <a :href="'/read/article/'+t.read_id">
              <p>{{t.post_text}}</p>
              <div class="post-img" v-if="t.image">
               <img :src="'/article-images/'+t.image">
              </div>
               </a>
              <span>{{t.likecount}} Likes </span><span> {{t.count}} Comments</span><hr>
            </div>
           
          </div>
          <hr>
          <!-- Add New Post -->
        <div class="comments-section">
            <div style="margin-bottom: 16px;">
              <a href="#" v-if="t.isFavorited || isFavorited" @click.prevent="unFavorite(t.post_id)">
             <span style="color: dodgerblue;"><i class="fa fa-thumbs-up"></i>Like</span>
            </a>
            <a href="#" v-else @click.prevent="favorite(t.post_id)">
                <span style="color: gray;"><i class="fa fa-thumbs-up"></i>Like</span>
            </a>
            
            <span @click="showcmt(t.post_id)"><i class="fa fa-comments-o"></i>Comments</span>
            <span><i class="fa fa-share-alt"></i>Share</span>
            </div>


            <div class="row" style="" v-for="cmt in t.comment">
              <div class="col-sm-1">
              <div class="thumbnail" style="border-radius: 50%;width: 33px;margin-bottom: 7px;  !important" v-if="cmt.profilePhoto">
              <img :src="'/profile-photos/'+cmt.profilePhoto" style="border-radius: 50%">
              </div>
              <div class="thumbnail" style="border-radius: 50%;width: 33px;margin-bottom: 7px;  !important"  v-else>
              <img :src="'/profile-photos/profile-logo.png'" style="border-radius: 50%">
            </div>
              </div>
              <div class="col-sm-10" style="" >
             <span style="background-color: #e9ebee;color: #1d2129;padding: 8px;border-radius: 13px;font-size: 12px;"><a :href="'/account/employer/application/applicant/'+cmt.userId">{{cmt.firstName}} {{cmt.lastName}}</a> {{cmt.comt_text}} </span>
             <div class="dropdown" style="float: right" v-if="cmt.userId==showdata">
                 <i class="fa fa-ellipsis-v" style="font-size: 14px;"></i>
                <div class="dropdown-content">
                  <a :href="'#idss'+cmt.pst_id" @click="editcm(cmt.cmt_id)"><span><i class="fa fa-edit" style="font-size: 14px;"></i>Edit</span> </a>
                  <a href="#" @click.prevent="deletecmt(cmt.cmt_id)"><span><i class="fa fa-trash" style="font-size: 14px;"></i>Delete</span></a>
                  
                </div>
              </div>
            <div style="margin: 6px;">
             <p style="font-size: 12px;" @click="showcmtreply(cmt.cmt_id)"> Reply - {{cmt.created_at}} </p>
              </div>
              <br>



              <div class="row" style="" v-for="rply in cmt.reply">
              <div class="col-sm-1">
              <div class="thumbnail" style="border-radius: 50%;width: 33px;margin-bottom: 7px; !important" v-if="rply.profilePhoto">
              <img :src="'/profile-photos/'+rply.profilePhoto" style="border-radius: 50%;">
              </div>
              <div class="thumbnail" style="border-radius: 50%;width: 33px;margin-bottom: 7px;  !important"  v-else>
              <img :src="'/profile-photos/profile-logo.png'" style="border-radius: 50%">
              </div>
              </div>
               <div class="col-sm-10" style="">
               <span style="background-color: #e9ebee;color: #1d2129;padding: 8px;border-radius: 13px; font-size: 12px;"><a :href="'account/employer/application/applicant/'+rply.userId">{{rply.firstName}} {{rply.lastName}}</a> {{rply.reply_text}} </span>
               </div>
              </div>


              <div class="row" style="display:none" :id="'ids'+cmt.cmt_id">
                 <div class="col-md-1">
               <div class="thumbnail" style="border-radius: 50%;width: 33px;margin-bottom: 7px; !important" v-if="showimg">
              <img :src="'/profile-photos/'+showimg" style="border-radius: 50%;">
              </div>
             <div class="thumbnail" style="border-radius: 50%;width: 33px;margin-bottom: 7px;  !important" v-else>
              <img :src="'/profile-photos/profile-logo.png'" style="border-radius: 50%">
            </div></div>
           <div class="col-md-11"> <input type="text"  class="form-control" name="cmt_box" placeholder="Write reply" v-model="replytext" @keydown.enter="replycmt(cmt.cmt_id,cmt.pst_id)">
            </div>
            </div>
              </div><!-- /col-sm-5 -->
            </div>


             <div class="row" style="display:none" :id="'id'+t.post_id">
               <div class="col-md-1">
               <div class="thumbnail" style="border-radius: 50%;width: 33px;margin-bottom: 7px; !important" v-if="showimg">
              <img :src="'/profile-photos/'+showimg" style="border-radius: 50%;">
              </div>
             <div class="thumbnail" style="border-radius: 50%;width: 33px;margin-bottom: 7px;  !important" v-else>
              <img :src="'/profile-photos/profile-logo.png'" style="border-radius: 50%">
            </div></div>
            <div class="col-md-11"> <input type="text"  class="form-control" name="cmt_box" placeholder="Write Comment" v-model="cmttext" @keydown.enter="addcmt(t.post_id)">
            </div>
            </div>

              <div class="row clickshow" style="display:none" :id="'idss'+t.post_id">
               <div class="col-md-1">
               <div class="thumbnail" style="border-radius: 50%;width: 33px;margin-bottom: 7px; !important" v-if="showimg">
              <img :src="'/profile-photos/'+showimg" style="border-radius: 50%;">
              </div>
             <div class="thumbnail" style="border-radius: 50%;width: 33px;margin-bottom: 7px;  !important" v-else>
              <img :src="'/profile-photos/profile-logo.png'" style="border-radius: 50%">
            </div></div>
            <div class="col-md-11"> <input type="text"  class="form-control" name="cmt_box" placeholder="Write Comment" v-model="editData.comt_text" @keydown.enter="updatecmt(editData.cmt_id)">
            </div>
            </div>

          </div>
          </div>
          
          <!-- Endloop --> 
        </div>  
          <!-- End -->  
      </div>

      
        <div class="col-md-3">	
          <div class="right-sideBar">	
            <div class="user-to-follow col-md-12 col-xs-12 ">
              <div class="follow-companies2" style="background:#57768a;color:#fff;">
                <!-- <a href="{{ url('account/writings') }}" class="pull-right"><span  style="color:#fff;"><i class="fa fa-edit"></i> @lang('home.ADVERTISE')</span></a> -->
                <h4>Add to your feed</h4> 
              </div>

               
                <div class="sp-items col-xs-12">
                  <div class="col-md-3 col-xs-3 sp-item-img">
                      <img src="" style="">
                  </div>
                  <div class="col-md-6 col-xs-6 sp-item" style="text-align:left !important">
                      <p><strong>User Name</strong></p>
                      <p>companyName</p>
                      <!-- <span class="rtj-action">
                          <a href="{{ url('jobs/apply/'.$sJob->jobId) }}" title="Apply">
                              <i class="fa fa-paper-plane"></i>
                          </a>&nbsp;
                          <a href="javascript:;" onclick="removeJob({{ $sJob->jobId }})" title="Remove" class="application-remove">
                              <i class="fa fa-remove"></i>
                          </a>
                      </span> -->
                  </div>
                  <div class="col-md-3 col-xs-3 follow-user">
                    <button class="btn btn-default btn-sm"><i class="fa fa-plus"></i>Follow</button>
                  </div>
                </div>
                <a href="" class="pull-right" style="padding-top: 5px"></a>
            </div>
                

            <div class="follow-companies-side col-md-12 col-xs-12 ">
              <div class="follow-companies2" style="background:#57768a;color:#fff;">
                <h4>Companies to Follow</h4>
              </div>
              <div class="col-md-12 follow-companies">
                <!-- <a href="{{ url('account/upskill/add') }}" class="pull-right"><i class="fa fa-edit"></i> @lang('home.ADVERTISE')</a> -->

                <div class="row">
               
                  <div class="col-md-12 col-xs-12 sp-item">

                    <div class="col-md-3 col-xs-3 companies-mbl-view">
                      <img src="" style="width:100%;">
                    </div>
                    <div class="col-md-6 col-xs-6">
                      <p style="height:42px"><a href=""></a></p>
                    </div>
                    
                    <div class="col-md-3 col-xs-3">
                     
                      <a href="javascript:;"  class="btn btn-success btn-xs"></a>
                      
                      <a href="javascript:;"  class="btn btn-default btn-sm"><i class="fa fa-plus"></i></a>
                     
                    </div>
                    
                    <br>
                    <p></p>
                  </div>
                  
                  <hr>
                  <div class="col-md-12">
                    <a href="" class="pull-right" style="padding-top: 5px"></a>
                  </div>
                </div>
              </div>
            </div>

            </div>

          

          </div>


          

        </div>
      </div>
    </section>
</template>

<script>

    export default {
      props:['showdata',
            'showimg',
            'userinfo',
            'userimg'],
        data(){
            return{
                image: '',
                artical: '',
                task:{},
                sessionid:'',
                cmttext:'',
                replytext:'',
                editData:'',
                isFavorited:'',
                not_working:true,
            }
        },
        watch:{
              artical(){
                if(this.artical.length > 0){
                  this.not_working=false;
                }else{
                  this.not_working=true;
                }
              },
               image(){
                if(this.image != ''){
                  this.not_working=false;
                }else{
                  this.not_working=true;
                }
              }
        },
          sockets:{
                connect: function(){
                  console.log('socket connected')
                },
                message: function(val){
                    this.getdata();
                  
                }
                },
        methods:{
              onImageChange(e) {
                let files = e.target.files || e.dataTransfer.files;
                if (!files.length)
                    return;
                this.createImage(files[0]);
            },
            createImage(file) {
                let reader = new FileReader();
                let vm = this;
                reader.onload = (e) => {
                    vm.image = e.target.result;
                };
                reader.readAsDataURL(file);
            },
            adddata(){
            axios.post('/account/addpost',{
                'artical': this.artical,
                'image': this.image,
                
            })
            .then(responce => {
                 this.task=responce,
                 this.image= '',
                 this.$noty.success("Your post has been publish successfully!");

                })
            .catch(error=> {
            this.errorr=error.response.data.errors;
                console.log(this.errorr);
                })
            this.artical=''
            
        },
         deleteData(id){
           if(confirm('are you sure want to delete?')){
          axios.post('/account/delpost/'+id,{
                id: id,
               
            })
            .then(responce => {
                 this.task = responce;
                 })
            .catch(error=> {
            this.errorr=error.response.data.errors;
                console.log(this.errorr);
                })
           }
             
        },
        deletecmt(id){
         if(confirm('are you sure want to delete?')){
          axios.post('/account/delcmt/'+id,{
                id: id,
               
            })
            .then(responce => {
                 this.task = responce;
                 })
            .catch(error=> {
            this.errorr=error.response.data.errors;
                console.log(this.errorr);
                })
           }
        },
        editcm(id){
            axios.get('/account/editcmt/'+id)
            .then((responce) => {
              this.editData=responce.data[0],
              console.log(this.editData.cmt_id),
              $('#idss'+responce.data[0].pst_id).show();
            })
            .catch((error) => console.log(error));
        },
        updatecmt(id){
          axios.post('/account/addcmt',{
                'comt_text': this.editData.comt_text,
                'cmt_id': id,
            })
            .then(responce => {
                 this.task=responce,
                 this.cmttext='',
                 console.log(responce.data.pst_id);
              $('.clickshow').hide();
                })
            .catch(error=> {
            this.errorr=error.response.data.errors;
                console.log(this.errorr);
                })
        },
          searchInLowerCase() {
              return this.task.toLowerCase().trim();
            },
            getdata(){
                  axios.get('/account/post')
                  .then((responce) => this.task=responce)
                  .catch((error) => console.log(error));
            },
            showcmt(id){
              $('#id'+id).toggle();
              
            },
            showcmtreply(id){
              $('#ids'+id).toggle();
              
            },
            addcmt(id){
               axios.post('/account/addcmt',{
                'comt_text': this.cmttext,
                'pst_id': id,
                
            })
            .then(responce => {
                 this.task=responce,
                 this.cmttext=''

                })
            .catch(error=> {
            this.errorr=error.response.data.errors;
                console.log(this.errorr);
                })
            },
             replycmt(id,p_id){
               axios.post('/account/replycmt',{
                'reply_text': this.replytext,
                'parent_id': id,
                'post_Id':p_id,
            })
            .then(responce => {
                 this.task=responce,
                 this.replytext=''

                })
            .catch(error=> {
            this.errorr=error.response.data.errors;
                console.log(this.errorr);
                })
            },
              favorite(id) {
               axios.post('/account/like/',{
                 'post_ID':id
               })
              .then(response => this.task = responce)
              .catch(response => console.log(response.data));
               
            },

            unFavorite(id) {
               axios.post('/account/dislike/'+id)
                    .then(response => this.task = responce)
                    .catch(response => console.log(response.data));
                   
            }
        },
        mounted() {
        this.isFavorited = this.isFavorite ? true : false;
        this.getdata();
        
        }
    }
</script>
