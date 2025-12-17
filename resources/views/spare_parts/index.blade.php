@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-12 margin-tb mb-4">
            <div class="d-flex justify-content-between align-items-center">
                <h2>Spare Parts Inventory</h2>
                <a class="btn btn-success" href="{{ route('spare-parts.create') }}"> Add New Item</a>
            </div>
        </div>
    </div>

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p class="mb-0">{{ $message }}</p>
        </div>
    @endif

    <div class="card shadow-sm">
        <div class="card-body p-0">
            <table class="table table-striped table-hover mb-0">
                <thead class="table-light">
                    <tr>
                        <th>No</th>
                        <th>Name</th>
                        <th>Category</th>
                        <th>Stock</th>
                        <th>Price</th>
                        <th width="280px">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($spareParts as $part)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $part->name }}</td>
                        <td>{{ $part->category ? $part->category->name : '-' }}</td>
                        <td>{{ $part->stock }}</td>
                        <td>Rp {{ number_format($part->price, 0, ',', '.') }}</td>
                        <td>
                            <form action="{{ route('spare-parts.destroy', $part->id) }}" method="POST">
                                <a class="btn btn-info btn-sm" href="{{ route('spare-parts.show', $part->id) }}">Show</a>
                                <a class="btn btn-primary btn-sm" href="{{ route('spare-parts.edit', $part->id) }}">Edit</a>
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center">No spare parts found.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    
    <div class="d-flex justify-content-center mt-3">
        {{ $spareParts->links() }}
    </div>
</div>
@endsection
