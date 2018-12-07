@foreach($result2 as $result)
<option value="{{ $result->subCategoryId2 }}">@lang('home.'.$result->subName)</option>
@endforeach