
@foreach($childs as $child)
	
	<option value="{{ $child->mod_id }}">( {{$child->mod_id}} )  {{ $child->mod_name }}  </option>	
	
	@if(count($child->childs))
            @include('moduleChild',['childs' => $child->childs])
    @endif

@endforeach
