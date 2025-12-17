@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row mb-4">
        <div class="col-lg-12">
            <div class="d-flex justify-content-between align-items-center">
                <h2>Transaction Details #{{ $transaction->id }}</h2>
                <a class="btn btn-secondary" href="{{ route('transactions.index') }}"> Back</a>
            </div>
        </div>
    </div>

    <div class="row">
        <!-- Transaction Info -->
        <div class="col-md-4">
            <div class="card shadow-sm mb-4">
                <div class="card-header bg-info text-white">General Info</div>
                <div class="card-body">
                    <p><strong>Date:</strong> {{ $transaction->created_at->format('d M Y H:i') }}</p>
                    <p><strong>Customer:</strong> {{ $transaction->customer_name }}</p>
                    <p><strong>Phone:</strong> {{ $transaction->customer_phone ?? '-' }}</p>
                    <p><strong>Vehicle:</strong> {{ $transaction->vehicle_model ?? '-' }}</p>
                    <p><strong>Plate:</strong> {{ $transaction->license_plate ?? '-' }}</p>
                    <p><strong>Status:</strong> <span class="badge bg-secondary">{{ ucfirst($transaction->status) }}</span></p>
                    <p><strong>Notes:</strong> {{ $transaction->notes ?? '-' }}</p>
                </div>
            </div>
        </div>

        <!-- Details -->
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-header bg-light">Items</div>
                <div class="card-body p-0">
                    <table class="table mb-0">
                        <thead>
                            <tr>
                                <th>Item</th>
                                <th>Type</th>
                                <th class="text-center">Qty</th>
                                <th class="text-end">Price</th>
                                <th class="text-end">Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($transaction->transactionDetails as $detail)
                            <tr>
                                <td>{{ $detail->item_name }}</td>
                                <td>
                                    <span class="badge bg-{{ $detail->item_type == 'service' ? 'success' : 'primary' }}">
                                        {{ ucfirst($detail->item_type) }}
                                    </span>
                                </td>
                                <td class="text-center">{{ $detail->quantity }}</td>
                                <td class="text-end">Rp {{ number_format($detail->price, 0, ',', '.') }}</td>
                                <td class="text-end">Rp {{ number_format($detail->subtotal, 0, ',', '.') }}</td>
                            </tr>
                            @endforeach
                            <tr class="table-active fw-bold">
                                <td colspan="4" class="text-end">Total</td>
                                <td class="text-end">Rp {{ number_format($transaction->total_price, 0, ',', '.') }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="mt-4 text-end">
                <button onclick="window.print()" class="btn btn-outline-dark"><i class="bi bi-printer"></i> Print Invoice</button>
            </div>
        </div>
    </div>
</div>
@endsection
