@extends('layouts.app')

@section('content')
    <h1>Consultant Details</h1>
    <p>Name: {{ $consultant->name }}</p>
    <p>Email: {{ $consultant->email }}</p>
    <p>Phone: {{ $consultant->phone }}</p>
    <p>Designation: {{ $consultant->designation }}</p>
    <a href="{{ route('consultants.index') }}">Back to Consultants List</a>
@endsection

