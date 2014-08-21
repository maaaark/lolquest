@extends('templates.default')
@section('title', "Edit your team")
@section('content')
<br/>
{{ Form::open(array('url'=>'teams/update', 'class'=>'', 'files' => true)) }}
<table class="table table-striped">
    <tr>
        <td class="attribute">{{ trans("teams.team_name") }}</td>
        <td>{{ Form::text('teamname', $team->clean_name , array('class'=>'form-control', 'placeholder'=>'Team Name', 'class' => 'form-control')) }}</td>
    </tr>
    <tr>
        <td class="attribute">{{ trans("teams.region") }}</td>
        <td>{{ Form::select('region', array('0' => 'Select a Region', 'euw' => 'EUW', 'na' => 'NA' ), $team->region, array('class' => 'form-control')) }}</td>
    </tr>
    <tr>
        <td class="attribute">{{ trans("teams.website") }}</td>
        <td>{{ Form::text('website', $team->website, array('class'=>'form-control', 'placeholder'=>'http://lolquest.net', 'class' => 'form-control')) }}</td>
    </tr>
    <tr>
        <td class="attribute">{{ trans("teams.logo") }}</td>
        <td>{{ Form::file('logo', null, array('class'=>'form-control', 'placeholder'=>'Logo Upload 100x100 px', 'class' => 'form-control')) }}</td>
    </tr>
    <tr>
        <td class="attribute">{{ trans("teams.description") }}</td>
        <td>{{ Form::textarea('description', $team->description, array('class'=>'form-control', 'placeholder'=>'Team description', 'class' => 'form-control')) }}</td>
    </tr>
</table>
{{ Form::submit('Save changes', array('class'=>'btn btn-success'))}}<br/>
{{ Form::close() }}
@stop