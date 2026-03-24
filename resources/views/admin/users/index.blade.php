@extends('layouts.app')

@section('title', 'Gestionare Utilizatori')

@section('content')
<div class="admin-users">
    <div class="page-header">
        <div class="header-content">
            <h1 class="page-title">
                <i class="fas fa-users-cog"></i>
                Gestionare Utilizatori
            </h1>
            <p class="page-subtitle">Administrați toți utilizatorii platformei</p>
        </div>
        <a href="{{ route('admin.users.create') }}" class="btn-primary">
            <i class="fas fa-user-plus"></i>
            Adaugă Utilizator
        </a>
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

    <!-- Users Table -->
    <div class="users-table-container">
        <table class="users-table">
            <thead>
                <tr>
                    <th>Utilizator</th>
                    <th>Email</th>
                    <th>Rol</th>
                    <th>Înregistrat</th>
                    <th>Ultima Activitate</th>
                    <th>Acțiuni</th>
                </tr>
            </thead>
            <tbody>
                @forelse($users as $user)
                    <tr>
                        <td>
                            <div class="user-info">
                                <div class="user-avatar">
                                    {{ strtoupper(substr($user->name, 0, 1)) }}
                                </div>
                                <div class="user-details">
                                    <div class="user-name">{{ $user->name }}</div>
                                    <div class="user-id">ID: {{ $user->id }}</div>
                                </div>
                            </div>
                        </td>
                        <td>{{ $user->email }}</td>
                        <td>
                            <span class="role-badge {{ $user->role }}">
                                {{ $user->role === 'admin' ? 'Administrator' : 'Utilizator' }}
                            </span>
                        </td>
                        <td>{{ $user->created_at->format('d M Y') }}</td>
                        <td>{{ $user->updated_at->diffForHumans() }}</td>
                        <td>
                            <div class="action-buttons">
                                <a href="{{ route('admin.users.edit', $user) }}" class="btn-action btn-edit" title="Editează">
                                    <i class="fas fa-edit"></i>
                                </a>

                                @if($user->id !== auth()->id())
                                    <form action="{{ route('admin.users.toggle-role', $user) }}" method="POST" class="inline-form">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="btn-action {{ $user->isAdmin() ? 'btn-demote' : 'btn-promote' }}"
                                                title="{{ $user->isAdmin() ? 'Retrogradează' : 'Promovează' }}">
                                            <i class="fas {{ $user->isAdmin() ? 'fa-user-minus' : 'fa-user-plus' }}"></i>
                                        </button>
                                    </form>

                                    <form action="{{ route('admin.users.destroy', $user) }}" method="POST" class="inline-form"
                                          onsubmit="return confirm('Ești sigur că vrei să ștergi utilizatorul {{ $user->name }}?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn-action btn-delete" title="Șterge">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                @else
                                    <span class="current-user">Contul tău</span>
                                @endif
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="no-users">
                            <i class="fas fa-users"></i>
                            <p>Nu există utilizatori înregistrați.</p>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if($users->hasPages())
        <div class="pagination">
            {{ $users->links() }}
        </div>
    @endif
</div>
@endsection

@push('styles')
<style>
.admin-users {
    max-width: 1400px;
    margin: 0 auto;
    padding: 2rem;
}

.page-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 2rem;
    padding-bottom: 1rem;
    border-bottom: 2px solid #e0e0e0;
}

.header-content h1 {
    font-size: 2.5rem;
    color: #2c3e50;
    margin: 0;
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.page-subtitle {
    color: #7f8c8d;
    margin: 0.5rem 0 0 0;
    font-size: 1.1rem;
}

.users-table-container {
    background: white;
    border-radius: 12px;
    overflow: hidden;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
    border: 1px solid #e0e0e0;
    margin-bottom: 2rem;
}

.users-table {
    width: 100%;
    border-collapse: collapse;
}

.users-table thead {
    background: #f8f9fa;
}

.users-table th {
    padding: 1rem;
    text-align: left;
    font-weight: 600;
    color: #2c3e50;
    border-bottom: 2px solid #e0e0e0;
}

.users-table td {
    padding: 1rem;
    border-bottom: 1px solid #f1f3f4;
}

.users-table tbody tr:hover {
    background: #f8f9fa;
}

.user-info {
    display: flex;
    align-items: center;
    gap: 0.75rem;
}

.user-avatar {
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

.user-details {
    display: flex;
    flex-direction: column;
}

.user-name {
    font-weight: 600;
    color: #2c3e50;
}

.user-id {
    font-size: 0.8rem;
    color: #7f8c8d;
}

.role-badge {
    padding: 0.25rem 0.75rem;
    border-radius: 20px;
    font-size: 0.8rem;
    font-weight: 600;
    text-transform: uppercase;
}

.role-badge.admin {
    background: #fef3c7;
    color: #92400e;
}

.role-badge.user {
    background: #dbeafe;
    color: #1e40af;
}

.action-buttons {
    display: flex;
    gap: 0.5rem;
    align-items: center;
}

.btn-action {
    padding: 0.5rem;
    border: none;
    border-radius: 6px;
    cursor: pointer;
    transition: all 0.3s ease;
    display: flex;
    align-items: center;
    justify-content: center;
    width: 32px;
    height: 32px;
}

.btn-edit {
    background: #ffc107;
    color: #212529;
}

.btn-edit:hover {
    background: #e0a800;
}

.btn-promote {
    background: #28a745;
    color: white;
}

.btn-promote:hover {
    background: #218838;
}

.btn-demote {
    background: #fd7e14;
    color: white;
}

.btn-demote:hover {
    background: #e8680d;
}

.btn-delete {
    background: #dc3545;
    color: white;
}

.btn-delete:hover {
    background: #c82333;
}

.inline-form {
    margin: 0;
}

.current-user {
    font-size: 0.8rem;
    color: #6c757d;
    font-style: italic;
}

.no-users {
    text-align: center;
    padding: 4rem 2rem;
    color: #6c757d;
}

.no-users i {
    font-size: 3rem;
    margin-bottom: 1rem;
    opacity: 0.5;
}

.no-users p {
    margin: 0;
    font-size: 1.1rem;
}

.pagination {
    margin-top: 2rem;
    display: flex;
    justify-content: center;
}

@media (max-width: 768px) {
    .admin-users {
        padding: 1rem;
    }

    .page-header {
        flex-direction: column;
        gap: 1rem;
        text-align: center;
    }

    .users-table-container {
        overflow-x: auto;
    }

    .users-table {
        min-width: 800px;
    }

    .user-info {
        flex-direction: column;
        text-align: center;
        gap: 0.5rem;
    }

    .action-buttons {
        justify-content: center;
    }
}
</style>
@endpush