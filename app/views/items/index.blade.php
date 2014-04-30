@extends('templates.default')
@section('title', trans("items.index"))
@section('content')
	<br/>
	{{ $items->count() }} Items in der Datenbank<br/>
	<table class="table table-striped">
		<tbody>
			@foreach($items as $item)
				<tr>
					<td><img src="/img/items/{{ $item->item_id }}_64.png" class="img-circle" ></td>
					<td class="text-left"><a href="/items/{{ $item->id }}">{{ $item->name }}</a></td>
					<td class="text-left">{{ $item->name_de }}</td>
					<td class="text-left">{{ $item->description }}</td>
				</tr>
			@endforeach
		</tbody>
	 </table>
@stop