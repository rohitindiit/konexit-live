@if(isset($users) && count($users) > 0)
@foreach($users as $key => $value)
	<li>
	<div>
	<h3>{{$value->name}}</h3>
	<p class="mb-0">{{$value->email}}</p>
	</div>
	<a href="javascript:void(0);" class="deleteuserlist" data-id="{{$value->id}}"  data-formid="{{$formid}}">
	<img src="{{url('/')}}/resources/views/Admin/assets/img/delete2.svg"/>
	</a>
	</li>
@endforeach
@else
<li>
	<div>
	<h3>No organization has been assigned this form!!.</h3>
	</div>
	</li>
@endif	