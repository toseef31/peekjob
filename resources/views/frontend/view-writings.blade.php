@extends('frontend.layouts.app')

@section('title', 'Writings')

@section('content')

<section id="read-section">
    <div class="container">
        <div class="col-md-12 learn-search-box" style="padding-top:90px">

            
			<h2 class="text-center">
						@if(app()->getLocale() == "kr")
						    @lang('home.writingheaderHeading')<!-- <div id="hp_text3"></div> --><!-- @lang('home.headerHeading') -->
						@else
						    @lang('home.writingheaderHeading')<!-- <div id="hp_text4"></div> --><!-- @lang('home.headerHeading') -->
						@endif
			</h2>
            
            
        </div>
    </div>
</section>


<section id="postNewJob" style="margin-bottom:50px">
    <div class="container">
        @if(count($writing) > 0)
            <div class="col-md-12">
                <div class="pnj-box">
                    <h3>
                        @lang('home.mywriting') 
                        <a class="btn btn-primary pull-right" href="{{ url('account/writings/article/add') }}" style="border-radius: 50%;margin-top: -5px;">
                            <i class="fa fa-plus"></i>
                        </a>
                    </h3>
                    <div class="col-md-12" style="margin-top:30px;margin-bottom:30px">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <th style="background:#96aaa8;color:#fff;">@lang('home.title')</th>
                                    <th style="background:#96aaa8;color:#fff;">@lang('home.category')</th>
                                    <th style="background:#96aaa8;color:#fff;">@lang('home.status')</th>
                                    <th style="background:#96aaa8;color:#fff;">@lang('home.createdon')</th>
                                    <th style="background:#96aaa8;color:#fff;">@lang('home.action')</th>
                                </thead>
                                <tbody>
                                    @foreach($writing as $write)
                                        <tr id="write-{{ $write->writingId }}">
                                            <td><a href="{{ url('read/article/'.$write->writingId ) }}">{!! $write->title !!}</a></td>
                                            <td><?for($i=0; $i < count($cat_names); $i++){?>@lang('home.'.$cat_names[$i])<?}?></td>
                                            <td>@lang('home.'.$write->status)</td>
                                            <td>@if(app()->getLocale() == "kr")
						    {!! date('Y-m-d',strtotime($write->createdTime)) !!}
						@else
						    {!! date('M d, Y',strtotime($write->createdTime)) !!}
						@endif</td>
                                            <td>
                                                <a href="{{ url('account/writings/article/edit/'.$write->writingId) }}"><i class="fa fa-pencil"></i></a>&nbsp;&nbsp;
                                                <a href="javascript:;" onclick="deleteArticle('{{ $write->writingId }}')"><i class="fa fa-remove"></i></a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        @else
            <div class="col-md-12">
                <div class="pnj-box">
                    <h3><span style="padding-left:15px;">@lang('home.mywriting2')</span></h3>
                    <div class="upskill-box">
                        <p style="font-size:18px">@lang('home.eagerlywaiting2')<!-- @lang('home.creativewriting') --></p>
                        <!-- <p style="font-size:15px;padding-top:20px;"><img src="../frontend-assets/images/info-icon.png"> @lang('home.eagerlywaiting')</p> -->
						<!-- <p style="font-size:15px;padding-bottom:80px;"><img src="../frontend-assets/images/info-icon.png"> @lang('home.eagerlywaiting2')</p> -->
                        <a href="{{ url('account/writings/article/add') }}" class="btn btn-primary">@lang('home.WRITE YOUR FIRST ARTICLE')</a>
						<!-- <p style="font-size:15px;padding-top:30px;"><img src="../frontend-assets/images/info-icon.png"> @lang('home.eagerlywaiting3')</p> -->
						<p style="font-size:15px;padding-top:50px;color:#820923;"><i class="fa fa-exclamation-triangle" aria-hidden="true" style="color:#820923;"></i> @lang('home.eagerlywaiting4')</p>
                    </div>
                </div>
            </div>
        @endif
    </div>
</section>
@endsection
@section('page-footer')
<script type="text/javascript">
function deleteArticle(writingId){
    if(confirm('@lang("home.Are you sure?")')){
        $.ajax({
            url: "{{ url('account/writings/article/delete') }}",
            type:"POST",
            data:{writingId:writingId,_token:"{{ csrf_token() }}"},
            success: function(response){
                if($.trim(response) != '1'){
                    toastr.error(response, '', {timeOut: 5000, positionClass: "toast-top-center"});
                }else{
                    $('#write-'+writingId).remove();
                    toastr.success('@lang("home.Article Deleted")', '', {timeOut: 5000, positionClass: "toast-top-center"});
                }
            }
        })
    }
}
</script>
@endsection