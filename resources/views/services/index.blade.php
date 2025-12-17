@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-12 margin-tb mb-4">
            <div class="d-flex justify-content-between align-items-center">
                <h2>Services Management</h2>
                <a class="btn btn-success" href="{{ route('services.create') }}"> Add New Service</a>
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
                        <th>Price</th>
                        <th>Description</th>
                        <th width="280px">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($services as $service)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $service->name }}</td>
                        <td>{{ $service->category ? $service->category->name : '-' }}</td>
                        <td>Rp {{ number_format($service->price, 0, ',', '.') }}</td>
                        <td>{{ Str::limit($service->description, 50) }}</td>
                        <td>
                            <form action="{{ route('services.destroy', $service->id) }}" method="POST">
                                <a class="btn btn-info btn-sm" href="{{ route('services.show', $service->id) }}">Show</a>
                                <a class="btn btn-primary btn-sm" href="{{ route('services.edit', $service->id) }}">Edit</a>
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center">No services found.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    
    <div class="d-flex justify-content-center mt-3">
        {{ $services->links() }}
    </div>
</div>
@endsection
