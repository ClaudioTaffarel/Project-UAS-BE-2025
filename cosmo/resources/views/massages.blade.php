@extends('layouts.app')

@section('title', 'Massages')

@section('content')
<div class="container py-5">
    <div class="row">
        <div class="col-12">
            <h1 class="text-center mb-4">Our Massage Services</h1>
            <p class="text-center lead mb-5">Experience relaxation and rejuvenation with our professional massage therapists</p>
        </div>
    </div>

    <div class="row">
        @forelse($massages as $massage)
        <div class="col-md-4 mb-4">
            <div class="card h-100">
                <div class="card-body">
                    <h3 class="card-title">{{ $massage->name }}</h3>
                    <p class="card-text">{{ $massage->description }}</p>
                    <div class="d-flex justify-content-between align-items-center">
                        <span class="h5 mb-0">{{ $massage->duration }} minutes</span>
                        <span class="h5 mb-0">Rp {{ number_format($massage->price, 0, ',', '.') }}</span>
                    </div>
                    <a href="{{ route('massages.show', $massage->slug) }}" class="btn btn-primary mt-3">Learn More</a>
                </div>
            </div>
        </div>
        @empty
        <div class="col-12">
            <div class="alert alert-info">
                No massage services available at the moment.
            </div>
        </div>
        @endforelse
    </div>

    <div class="row mt-5">
        <div class="col-12">
            <div class="text-center">
                {{ $massages->links() }}
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    // Add any specific JavaScript for this page here
</script>
@endsection