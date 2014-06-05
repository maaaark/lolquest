@extends('templates.default')
@section('title', trans("forum.forum"))
@section('content')
<br/>
	@foreach($groups as $group)
		<div class="forum_category">
			<div class="forum_headline">{{ $group->name }}</div>
			<table class="table table-striped" style="margin-bottom: 0;">
				<tr style="background: #5a5a5a !important;">
					<th>Category</th>
					<th>Topics</th>
					<th>Last activity</th>
				</tr>
				@foreach($group->categories as $category)
				<tr>
					<td><a href="/forum/{{ $category->url_name }}">{{ $category->name }}</a></td>
					<td>{{ $category->topics->count() }}</td>
					<td>{{ $category->updated_at->diffForHumans() }}</td>
				</tr>
				@endforeach
			</table>
		</div>
	@endforeach
@stop