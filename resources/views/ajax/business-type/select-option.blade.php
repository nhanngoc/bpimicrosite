@if($listBusinessTypes->count() > 0)
    @foreach($listBusinessTypes as $key => $bus)
        <option value="{!! $key !!}">{!! $bus !!}</option>
    @endforeach
@else
    <option value=""></option>
@endif
