@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card shadow-lg border-0">
                <div class="card-header bg-gradient bg-primary text-white py-3">
                    <h3 class="mb-0 text-center fw-bold"><i class="bi bi-robot"></i> Sistem Pakar Diagnosa Kerusakan</h3>
                    <p class="mb-0 text-center small text-white-50">Silakan pilih gejala yang dialami kendaraan Anda</p>
                </div>
                <div class="card-body p-4">
                    <form action="{{ route('diagnosis.process') }}" method="POST">
                        @csrf
                        <div class="row">
                            @foreach($symptoms as $symptom)
                            <div class="col-md-6 mb-3">
                                <div class="form-check p-3 border rounded shadow-sm hover-shadow bg-light">
                                    <input class="form-check-input" type="checkbox" name="symptoms[]" value="{{ $symptom->id }}" id="symptom_{{ $symptom->id }}" style="transform: scale(1.2); margin-left: 0.2rem;">
                                    <label class="form-check-label w-100 ms-3 fw-medium cursor-pointer" for="symptom_{{ $symptom->id }}">
                                        <strong>[{{ $symptom->code }}]</strong> {{ $symptom->name }}
                                    </label>
                                </div>
                            </div>
                            @endforeach
                        </div>

                        <div class="text-center mt-4">
                            <button type="submit" class="btn btn-primary btn-lg px-5 rounded-pill shadow-sm">
                                <i class="bi bi-search"></i> Mulai Diagnosa
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.hover-shadow:hover {
    background-color: #e9ecef !important;
    transition: all 0.3s ease;
}
.cursor-pointer {
    cursor: pointer;
}
</style>
@endsection
