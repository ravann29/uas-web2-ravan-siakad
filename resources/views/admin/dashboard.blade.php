@extends('layouts.admin')

@section('title', 'Admin Dashboard')

@push('styles')
<style>
    .dashboard-wrapper {
        max-width: 1200px;
        margin: 0 auto;
        padding-bottom: 3rem;
    }

    /* Welcome Card - Header Dashboard */
    .welcome-banner {
        background: linear-gradient(135deg, #333 0%, #444 100%);
        border-radius: 16px;
        padding: 2rem;
        color: white;
        margin-bottom: 2rem;
        display: flex;
        justify-content: space-between;
        align-items: center;
        border-bottom: 4px solid #F39C12;
        box-shadow: 0 10px 20px rgba(0,0,0,0.05);
    }

    /* Section Headers */
    .section-label {
        display: flex;
        align-items: center;
        gap: 10px;
        margin-bottom: 1.5rem;
        font-weight: 700;
        color: #333;
        text-transform: uppercase;
        letter-spacing: 1px;
        font-size: 0.9rem;
    }
    .section-label .line {
        flex-grow: 1;
        height: 1px;
        background: #ddd;
    }

    /* Grid Layouts */
    .dashboard-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 1.5rem;
        margin-bottom: 2.5rem;
    }

    /* White Cards */
    .glass-card {
        background: white;
        border-radius: 12px;
        padding: 1.5rem;
        box-shadow: 0 4px 6px rgba(0,0,0,0.02);
        border: 1px solid #edf2f7;
    }

    /* Action Buttons */
    .nav-card-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
        gap: 1rem;
    }

    .nav-card {
        display: flex;
        align-items: center;
        padding: 1rem 1.5rem;
        background: white;
        border-radius: 10px;
        text-decoration: none;
        color: #4a5568;
        font-weight: 600;
        border: 1px solid #e2e8f0;
        transition: all 0.2s ease;
    }

    .nav-card:hover {
        border-color: #F39C12;
        background: #fffaf0;
        color: #F39C12;
        transform: translateY(-2px);
    }

    .nav-card .icon-box {
        width: 40px;
        height: 40px;
        background: #f7fafc;
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-right: 1rem;
        transition: 0.2s;
    }

    .nav-card:hover .icon-box {
        background: #F39C12;
        color: white;
    }

    .badge-status {
        background: rgba(243, 156, 18, 0.1);
        color: #F39C12;
        padding: 4px 12px;
        border-radius: 20px;
        font-size: 0.75rem;
        font-weight: bold;
    }
</style>
@endpush

@section('content')
<div class="dashboard-wrapper">
    
    <div class="welcome-banner">
        <div>
            <h1 class="text-2xl font-bold mb-1">Halo, {{ explode(' ', Auth::user()->name)[0] }}!</h1>
            <p class="text-gray-300 text-sm">Berikut adalah ringkasan sistem akademik hari ini.</p>
        </div>
        <div class="hidden md:block">
            <span class="badge-status">Administrator Mode</span>
        </div>
    </div>

    <div class="section-label">
        <span>Monitoring Real-time</span>
        <div class="line"></div>
    </div>
    
    <div class="mb-10">
        @livewire('dashboard')
    </div>

    <div class="dashboard-grid">

    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
@endpush