@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Create New Consultant</h1>

    <!-- Display validation errors -->
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Consultant Creation Form -->
    <form method="POST" action="{{ route('consultants.store') }}">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Name:</label>
            <input type="text" id="name" name="name" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email:</label>
            <input type="email" id="email" name="email" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="phone" class="form-label">Phone:</label>
            <input type="text" id="phone" name="phone" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="designation" class="form-label">Designation:</label>
            <input type="text" id="designation" name="designation" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-success">Create Consultant</button>
    </form>
</div>
@endsection
