@extends('templates.default')
@section('title', trans("items.index"))
@section('content')
	<br/>
	<a href="/items">Items</a> > <a href="/items/{{ $item->item_id }}">{{ $item->name }}</a><br/>
	<br/>
	<table class="table">
		<tbody>
				<tr>
					<td width="90"><img src="/img/items/{{ $item->item_id }}_64.png" class="img-circle" ></td>
					<td class="text-left">
						<a href="/items/{{ $item->id }}">{{ $item->name }}</a><br/>
						<br/>
						{{ $item->description }}
					</td>
				</tr>
		</tbody>
	 </table>
@stop