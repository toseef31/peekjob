<option value="">@lang('home.state')</option>
@foreach($cities as $cit)
<option value="{{ $cit->id }}">@lang('home.'.$cit->name)</option>
@endforeach