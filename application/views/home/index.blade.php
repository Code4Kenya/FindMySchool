@layout('templates.main')

@section('title')
Find My School | Home
@endsection

@section('navigation')
    @parent
    <li><a href="#">About</a></li>
@endsection

@section('content')
	<?php foreach ($schools as $school) { 
		$school_name_url = str_replace('+', '-', urlencode(strtolower(str_replace('-', '[z]', $school->name))));
	?>
		<a href="/school/profile/{{$school_name_url}}/{{$school->id}}">{{$school->name}}</a><br />
	<?php } ?>
	
@endsection