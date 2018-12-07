@extends('frontend.layouts.app')

@section('title','Job Interview');

@section('content')
<section id="jobs">
    <div class="container">
        <div class="col-md-12 view-venue">
            <div class="panel panel-default">
                <div class="panel-heading">@lang('home.Interview')<!-- @lang('home.jobinterview') --></div>
                <div class="panel-body">
                    <?php
                    $venue = JobCallMe::getVeneue($interview->venueId);
                    $user = JobCallMe::getUser($interview->userId);
                    $company = JobCallMe::getCompany($user->companyId);
                    ?>
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <tbody>
                                <tr>
                                    <th width="50%">@lang('home.job')</th>
                                    <td width="50%"><a href="{{ url('jobs/'.$interview->jobId) }}">{!! $interview->title !!}</a></td>
                                </tr>
                                <tr>
                                    <th width="50%">@lang('home.company')</th>
                                    <td width="50%">{!! $company->companyName !!}</td>
                                </tr>
                                <tr>
                                    <th width="50%">@lang('home.location')</th>
                                    <td width="50%"><a href="http://maps.google.com/?q={!! $venue->address !!}" target="_blank"><i class="fa fa-map-marker"></i>&nbsp;{!! $venue->address !!}</a></td>
                                 </tr>
                                <tr>
                                    <th width="50%">@lang('home.contactperson')</th>
                                    <td width="50%">{!! $venue->contact !!}</td>
                                </tr>
                                <tr>
                                    <th width="50%">@lang('home.email')</th>
                                    <td width="50%">{!! $venue->email !!}</td>
                                </tr>
                                <tr>
                                    <th width="50%">@lang('home.phonenumber')</th>
                                    <td width="50%">{!! $venue->phone !!}</td>
                                </tr>
                                <tr>
                                    <th width="50%">@lang('home.mobile')</th>
                                    <td width="50%">{!! $venue->mobile !!}</td>
                                </tr>
                                <tr>
                                    <th width="50%">@lang('home.interviewdate')</th>
                                    <td width="50%">
                                        <b>@lang('home.date')</b> <i>{{ $interview->fromDate }}</i> @lang('home.to') <i>{{ $interview->toDate }}</i><br>
                                        <b>@lang('home.timing')</b> <i>{{ $interview->time_from }}</i> @lang('home.to') <i>{{ $interview->time_to }}</i>
                                    </td>
                                </tr>
                                <tr>
                                    <th width="50%">@lang('home.instruction')</th>
                                    <td width="50%">{!! $venue->instruction !!}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
@section('page-footer')
<style type="text/css">
</style>
<script type="text/javascript">
var token = "{{ csrf_token() }}";
</script>
@endsection