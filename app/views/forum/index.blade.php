@extends('templates.default')
@section('title', trans("forum.forum"))
@section('content')
<br/>
	@foreach($groups as $group)
		<div class="forum_category">
			<div class="forum_headline">{{ $group->name }}</div>
			<table class="table table-striped" style="margin-bottom: 0;">
				@foreach($group->categories as $category)
				<tr>
					<td><a href="/forum/{{ $category->url_name }}">{{ $category->name }}</a></td>
					<td>test</td>
				</tr>
				@endforeach
			</table>
		</div>
	@endforeach
@stop