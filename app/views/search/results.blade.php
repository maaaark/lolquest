@extends('templates.default')
@section('title', 'Search Result')
@section('content')
	<br/>
	<table class="table table-striped">
	<tr>
                <th colspan="2">{{ trans("users.summoner_name") }}</th>
		<th>{{ trans("users.region") }}</th>
		<th>{{ trans("users.level_profile") }}</th>
                <th>{{ trans("search.current_rang") }}<br /><small>{{ trans("search.this_month") }}</small></th>
		<th>{{ trans("search.quests") }}<br /><small>{{ trans("search.this_month") }}</small></th>
		<th>{{ trans("search.total_exp") }}<br /><small>{{ trans("search.this_month") }}</small></th>
	</tr>
        
        @if (count($users) >= 1)
            @foreach($users as $user)
                <tr>
					@if($user->summoner)
                    <td style="width: 30px;"><img src="/img/profileicons/profileIcon{{ $user->summoner->profileIconId }}.jpg" width="30" class="img-circle" /></td>
					<td><a href="/summoner/{{ $user->region }}/{{ $user->summoner_name }}">{{ $user->summoner->name }}</a></td>
					@else
					<td style="width: 30px;">-</td>
					<td><a href="/summoner/{{ $user->region }}/{{ $user->summoner_name }}">{{ $user->summoner_name }}</a></td>
					@endif
                    
			<td>{{ $user->region }}</td>
			<td>{{ $user->level_id }}</td>
                        @if($user->ladder_rang($user->id))
			<td>{{ $user->ladder_rang($user->id)->rang }}</td>
			<td>{{ $user->ladder_rang($user->id)->total_quests }}</td>
			<td>{{ $user->ladder_rang($user->id)->month_exp }}</td>
                        @else
                        <td> - </td>
                        <td> - </td>
                        <td> - </td>
                        @endif
		</tr>
            @endforeach
        @else
            <tr>
                <td colspan="7" style="text-align: center;"> {{ trans("search.no_result") }} </td>
            </tr>
        @endif
        
        
	
	</table>
@stop