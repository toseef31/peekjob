@extends('frontend.layouts.app')

@section('title', "$record->title")

@section('content')
<?php 
$username='';
$userimage='';
$userimages='';
?>
<!--Read Articles-->

<section id="postNewJob" class="article-section">

    <div id="app"></div>
    <div class="container">
        <div class="col-md-9">
            <div class="ld-left">
                <div class="ld-thumbnail">
                    <img src="{{ url('article-images/'.$record->wIcon) }}">
                </div>
                <h3>{!! $record->title !!}</h3>
                <div class="col-md-6 article-type">
                    {{ $record->name }}
                </div>
                <div class="col-md-6">
                    <div class="jd-share-btn pull-right">
                        <a href="https://www.facebook.com/sharer/sharer.php?u={{ url('read/article/'.$record->writingId ) }}">
                            <i class="fa fa-facebook" style="background: #2e6da4;"></i> 
                        </a>
                        <a href="https://www.linkedin.com/shareArticle?mini=true&url={{ url('read/article/'.$record->writingId ) }}&title=&summary=&source=">
                            <i class="fa fa-linkedin" style=" background: #007BB6;"></i> 
                        </a>
                        <a href="https://twitter.com/home?status={{ url('read/article/'.$record->writingId ) }}">
                            <i class="fa fa-twitter" style="background: #15B4FD;"></i> 
                        </a>
                        <a href="https://plus.google.com/share?url={{ url('read/article/'.$record->writingId ) }}">
                            <i class="fa fa-google-plus" style="background: #F63E28;"></i> 
                        </a>
                    </div>
                </div>
                <div>{!! $record->description !!}</div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="rd-author">
                            <form id="{{ $record->writingId }}">
                                <img src="{{ url('profile-photos/'.$record->profilePhoto) }}" class="img-circle" alt="{{ $record->firstName }}">
                                <div class="rd-author-details" style="width: 90%">
                                    <h5><a href="{{ url('account/employer/application/applicant/'.$record->userId) }}">{{ $record->firstName.' '.$record->lastName }}</a></h5>
                                    <span>@if(app()->getLocale() == "kr")
                                        {{ date('Y-m-d',strtotime($record->createdTime))}}
                                    @else
                                        {{ date('M d, Y',strtotime($record->createdTime))}}
                                    @endif</span>
                                    <span class="pull-right"><i class="like fa fa-heart <?php echo JobCallMe::getUserLikes( $record->writingId,Session::get('jcmUser')->userId,'read' ) ?>"></i> <i class="total-likes"><?php echo JobCallMe::getReadlikes($record->writingId,'read')?></i>
                                    </span>
                                </div>
                                <input type="hidden" class="post_id" value="{{ $record->writingId}}">
                                <input type="hidden" class="userId" value="{{  Session::get('jcmUser')->userId }}">
                            </form>
                        </div>
                    </div>      
                </div>
                
                <hr>
                <div class="row">
                    <div class="col-md-12">
                        <hr>
                        <div class="review-header">
							<span class="bell">
								<i class="fa fa-bell fa-3x"></i>
								<span class="badge bell-badge">{{ count($comments) }}</span>
							</span>
							<span class="pull-right"><button onclick="changebtn(this)" id="clickreview" class="btn btn-primary" style="box-shadow: 0px 1px 13px rgba(0,0,0,0.5)">@lang('home.open review') <i class="fa fa-plus"></i> </button></span>
							
						</div>
                        <br>
                        <div id="show_review" style="display:none">
                        <div class="row">
                            <div class="" id="put-comments">
                                @foreach($comments as $comment)
                                <?php  if($comment->nickName == null){
                                        $username = $comment->firstName;
                                    }
                                    else{
                                    $username = $comment->nickName;
                                    } 

                                    if($comment->chatImage){
                                        $userimage = $comment->chatImage;
                                    }
                                    else{
                                    $userimage = $comment->profileImage;
                                    } 

                                    ?>

                                <div class="row" id="{{$comment->comment_id}}">
                                    <div class="col-md-12">
                                        <div class="comment-area">
                                            <div class="col-md-1 col-xs-3">
                                                <img src="{{ url('profile-photos').'/'.$comment->chatImage }}" class="" alt="{{ $comment->firstName }}" style="width:80%;">
                                               
                                            </div>
                                            <div class="col-md-9 col-xs-7 append-edit" style="padding: 0;">
                                             <a href="{{url('account/employer/application/applicant/'.$comment->userId)}}">{{ $username }}</a> <span style="color: #999999;font-size: 10px;">{{ $comment->comment_date}}</span>
                                                <p style="padding: 5px;min-height: 50px;">{{ $comment->comment}}</p>

                                            </div>
                                            @if($comment->commenter_id == Session::get('jcmUser')->userId)
                                            <div class="col-md-2 col-xs-2" style="padding: 0;">
                                                <div class="btns">
                                                <i class="fa fa-edit edit-comment-btn"></i>
                                                <i delcommentId="{{ $comment->comment_id}}" class="fa fa-trash del-comment-btn" aria-hidden="true"></i>
                                                    
                                                </div>
                                                <div class="btns-update" style="display: none">
                                                    <button commentId="{{ $comment->comment_id}}" class="btn btn-success update-comment-btn">Update</button>
                                                    <button class="btn btn-danger cancel">Cancel</button>
                                                </div>
                                            </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <hr>
                                <?php 
                                  if(Session::get('jcmUser')->chatImage){
                                        $userimages = Session::get('jcmUser')->chatImage;
                                    }
                                    else{
                                    $userimages = Session::get('jcmUser')->profilePhoto;
                                    } 

                                    ?>
                                    <div class="comment-box">
                                        <div class="col-md-1 col-xs-3" >
                                            <img src="{{ url('profile-photos').'/'.$userimages }}" class="img-circle fullwidth" alt="{{ Session::get('jcmUser')->firstName }}">
                                        </div>
                                        <div class="col-md-9 col-xs-9" style="padding:0px;">
                                            <div class="form-group">
                                                <textarea name="comment" id="comment" class="form-control" rows="3"></textarea>
                                            </div>
                                            <p style="color: #999999;">if you need more discus you may use jobcallme Live video and chat which you can use multi video and chat</p>    
                                        </div>

                                        <div class="col-md-2 col-xs-offset-8" style="padding-top: 15px;"><button class="btn btn-success" id="comment-btn">Submit</button></div>
                                    </div>    
                                </div>
                            </div>                
                                                    
                    </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3 follow-companies-side">
            <div class="ld-right">
                <div class="follow-companies2">
                    <h4>You May Also Like</h4>
                </div>
			   @foreach($Qry as $rec)
					   <?php
                        
                        if($rec->wIcon != '' && $rec->wIcon != NULL){
                            $pImage = url('article-images/'.$rec->wIcon);
                        }
						else{
							$pImage = url('profile-photos/profile-1516811529-515092.png');
						}
                        ?>
                    <div class="course-sideBar">
					 <div class="col-md-3 col-xs-3 sp-item-img">
                        <img src="{{ $pImage }}">
						</div>
						 <div class="col-md-9 col-xs-9">
                        <div class="sr-details">
                            <p class="sr-title"><a href="{{ url('read/article/'.$rec->writingId ) }}">{!! $rec->title !!} </a> </p>
                            <p class="sr-author"><a href="{{ url('read/article/'.$rec->writingId ) }}"><span class="glyphicon glyphicon-user"></span>@lang('home.read_writer') <span style="color:#337ab7">{{ $rec->firstName.' '.$rec->lastName }}</a> </p>
                        </div>
						</div>
                    </div>
					   @endforeach
                
            </div>
        </div>
    </div>
<script type="text/custom-template" id="edit">
    <div class="form-group">
        <textarea name="comment" id="comment-edit" class="form-control" rows="3"></textarea>
    </div>
</script>
<script src="{{ asset('js/app.js')}}"></script>
</section>
@endsection
@section('page-footer')
<script type="text/javascript">
/*$('#clickreview').click(function(){
$("#show_review").toggle();

});
*/
function changebtn(current){
    if($(current).hasClass('btn-primary')){
        $(current).removeClass('btn-primary').addClass('btn-danger');
        $(current).html('@lang("home.close review") <i class="fa fa-minus"></i>');
        $('#show_review').show();
    }else{
        $(current).removeClass('btn-danger').addClass('btn-primary');
        $(current).html('@lang("home.open review") <i class="fa fa-plus"></i>');
        $('#show_review').hide();
    }
}

    
    $(document).on("click",".edit-comment-btn",function(){
        $('.btns').show();
        $('.btns-update').hide();
        $('.append-edit p').show();
        $('#comment-edit').remove();
        var text = $(this).closest('.comment-area').find('.append-edit p').text();
        $(this).closest('.comment-area').find('.append-edit').append($('#edit').html());
        $(this).closest('.comment-area').find('#comment-edit').val($.trim(text));
        $(this).closest('.comment-area').find('#comment-edit').parent().siblings().hide();
        $(this).closest('.comment-area').find('.btns').hide();
        $(this).closest('.comment-area').find('.btns-update').show();

    })
    $(document).on("click",".cancel",function(){
        $('.append-edit p').show();
        $('#comment-edit').remove();
        $(this).closest('.comment-area').find('.btns').show();
        $(this).closest('.comment-area').find('.btns-update').hide();

    })
    $(document).on("click","#comment-btn",function(){
        var check = "{{ Session::get('jcmUser')->userId }}";
        if(check == ''){
            window.location.href=jsUrl()+"/account/login";
        }else{
           var comment = $('#comment').val();
           var commenter_id ="{{Session::get('jcmUser')->userId}}";
           $.ajax({
               url:jsUrl()+"/read/article/comment/save",
               type:"post",
               data:{table_name:"read",comment:comment,post_id:{{ $record->writingId }},_token:jsCsrfToken(),commenter_id:commenter_id,type:"insert"},
               success:function(res){
                var obj = jQuery.parseJSON(res)
                $('#'+obj.comment_id).find('.comment-area').append(obj.temp);
                $('#comment').val('');
               }
           }) 

        }
    })
    $(document).on("click",".del-comment-btn",function(){
       var comment_id = $(this).attr('delcommentId');
        if (confirm("Are you sure to delete!")) {
             $.ajax({
               url:jsUrl()+"/read/article/comment/save",
               type:"post",
               data:{table_name:"read",post_id:{{ $record->writingId }},_token:jsCsrfToken(),comment_id:comment_id,type:"delete"},
               success:function(res){
                   
               }
            }) 
          } else {
              
        }
    })
    $(document).on("click",".update-comment-btn",function(){
         var comment_id = 0;
        var comment = $('#comment-edit').val();
        comment_id = $(this).attr('commentId');
        var current = $(this);
       
        $.ajax({
            url:jsUrl()+"/read/article/comment/save",
            type:"post",
            data:{table_name:"read",comment:comment,post_id:{{ $record->writingId }},comment_id:comment_id,_token:jsCsrfToken(),type:'edit'},
            success:function(res){
                $(current).closest('.row').remove();
                var obj = jQuery.parseJSON(res)
                $('#'+obj.comment_id).find('.comment-area').append(obj.temp);
            }
        })
    })
$('i.fa').hover(function () {
    $(this).addClass('animated bounceIn').one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend',
    function () {
        $(this).removeClass('animated bounceIn');
    });
});
$('.like').on('click',function(){
    var id = '#'+$(this).closest('form').attr('id');
    var type = "like";
    if($(this).hasClass('fa-red')){
        $(this).removeClass('fa-red');
        var likes = $(id+' .total-likes').text();
        likes = +likes - 1;
        $(id+' .total-likes').text(likes);
        type = "dislike";
    }else{
        $(this).addClass('fa-red');
        var likes = $(id+' .total-likes').text();
        likes = +likes + 1;
        $(id+' .total-likes').text(likes);
    }
    var post_id = $(id+' .post_id').val();
    var userId = $(id+' .userId').val();
    
    $.ajax({
        url:jsUrl()+"/read/likes/"+type,
        type:"post",
        data:{parent_table:"read",post_id:post_id,user_id:userId,_token:"{{ csrf_token() }}"},
        success:function(res){

        }
    });
});
</script>
@endsection