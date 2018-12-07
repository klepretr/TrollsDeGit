
@extends('layouts.template_dashboard')

@section('content')
    <form action="{{route('dashboard.editagentAction')}}" method="POST">
        @csrf
        <input type="text" name="id" hidden value="{{$agent->id}}"><br>


        <label for="firstname">First Name</label>
        <input type="text" name="firstname" value="{{$agent->firstname}}"><br>

        <label for="lastname">Last Name</label>
        <input type="text" name="lastname" value="{{$agent->lastname}}"><br>

        <label for="gender">Gender</label>
    <select name="gender" value="{{$agent->gender}}">
            <option value="0">Woman</option>
            <option value="1">Man</option>
        </select><br>
        

        <label for="email">Email</label>
        <input type="email" name="email" value="{{$agent->email}}"><br>

        <label for="number">Phone number</label>
        <input type="text" name="phone_number" value="{{$agent->phone_number}}"><br>
        
        <button type="submit">Edit stuff</button>

    </form>


@endsection