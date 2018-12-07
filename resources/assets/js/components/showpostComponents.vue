<template>
<section class="" style="background-color: rgb(249, 249, 249);">
    <div class="container">
        <div class="cross">
             <router-link to="/"><i class="fa fa-window-close" aria-hidden="true"></i></router-link>
         </div>
    <div class="row" style="margin-bottom: 81px;margin-top: 81px;">  
      <!-- left sideBar -->
      <div class="col-md-6 col-md-offset-1" >
        <div class="left-sideBar">
          <div class="post-img"><img :src="'/images/'+showdata.image" style="width:100%"></div>
        </div>
      </div>
       <div class="col-md-4">	
          <div class="right-sideBar">	
              <div class="user-feed-section"  >
            
            <div class="col-md-1 col-xs-2 user-newsfeed-img">
              <img :src="'/profile-photos/'+showdata.profilePhoto">
              
            </div>
         
            <div class="col-md-11 col-xs-10">
               <div class="dropdown" style="float: right" v-if="showdata.user_id==userId">
                 <i class="fa fa-angle-down" style="font-size: 29px;"></i>
                <div class="dropdown-content">
                  <a href="#">Edit Post</a>
                  <a href="#">Delete Post</a>
                  <a href="#">Link 3</a>
                </div>
              </div>
              <p>{{showdata.firstName}} {{showdata.lastName}}</p>
              <span class="text-muted">POST</span><br>
              <span class="text-muted">4hr</span>
              
            </div>
            <p v-if="showdata.post_text">{{showdata.post_text}}</p>
             <span>{{showdata.likecount}} Likes </span><span> {{showdata.count}}  Comments</span><hr>
          </div>
            <div class="comments-section" style="    padding: 0px 0px 0px 22px;">
            <div style="margin-bottom: 16px;">
              
            <a href="#" v-if="showdata.isFavorited || isFavorited" @click.prevent="unFavorite(showdata.post_id)">
             <span style="color: dodgerblue;"><i class="fa fa-thumbs-up"></i>Like</span>
            </a>
            <a href="#" v-else @click.prevent="favorite(showdata.post_id)">
                <span style="color: gray;"><i class="fa fa-thumbs-up"></i>Like</span>
            </a>
            
            <span @click="shows"><i class="fa fa-comments-o" ></i>Comments</span>
            <span><i class="fa fa-share-alt"></i>Share</span>
            </div>
       <div class="jd-share-btn" style="">
                    <a  href="javascript: void(0)" @click="window.open('https://www.facebook.com/dialog/share?app_id=377749349357447&title=<?php echo $job->title; ?>&image=<?php echo $cLogo;?>&display=page&href=https%3A%2F%2Fwww.jobcallme.com%2Fjobs%2F<?php echo $job->jobId; ?>%2F&redirect_uri=https%3A%2F%2Fwww.jobcallme.com ');return false;">
                    	<i class="fa fa-facebook" style="background: #2e6da4;"></i> 
                    </a>
                    <a href="https://www.linkedin.com/shareArticle?mini=true&url=url('jobs/'.$job->jobId)&title=&summary=&source=">
                    	<i class="fa fa-linkedin" style=" background: #007BB6;"></i> 
                    </a>
                    <a href="https://twitter.com/home?status=url('jobs/'.$job->jobId)" target="_blank" >
                    	<i class="fa fa-twitter" style="background: #15B4FD;"></i> 
                    </a>
                    <a href="https://plus.google.com/share?url=http://127.0.0.1:8000/account/jobseeker/userHome#/perpost/58" target="_blank" >
                    	<i class="fa fa-google-plus" style="background: #F63E28;"></i> 
				         	</a>
                </div>
                <div class="row" style="" v-for="cmt in showdata.comment">
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
             <div class="dropdown" style="float: right" v-if="cmt.userId==userId">
                 <i class="fa fa-ellipsis-v" style="font-size: 14px;"></i>
                <div class="dropdown-content">
                  <a :href="''" @click.prevent="editbox(cmt.cmt_id)"><span><i class="fa fa-edit" style="font-size: 14px;"></i>Edit</span> </a>
                  <a href="#" @click.prevent="perdeletecmt(cmt.cmt_id)"><span><i class="fa fa-trash" style="font-size: 14px;"></i>Delete</span></a>
                  
                  
                </div>
              </div>
          
               <div style="margin: 6px;">
             <p style="font-size: 12px;" @click="percmtreply(cmt.cmt_id)"> Reply - {{cmt.created_at}} </p>
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
           <div class="col-md-11"> <input type="text"  class="form-control" name="cmt_box" placeholder="Write reply" v-model="replytext" @keydown.enter="Perreplycmt(cmt.cmt_id,cmt.pst_id)">
            </div>
            </div>
              </div><!-- /col-sm-5 -->
              </div>
               <div class="row clickshow" style="display:none" :id="'idss'">
               <div class="col-md-1">
               <div class="thumbnail" style="border-radius: 50%;width: 33px;margin-bottom: 7px; !important" v-if="showimg">
              <img :src="'/profile-photos/'+showimg" style="border-radius: 50%;">
              </div>
             <div class="thumbnail" style="border-radius: 50%;width: 33px;margin-bottom: 7px;  !important" v-else>
              <img :src="'/profile-photos/profile-logo.png'" style="border-radius: 50%">
            </div></div>
            <div class="col-md-11"> <input type="text"  class="form-control" name="cmt_box"  v-model="cmttext" placeholder="Write Comment" @keydown.enter="addcmtper(showdata.post_id)">
            </div>
            </div>
                <div class="row clickshow" style="display:none" :id="'editbox'+showdata.post_id">
               <div class="col-md-1">
               <div class="thumbnail" style="border-radius: 50%;width: 33px;margin-bottom: 7px; !important" v-if="showimg">
              <img :src="'/profile-photos/'+showimg" style="border-radius: 50%;">
              </div>
             <div class="thumbnail" style="border-radius: 50%;width: 33px;margin-bottom: 7px;  !important" v-else>
              <img :src="'/profile-photos/profile-logo.png'" style="border-radius: 50%">
            </div></div>
            <div class="col-md-11"> <input type="text"  class="form-control" name="cmt_box" placeholder="Write Comment" v-model="editData.comt_text" @keydown.enter="perupdatecmt(editData.cmt_id)">
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
    name: 'article',
    props: ['userId',
    'post_id',
    'showimg'],
    data() {
      return {
        showdata:'',
        currentUrl:'',
        isFavorited:'',
        cmttext:'',
        editData:'',
        replytext:'',
      }
    },
     sockets:{
                connect: function(){
                  console.log('socket connected')
                },
                message: function(val){
                    this.getperdata();
                  
                }
                },
   
    methods:{
      favorite(id) {
         this.isFavorited=true;
               axios.post('/account/perlike/',{
                 'post_ID':id
               })
              .then(response => {
                this.showdata=responce.data[0]
               
                })
              .catch(response => console.log(response.data));
               
            },

            unFavorite(id) {
              this.isFavorited=false;
               axios.post('/account/perdislike/'+id)
                    .then(response => {
                      this.showdata=responce.data[0]
                       
                       })
                    .catch(response => console.log(response.data));
                   
            },
             addcmtper(id){
             
               axios.post('/account/addcmtper',{
                'comt_text': this.cmttext,
                'pst_id': id,
                
            })
            .then(responce => {
                 this.showdata=responce.data[0],
                 this.cmttext=''

                })
            .catch(error=> {
            this.errorr=error.response.data.errors;
                console.log(this.errorr);
                })
            },

          perdeletecmt(id){
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
         editbox(id){
              axios.get('/account/pereditcmt/'+id)
              .then((responce) => {
                this.editData=responce.data[0],
                console.log(this.editData.cmt_id),
                $('#editbox'+responce.data[0].pst_id).show();
              })
              .catch((error) => console.log(error));
        },
        perupdatecmt(id){
          axios.post('/account/addcmtper',{
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
         percmtreply(id){
              $('#ids'+id).toggle();
              
            },
        Perreplycmt(id,p_id){
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
         shows(){
             
              $('#idss').toggle();
              
            },
              getperdata(){
                    axios.get('/account/post/'+this.post_id)
                  .then((responce) => {
                    this.showdata=responce.data[0];
                  })
                  .catch((error) => console.log(error));
         }
    },
    mounted() {
      this.isFavorited = this.isFavorite ? true : false;
      console.log(this.post_id);
    this.getperdata();
    }
}
</script>
<style>
.right-sideBar{
    padding: 12px;
    border: 1px solid #cccccc;
    background: white;
    box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0px 0px 0px 0 rgba(0, 0, 0, 1);
}
.user-feed-section .col-md-11 {
    padding-left: 42px;
}
   .post-img{ overflow: hidden;
    height: 600px;
   }
  .cross{
    font-size: 17px;
    padding-top: 59px;
    float: right;
  }
</style>

