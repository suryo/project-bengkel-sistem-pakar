@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <h2 class="mb-4">Dashboard Bengkel</h2>
            
            <div class="row">
                <!-- Spare Parts Card -->
                <div class="col-md-3 mb-4">
                    <div class="card text-white bg-primary h-100">
                        <div class="card-header">Spare Parts</div>
                        <div class="card-body">
                            <h5 class="card-title">{{ $stats['spare_parts'] }} Items</h5>
                            <p class="card-text">Total inventory items.</p>
                            <a href="{{ route('spare-parts.index') }}" class="btn btn-light btn-sm text-primary">Manage</a>
                        </div>
                    </div>
                </div>

                <!-- Services Card -->
                <div class="col-md-3 mb-4">
                    <div class="card text-white bg-success h-100">
                        <div class="card-header">Services</div>
                        <div class="card-body">
                            <h5 class="card-title">{{ $stats['services'] }} Types</h5>
                            <p class="card-text">Available services.</p>
                            <a href="{{ route('services.index') }}" class="btn btn-light btn-sm text-success">Manage</a>
                        </div>
                    </div>
                </div>

                <!-- Categories Card -->
                <div class="col-md-3 mb-4">
                    <div class="card text-white bg-info h-100">
                        <div class="card-header">Categories</div>
                        <div class="card-body">
                            <h5 class="card-title">{{ $stats['categories'] }}</h5>
                            <p class="card-text">Part & Service Categories.</p>
                            <a href="{{ route('categories.index') }}" class="btn btn-light btn-sm text-info">Manage</a>
                        </div>
                    </div>
                </div>

                <!-- Transactions Card -->
                <div class="col-md-3 mb-4">
                    <div class="card text-white bg-warning h-100">
                        <div class="card-header">Transactions Today</div>
                        <div class="card-body">
                            <h5 class="card-title">{{ $stats['transactions'] }}</h5>
                            <p class="card-text">New transactions today.</p>
                            <a href="{{ route('transactions.index') }}" class="btn btn-light btn-sm text-warning">View All</a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card mt-4">
                <div class="card-header">{{ __('Quick Actions') }}</div>
                <div class="card-body">
                    <a href="{{ route('transactions.create') }}" class="btn btn-primary btn-lg">New Transaction</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
