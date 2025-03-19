@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Consultants List</h2>

    <!-- Success Message -->
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <!-- Add Consultant Button -->
    <a href="{{ route('consultants.create') }}" class="btn btn-primary mb-3">Add Consultant</a>

    <!-- Consultants Table -->
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($consultants as $consultant)
                <tr>
                    <td>{{ $consultant->id }}</td>
                    <td>{{ $consultant->name }}</td>
                    <td>{{ $consultant->email }}</td>
                    <td>
                        <!-- Delete Button -->
                        <form action="{{ route('consultants.destroy', $consultant->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this consultant?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
