
@extends('layouts.template_dashboard')

@section('content')
    <form action="{{route('dashboard.editstuffAction')}}" method="POST">
        @csrf
        <input type="text" name="id" hidden value="{{$materiel->id}}"><br>


        <label for="name">Name</label>
        <input type="text" name="name" value="{{$materiel->name}}"><br>

        <label for="description">Description</label>
        <textarea  name="description" >{{$materiel->description}}</textarea><br>

        <label for="type">Type</label>
        <input type="text" name="type" value="{{$materiel->type}}"><br>

        <label for="state">State</label>
        <select name="state" id="state">
            @if($materiel->state=="usuable")
                <option value="usable"  selected>usable</option>
            @else
                <option value="usable" >usable</option>
            
            @endif
            @if($materiel->state=="tofix")
                <option value="tofix" selected>tofix</option>
            @else
                <option value="tofix">tofix</option>
            @endif

            @if($materiel->state=="toplug")
                <option value="toplug" selected>toplug</option>
            @else
                <option value="toplug">toplug</option>
            
            @endif

        </select> <br>

        <button type="submit">Edit stuff</button>

    </form>


@endsection