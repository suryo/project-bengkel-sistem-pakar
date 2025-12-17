@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-12 margin-tb mb-4">
            <div class="d-flex justify-content-between align-items-center">
                <h2> Show Spare Part</h2>
                <a class="btn btn-secondary" href="{{ route('spare-parts.index') }}"> Back</a>
            </div>
        </div>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">
            <div class="mb-3">
                <strong>Name:</strong>
                {{ $sparePart->name }}
            </div>
            <div class="mb-3">
                <strong>Category:</strong>
                {{ $sparePart->category ? $sparePart->category->name : '-' }}
            </div>
            <div class="mb-3">
                <strong>Stock:</strong>
                {{ $sparePart->stock }}
            </div>
            <div class="mb-3">
                <strong>Price:</strong>
                Rp {{ number_format($sparePart->price, 0, ',', '.') }}
            </div>
            <div class="mb-3">
                <strong>Description:</strong>
                {{ $sparePart->description }}
            </div>
        </div>
    </div>
</div>
@endsection
