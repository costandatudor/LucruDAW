@extends('layouts.app')

@section('title', 'Admin Dashboard')

@section('content')
<div class="admin-dashboard">
    <div class="dashboard-header">
        <h1 class="page-title">
            <i class="fas fa-crown"></i>
            Panou Administrator
        </h1>
        <p class="page-subtitle">Gestionați utilizatorii și conținutul platformei</p>
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            <i class="fas fa-check-circle"></i>
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-error">
            <i class="fas fa-exclamation-triangle"></i>
            {{ session('error') }}
        </div>
    @endif

    <!-- Statistics Cards -->
    <div class="stats-grid">
        <div class="stat-card">
            <div class="stat-icon users">
                <i class="fas fa-users"></i>
            </div>
            <div class="stat-content">
                <h3>{{ $stats['total_users'] }}</h3>
                <p>Total Utilizatori</p>
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-icon admins">
                <i class="fas fa-user-shield"></i>
            </div>
            <div class="stat-content">
                <h3>{{ $stats['admin_users'] }}</h3>
                <p>Administratori</p>
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-icon regular">
                <i class="fas fa-user"></i>
            </div>
            <div class="stat-content">
                <h3>{{ $stats['regular_users'] }}</h3>
                <p>Utilizatori Normali</p>
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-icon news">
                <i class="fas fa-newspaper"></i>
            </div>
            <div class="stat-content">
                <h3>{{ $stats['total_news'] }}</h3>
                <p>Total Știri</p>
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-icon published">
                <i class="fas fa-globe"></i>
            </div>
            <div class="stat-content">
                <h3>{{ $stats['published_news'] }}</h3>
                <p>Știri Publicate</p>
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-icon drafts">
                <i class="fas fa-clock"></i>
            </div>
            <div class="stat-content">
                <h3>{{ $stats['total_news'] - $stats['published_news'] }}</h3>
                <p>Ciorne</p>
            </div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="quick-actions">
        <h2>Acțiuni Rapide</h2>
        <div class="actions-grid">
            <a href="{{ route('admin.users.create') }}" class="action-card">
                <div class="action-icon">
                    <i class="fas fa-user-plus"></i>
                </div>
                <div class="action-content">
                    <h3>Adaugă Utilizator</h3>
                    <p>Creează un cont nou</p>
                </div>
            </a>

            <a href="{{ route('admin.users') }}" class="action-card">
                <div class="action-icon">
                    <i class="fas fa-users-cog"></i>
                </div>
                <div class="action-content">
                    <h3>Gestionare Utilizatori</h3>
                    <p>Vezi și editează toți utilizatorii</p>
                </div>
            </a>

            <a href="{{ route('news.create') }}" class="action-card">
                <div class="action-icon">
                    <i class="fas fa-plus-circle"></i>
                </div>
                <div class="action-content">
                    <h3>Adaugă Știre</h3>
                    <p>Creează o știre nouă</p>
                </div>
            </a>

            <a href="{{ route('news.index') }}" class="action-card">
                <div class="action-icon">
                    <i class="fas fa-newspaper"></i>
                </div>
                <div class="action-content">
                    <h3>Gestionare Știri</h3>
                    <p>Vezi și editează știrile</p>
                </div>
            </a>
        </div>
    </div>

    <!-- Recent Activity -->
    <div class="recent-activity">
        <div class="activity-section">
            <h2>Utilizatori Recenți</h2>
            <div class="activity-list">
                @forelse($recentUsers as $user)
                    <div class="activity-item">
                        <div class="activity-avatar">
                            {{ strtoupper(substr($user->name, 0, 1)) }}
                        </div>
                        <div class="activity-content">
                            <h4>{{ $user->name }}</h4>
                            <p>{{ $user->email }}</p>
                            <span class="activity-time">{{ $user->created_at->diffForHumans() }}</span>
                        </div>
                        <div class="activity-badge {{ $user->role }}">
                            {{ $user->role === 'admin' ? 'Admin' : 'User' }}
                        </div>
                    </div>
                @empty
                    <p class="no-activity">Nu există utilizatori recent înregistrați.</p>
                @endforelse
            </div>
        </div>

        <div class="activity-section">
            <h2>Știri Recente</h2>
            <div class="activity-list">
                @forelse($recentNews as $news)
                    <div class="activity-item">
                        <div class="activity-avatar">
                            <i class="fas fa-newspaper"></i>
                        </div>
                        <div class="activity-content">
                            <h4>{{ Str::limit($news->title, 50) }}</h4>
                            <p>{{ Str::limit($news->excerpt ?? strip_tags($news->content), 80) }}</p>
                            <span class="activity-time">{{ $news->created_at->diffForHumans() }}</span>
                        </div>
                        <div class="activity-badge {{ $news->published ? 'published' : 'draft' }}">
                            {{ $news->published ? 'Publicat' : 'Ciornă' }}
                        </div>
                    </div>
                @empty
                    <p class="no-activity">Nu există știri recente.</p>
                @endforelse
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
.admin-dashboard {
    max-width: 1400px;
    margin: 0 auto;
    padding: 2rem;
}

.dashboard-header {
    text-align: center;
    margin-bottom: 3rem;
}

.page-title {
    font-size: 3rem;
    color: #2c3e50;
    margin: 0;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 0.5rem;
}

.page-title i {
    color: #f39c12;
}

.page-subtitle {
    color: #7f8c8d;
    margin: 0.5rem 0 0 0;
    font-size: 1.2rem;
}

.stats-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
    gap: 1.5rem;
    margin-bottom: 3rem;
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
    transform: translateY(-5px);
    box-shadow: 0 8px 30px rgba(0, 0, 0, 0.15);
}

.stat-icon {
    width: 60px;
    height: 60px;
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.5rem;
    color: white;
}

.stat-icon.users { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); }
.stat-icon.admins { background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%); }
.stat-icon.regular { background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%); }
.stat-icon.news { background: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%); }
.stat-icon.published { background: linear-gradient(135deg, #fa709a 0%, #fee140 100%); }
.stat-icon.drafts { background: linear-gradient(135deg, #a8edea 0%, #fed6e3 100%); }

.stat-content h3 {
    margin: 0 0 0.25rem 0;
    color: #2c3e50;
    font-size: 2rem;
    font-weight: 700;
}

.stat-content p {
    margin: 0;
    color: #7f8c8d;
    font-size: 0.9rem;
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
    width: 50px;
    height: 50px;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    border-radius: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 1.2rem;
}

.action-content h3 {
    margin: 0 0 0.25rem 0;
    color: #2c3e50;
    font-size: 1.1rem;
}

.action-content p {
    margin: 0;
    color: #7f8c8d;
    font-size: 0.9rem;
}

.recent-activity {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(400px, 1fr));
    gap: 2rem;
}

.activity-section h2 {
    font-size: 1.5rem;
    color: #2c3e50;
    margin-bottom: 1rem;
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.activity-section h2 i {
    color: #667eea;
}

.activity-list {
    background: white;
    border-radius: 12px;
    overflow: hidden;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
    border: 1px solid #e0e0e0;
}

.activity-item {
    display: flex;
    align-items: center;
    gap: 1rem;
    padding: 1rem;
    border-bottom: 1px solid #f8f9fa;
}

.activity-item:last-child {
    border-bottom: none;
}

.activity-avatar {
    width: 40px;
    height: 40px;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-weight: 600;
    font-size: 0.9rem;
}

.activity-content {
    flex: 1;
}

.activity-content h4 {
    margin: 0 0 0.25rem 0;
    color: #2c3e50;
    font-size: 1rem;
}

.activity-content p {
    margin: 0 0 0.25rem 0;
    color: #7f8c8d;
    font-size: 0.85rem;
}

.activity-time {
    color: #94a3b8;
    font-size: 0.8rem;
}

.activity-badge {
    padding: 0.25rem 0.5rem;
    border-radius: 4px;
    font-size: 0.75rem;
    font-weight: 600;
    text-transform: uppercase;
}

.activity-badge.admin {
    background: #fef3c7;
    color: #92400e;
}

.activity-badge.user {
    background: #dbeafe;
    color: #1e40af;
}

.activity-badge.published {
    background: #d1fae5;
    color: #065f46;
}

.activity-badge.draft {
    background: #fee2e2;
    color: #991b1b;
}

.no-activity {
    padding: 2rem;
    text-align: center;
    color: #7f8c8d;
    margin: 0;
}

@media (max-width: 768px) {
    .admin-dashboard {
        padding: 1rem;
    }

    .page-title {
        font-size: 2rem;
    }

    .stats-grid, .actions-grid {
        grid-template-columns: 1fr;
    }

    .recent-activity {
        grid-template-columns: 1fr;
    }

    .activity-item {
        flex-direction: column;
        text-align: center;
        gap: 0.5rem;
    }
}
</style>
@endpush