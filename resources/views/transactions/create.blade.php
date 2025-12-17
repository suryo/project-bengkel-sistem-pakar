@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-12 margin-tb mb-4">
            <div class="d-flex justify-content-between align-items-center">
                <h2>New Transaction</h2>
                <a class="btn btn-secondary" href="{{ route('transactions.index') }}"> Back</a>
            </div>
        </div>
    </div>

    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('transactions.store') }}" method="POST">
        @csrf
        <div class="row">
            <!-- Customer Info -->
            <div class="col-md-4">
                <div class="card shadow-sm mb-4">
                    <div class="card-header bg-primary text-white">Customer Info</div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label class="form-label">Customer Name</label>
                            <input type="text" name="customer_name" class="form-control" required value="{{ old('customer_name') }}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Phone</label>
                            <input type="text" name="customer_phone" class="form-control" value="{{ old('customer_phone') }}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Vehicle Model</label>
                            <input type="text" name="vehicle_model" class="form-control" placeholder="e.g. Honda Beat" value="{{ old('vehicle_model') }}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">License Plate</label>
                            <input type="text" name="license_plate" class="form-control" style="text-transform: uppercase;" value="{{ old('license_plate') }}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Notes</label>
                            <textarea name="notes" class="form-control" rows="3">{{ old('notes') }}</textarea>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Items -->
            <div class="col-md-8">
                <div class="card shadow-sm mb-4">
                    <div class="card-header bg-success text-white">Service & Parts</div>
                    <div class="card-body">
                        <table class="table" id="items_table">
                            <thead>
                                <tr>
                                    <th>Type</th>
                                    <th>Item</th>
                                    <th width="100px">Qty</th>
                                    <th width="50px"></th>
                                </tr>
                            </thead>
                            <tbody id="items_container">
                                <!-- Items will be added here via JS -->
                            </tbody>
                        </table>
                        <button type="button" class="btn btn-secondary btn-sm" onclick="addItem()">+ Add Item</button>
                    </div>
                </div>

                <div class="text-end">
                    <button type="submit" class="btn btn-primary btn-lg">Complete Transaction</button>
                </div>
            </div>
        </div>
    </form>
</div>

<script>
    let itemIndex = 0;
    const parts = @json($spareParts);
    const services = @json($services);

    function addItem() {
        const container = document.getElementById('items_container');
        const row = document.createElement('tr');
        
        let partOptions = '<option value="">Select Part</option>';
        parts.forEach(p => {
            partOptions += `<option value="${p.id}">${p.name} (Stok: ${p.stock}) - Rp ${p.price}</option>`;
        });

        let serviceOptions = '<option value="">Select Service</option>';
        services.forEach(s => {
            serviceOptions += `<option value="${s.id}">${s.name} - Rp ${s.price}</option>`;
        });

        row.innerHTML = `
            <td>
                <select name="items[${itemIndex}][type]" class="form-control type-select" onchange="updateItemOptions(this, ${itemIndex})" required>
                    <option value="part">Spare Part</option>
                    <option value="service">Service</option>
                </select>
            </td>
            <td>
                <select name="items[${itemIndex}][id]" class="form-control item-select" required>
                    ${partOptions}
                </select>
            </td>
            <td>
                <input type="number" name="items[${itemIndex}][quantity]" class="form-control" value="1" min="1" required>
            </td>
            <td>
                <button type="button" class="btn btn-danger btn-sm" onclick="this.closest('tr').remove()">x</button>
            </td>
        `;
        container.appendChild(row);
        itemIndex++;
    }

    function updateItemOptions(select, index) {
        const type = select.value;
        const row = select.closest('tr');
        const itemSelect = row.querySelector('.item-select');
        
        itemSelect.innerHTML = '';
        
        if (type === 'part') {
            let options = '<option value="">Select Part</option>';
            parts.forEach(p => {
                options += `<option value="${p.id}">${p.name} (Stok: ${p.stock}) - Rp ${p.price}</option>`;
            });
            itemSelect.innerHTML = options;
        } else {
            let options = '<option value="">Select Service</option>';
            services.forEach(s => {
                options += `<option value="${s.id}">${s.name} - Rp ${s.price}</option>`;
            });
            itemSelect.innerHTML = options;
        }
    }

    // Add initial item
    document.addEventListener('DOMContentLoaded', function() {
        addItem();
    });
</script>
@endsection
