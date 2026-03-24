@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="dashboard-container">
    <!-- Welcome Section -->
    <div class="welcome-section">
        <div class="welcome-card">
            <div class="welcome-header">
                <div class="profile-avatar">
                    <i class="fas fa-user-circle"></i>
                </div>
                <div class="welcome-text">
                    <h1>Bine ai revenit, {{ Auth::user()->name }}!</h1>
                    <p>Ești conectat în siguranță la profilul tău</p>
                    @if(Auth::user()->isAdmin())
                        <span class="admin-badge">
                            <i class="fas fa-crown"></i>
                            Administrator
                        </span>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="quick-actions">
        <h2>Acțiuni Rapide</h2>
        <div class="actions-grid">
            @if(Auth::user()->isAdmin())
                <a href="{{ route('admin.dashboard') }}" class="action-card admin-card">
                    <div class="action-icon">
                        <i class="fas fa-crown"></i>
                    </div>
                    <div class="action-content">
                        <h3>Panou Admin</h3>
                        <p>Gestionați utilizatorii și platforma</p>
                    </div>
                    <div class="action-arrow">
                        <i class="fas fa-chevron-right"></i>
                    </div>
                </a>
            @endif

            <a href="{{ route('news.index') }}" class="action-card">
                <div class="action-icon">
                    <i class="fas fa-newspaper"></i>
                </div>
                <div class="action-content">
                    <h3>Știri</h3>
                    <p>Gestionați știrile și articolele</p>
                </div>
                <div class="action-arrow">
                    <i class="fas fa-chevron-right"></i>
                </div>
            </a>

            <a href="{{ route('news.create') }}" class="action-card">
                <div class="action-icon">
                    <i class="fas fa-plus-circle"></i>
                </div>
                <div class="action-content">
                    <h3>Adaugă Știre</h3>
                    <p>Creați o știre nouă</p>
                </div>
                <div class="action-arrow">
                    <i class="fas fa-chevron-right"></i>
                </div>
            </a>
        </div>
    </div>

    <!-- User Stats -->
    <div class="stats-section">
        <h2>Informații Profil</h2>
        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-icon">
                    <i class="fas fa-user"></i>
                </div>
                <div class="stat-content">
                    <h3>{{ Auth::user()->name }}</h3>
                    <p>Nume utilizator</p>
                </div>
            </div>

            <div class="stat-card">
                <div class="stat-icon">
                    <i class="fas fa-envelope"></i>
                </div>
                <div class="stat-content">
                    <h3>{{ Auth::user()->email }}</h3>
                    <p>Adresă email</p>
                </div>
            </div>

            <div class="stat-card">
                <div class="stat-icon">
                    <i class="fas fa-calendar-alt"></i>
                </div>
                <div class="stat-content">
                    <h3>{{ Auth::user()->created_at->format('d M Y') }}</h3>
                    <p>Membru din</p>
                </div>
            </div>

            <div class="stat-card">
                <div class="stat-icon">
                    <i class="fas fa-clock"></i>
                </div>
                <div class="stat-content">
                    <h3>{{ Auth::user()->created_at->diffForHumans() }}</h3>
                    <p>Cont creat</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
.dashboard-container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 2rem;
}

.welcome-section {
    margin-bottom: 3rem;
}

.welcome-card {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    border-radius: 16px;
    padding: 2rem;
    box-shadow: 0 8px 32px rgba(102, 126, 234, 0.3);
}

.welcome-header {
    display: flex;
    align-items: center;
    gap: 1.5rem;
}

.profile-avatar {
    font-size: 4rem;
    opacity: 0.9;
}

.welcome-text h1 {
    font-size: 2.5rem;
    margin: 0 0 0.5rem 0;
    font-weight: 700;
}

.welcome-text p {
    margin: 0;
    font-size: 1.2rem;
    opacity: 0.9;
}

.quick-actions {
    margin-bottom: 3rem;
}

.quick-actions h2 {
    font-size: 1.8rem;
    color: #2c3e50;
    margin-bottom: 1.5rem;
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.quick-actions h2 i {
    color: #667eea;
}

.actions-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 1.5rem;
}

.action-card {
    background: white;
    border-radius: 12px;
    padding: 1.5rem;
    text-decoration: none;
    color: inherit;
    display: flex;
    align-items: center;
    gap: 1rem;
    transition: all 0.3s ease;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
    border: 1px solid #e0e0e0;
}

.action-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 30px rgba(0, 0, 0, 0.15);
    border-color: #667eea;
}

.action-icon {
    width: 60px;
    height: 60px;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 1.5rem;
}

.action-content h3 {
    margin: 0 0 0.25rem 0;
    color: #2c3e50;
    font-size: 1.2rem;
}

.action-content p {
    margin: 0;
    color: #7f8c8d;
    font-size: 0.9rem;
}

.action-arrow {
    margin-left: auto;
    color: #cbd5e0;
    transition: all 0.3s ease;
}

.action-card:hover .action-arrow {
    color: #667eea;
    transform: translateX(5px);
}

.admin-card {
    background: linear-gradient(135deg, #ffd700 0%, #ffb347 100%);
    border: 1px solid #ffd700;
    box-shadow: 0 4px 20px rgba(255, 215, 0, 0.2);
}

.admin-card:hover {
    box-shadow: 0 8px 30px rgba(255, 215, 0, 0.3);
    border-color: #ffb347;
}

.admin-card .action-icon {
    background: linear-gradient(135deg, #ffd700 0%, #ffb347 100%);
}

.admin-card .action-content h3 {
    color: #2c3e50;
}

.admin-card:hover .action-arrow {
    color: #ffd700;
}

.stats-section h2 {
    font-size: 1.8rem;
    color: #2c3e50;
    margin-bottom: 1.5rem;
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.stats-section h2 i {
    color: #667eea;
}

.stats-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 1.5rem;
}

.stat-card {
    background: white;
    border-radius: 12px;
    padding: 1.5rem;
    display: flex;
    align-items: center;
    gap: 1rem;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
    border: 1px solid #e0e0e0;
    transition: all 0.3s ease;
}

.stat-card:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 25px rgba(0, 0, 0, 0.12);
}

.stat-icon {
    width: 50px;
    height: 50px;
    background: #f8f9fa;
    border-radius: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #667eea;
    font-size: 1.2rem;
}

.stat-content h3 {
    margin: 0 0 0.25rem 0;
    color: #2c3e50;
    font-size: 1.1rem;
    font-weight: 600;
}

.stat-content p {
    margin: 0;
    color: #7f8c8d;
    font-size: 0.9rem;
}

.admin-badge {
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    background: linear-gradient(135deg, #ffd700 0%, #ffb347 100%);
    color: #2c3e50;
    padding: 0.5rem 1rem;
    border-radius: 20px;
    font-size: 0.9rem;
    font-weight: 600;
    margin-top: 0.5rem;
    box-shadow: 0 2px 10px rgba(255, 215, 0, 0.3);
}

.admin-badge i {
    color: #2c3e50;
}

@media (max-width: 768px) {
    .dashboard-container {
        padding: 1rem;
    }

    .welcome-header {
        flex-direction: column;
        text-align: center;
        gap: 1rem;
    }

    .welcome-text h1 {
        font-size: 2rem;
    }

    .actions-grid, .stats-grid {
        grid-template-columns: 1fr;
    }

    .action-card, .stat-card {
        padding: 1rem;
    }

    .action-content h3 {
        font-size: 1.1rem;
    }
}
</style>
@endpush