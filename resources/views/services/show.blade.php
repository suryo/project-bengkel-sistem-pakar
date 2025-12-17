@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-12 margin-tb mb-4">
            <div class="d-flex justify-content-between align-items-center">
                <h2> Show Service</h2>
                <a class="btn btn-secondary" href="{{ route('services.index') }}"> Back</a>
            </div>
        </div>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">
            <div class="mb-3">
                <strong>Name:</strong>
                {{ $service->name }}
            </div>
            <div class="mb-3">
                <strong>Category:</strong>
                {{ $service->category ? $service->category->name : '-' }}
            </div>
            <div class="mb-3">
                <strong>Price:</strong>
                Rp {{ number_format($service->price, 0, ',', '.') }}
            </div>
            <div class="mb-3">
                <strong>Description:</strong>
                {{ $service->description }}
            </div>
        </div>
    </div>
</div>
@endsection
