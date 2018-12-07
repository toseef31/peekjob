<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use DB;
use Session;

class comments implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
     public $comment;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($comment,$data,$id,$type)
    {

        $row ='';
        $username='';
        $url = url('profile-photos/');
        $link = url('/account/employer/application/applicant');
            
            if($comment->nickName == null){
                $username = $comment->firstName;
            }
            else{
              $username = $comment->nickName;
            }

    $row .= '<div class="row" id="'.$comment->comment_id.'">
                <div class="col-md-12">
                    <div class="comment-area">
                        <div class="col-md-1 col-xs-3">
                            <img src="'.$url.'/'.$comment->chatImage.'" class="" alt="'.$comment->firstName.'" style="width:80%;">
                             
                        </div>
                        <div class="col-md-9 col-xs-7 append-edit" style="padding: 0px;">
                        <a href="'.$link.'/'.$comment->userId.'">'.$username.'</a> <span style="color: #999999;font-size: 10px;">'.$comment->comment_date.'</span>
                            <p style="padding: 5px;min-height: 50px;">'.$comment->comment.'</p>

                        </div>
                    </div>
                </div>
            </div>';
            $data = array('html'=>$row,'comment_id'=>$id,'type'=>$type,'commenter_id'=>$comment->commenter_id);
        $this->comment = $data;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return Channel|array
     */
    public function broadcastOn()
    {
        return new Channel('comments');
    }
}
