@extends('layouts.app')

@section('content')
    <h1>Edit Consultant</h1>
    <form method="POST" action="{{ route('consultant.update', $consultant->id) }}">
        @csrf
        @method('PUT')
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" value="{{ $consultant->name }}"><br><br>
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" value="{{ $consultant->email }}"><br><br>
        <label for="phone">Phone:</label>
        <input type="text" id="phone" name="phone" value="{{ $consultant->phone }}"><br><br>
        <label for="designation">Designation:</label>
        <input type="text" id="designation" name="designation" value="{{ $consultant->designation }}"><br><br>
        <input type="submit" value="Update Consultant">
    </form>
@endsection
