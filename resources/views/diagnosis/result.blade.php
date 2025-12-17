@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2><i class="bi bi-file-medical"></i> Hasil Diagnosa</h2>
                <a class="btn btn-secondary" href="{{ route('diagnosis.index') }}"> Ulangi Diagnosa</a>
            </div>

            @if($topResult)
                <!-- Top Result Card -->
                <div class="card shadow-lg border-0 mb-5 border-start border-5 border-success">
                    <div class="card-body p-5">
                        <div class="row align-items-center">
                            <div class="col-md-8">
                                <h4 class="text-muted text-uppercase small ls-1">Kemungkinan Kerusakan Terbesar</h4>
                                <h1 class="display-6 fw-bold text-success mb-3">{{ $topResult['diagnosis']->name }}</h1>
                                <p class="lead mb-4">{{ $topResult['diagnosis']->solution }}</p>
                                
                                <div class="p-3 bg-light rounded border">
                                    <h6 class="fw-bold mb-2">Gejala yang cocok:</h6>
                                    <ul class="mb-0 text-muted">
                                        @foreach($topResult['matched_symptoms'] as $symptom)
                                            <li>{{ $symptom }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                            <div class="col-md-4 text-center">
                                <div class="position-relative d-inline-block">
                                    <div class="display-1 fw-bold text-success">{{ $topResult['percentage'] }}%</div>
                                    <div class="text-muted">Tingkat Keyakinan</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Other Possibilities -->
                @if(count($results) > 1)
                    <h4 class="mb-3 text-muted">Kemungkinan Lainnya:</h4>
                    <div class="row">
                        @foreach($results as $index => $result)
                            @if($index === 0) @continue @endif <!-- Skip top result -->
                            <div class="col-md-6 mb-3">
                                <div class="card h-100 border-0 shadow-sm">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between align-items-start">
                                            <h5 class="card-title fw-bold text-dark">{{ $result['diagnosis']->name }}</h5>
                                            <span class="badge bg-secondary">{{ $result['percentage'] }}%</span>
                                        </div>
                                        <p class="card-text text-muted small mb-2">{{ $result['diagnosis']->solution }}</p>
                                        <div class="small text-muted">
                                            <strong>Gejala:</strong> {{ implode(', ', $result['matched_symptoms']) }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif

            @else
                <div class="alert alert-warning p-5 text-center shadow-sm">
                    <h1 class="display-1 text-warning mb-3"><i class="bi bi-question-circle"></i></h1>
                    <h4>Tidak Ada Diagnosa yang Cocok</h4>
                    <p class="lead">Sistem tidak dapat menemukan kerusakan yang cocok dengan gejala yang Anda pilih.</p>
                    <a href="{{ route('diagnosis.index') }}" class="btn btn-warning mt-3">Coba Lagi</a>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
