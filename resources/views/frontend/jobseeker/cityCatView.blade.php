<option value="">@lang('home.city')</option>
@foreach($cities2 as $cit)
<option value="{{ $cit->id }}">@lang('home.'.$cit->name)</option>
@endforeach