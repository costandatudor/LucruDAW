@extends('layouts.app')

@section('title', 'Știri')

@section('content')
<div class="news-container">
    <div class="news-header">
        <div class="header-content">
            <h1 class="page-title">
                <i class="fas fa-newspaper"></i>
                Știri
            </h1>
            <p class="page-subtitle">Cele mai recente știri și actualizări</p>
        </div>
        <a href="{{ route('news.create') }}" class="btn-primary">
            <i class="fas fa-plus"></i>
            Adaugă Știre Nouă
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            <i class="fas fa-check-circle"></i>
            {{ session('success') }}
        </div>
    @endif

    <div class="news-grid">
        @forelse($news as $article)
            <article class="news-card">
                @if($article->image)
                    <div class="news-image">
                        <img src="{{ asset($article->image) }}" alt="{{ $article->title }}" loading="lazy">
                    </div>
                @endif

                <div class="news-content">
                    <div class="news-meta">
                        <span class="news-date">
                            <i class="fas fa-calendar"></i>
                            {{ $article->published_at ? $article->published_at->format('d M Y') : $article->created_at->format('d M Y') }}
                        </span>
                        <span class="news-author">
                            <i class="fas fa-user"></i>
                            {{ $article->author }}
                        </span>
                    </div>

                    <h2 class="news-title">
                        <a href="{{ route('news.show', $article) }}">{{ $article->title }}</a>
                    </h2>

                    <p class="news-excerpt">{{ $article->excerpt }}</p>

                    <div class="news-actions">
                        <a href="{{ route('news.show', $article) }}" class="btn-secondary">
                            <i class="fas fa-eye"></i>
                            Citește mai mult
                        </a>
                        <div class="action-buttons">
                            <a href="{{ route('news.edit', $article) }}" class="btn-edit">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('news.destroy', $article) }}" method="POST" class="delete-form" onsubmit="return confirm('Ești sigur că vrei să ștergi această știre?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-delete">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </article>
        @empty
            <div class="empty-state">
                <i class="fas fa-newspaper"></i>
                <h3>Nu există știri încă</h3>
                <p>Fii primul care adaugă o știre nouă!</p>
                <a href="{{ route('news.create') }}" class="btn-primary">Adaugă Prima Știre</a>
            </div>
        @endforelse
    </div>

    @if($news->hasPages())
        <div class="pagination">
            {{ $news->links() }}
        </div>
    @endif
</div>
@endsection

@push('styles')
<style>
.news-container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 2rem;
}

.news-header {
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

.btn-primary {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    padding: 0.75rem 1.5rem;
    border-radius: 8px;
    text-decoration: none;
    font-weight: 600;
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    transition: all 0.3s ease;
    box-shadow: 0 4px 15px rgba(102, 126, 234, 0.3);
}

.btn-primary:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(102, 126, 234, 0.4);
}

.alert {
    padding: 1rem;
    border-radius: 8px;
    margin-bottom: 1.5rem;
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.alert-success {
    background-color: #d4edda;
    color: #155724;
    border: 1px solid #c3e6cb;
}

.news-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
    gap: 2rem;
    margin-bottom: 2rem;
}

.news-card {
    background: white;
    border-radius: 12px;
    overflow: hidden;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
    transition: all 0.3s ease;
    border: 1px solid #e0e0e0;
}

.news-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 30px rgba(0, 0, 0, 0.15);
}

.news-image {
    height: 200px;
    overflow: hidden;
}

.news-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.3s ease;
}

.news-card:hover .news-image img {
    transform: scale(1.05);
}

.news-content {
    padding: 1.5rem;
}

.news-meta {
    display: flex;
    justify-content: space-between;
    font-size: 0.9rem;
    color: #7f8c8d;
    margin-bottom: 1rem;
}

.news-date, .news-author {
    display: flex;
    align-items: center;
    gap: 0.25rem;
}

.news-title {
    font-size: 1.4rem;
    margin: 0 0 1rem 0;
    color: #2c3e50;
}

.news-title a {
    text-decoration: none;
    color: inherit;
    transition: color 0.3s ease;
}

.news-title a:hover {
    color: #667eea;
}

.news-excerpt {
    color: #5a6c7d;
    line-height: 1.6;
    margin-bottom: 1.5rem;
}

.news-actions {
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.btn-secondary {
    background: #f8f9fa;
    color: #495057;
    padding: 0.5rem 1rem;
    border-radius: 6px;
    text-decoration: none;
    font-weight: 500;
    display: inline-flex;
    align-items: center;
    gap: 0.25rem;
    transition: all 0.3s ease;
}

.btn-secondary:hover {
    background: #e9ecef;
    color: #212529;
}

.action-buttons {
    display: flex;
    gap: 0.5rem;
}

.btn-edit, .btn-delete {
    padding: 0.5rem;
    border: none;
    border-radius: 6px;
    cursor: pointer;
    transition: all 0.3s ease;
    display: flex;
    align-items: center;
    justify-content: center;
}

.btn-edit {
    background: #ffc107;
    color: #212529;
}

.btn-edit:hover {
    background: #e0a800;
}

.btn-delete {
    background: #dc3545;
    color: white;
}

.btn-delete:hover {
    background: #c82333;
}

.delete-form {
    margin: 0;
}

.empty-state {
    grid-column: 1 / -1;
    text-align: center;
    padding: 4rem 2rem;
    color: #6c757d;
}

.empty-state i {
    font-size: 4rem;
    margin-bottom: 1rem;
    opacity: 0.5;
}

.empty-state h3 {
    font-size: 1.5rem;
    margin-bottom: 0.5rem;
    color: #495057;
}

.pagination {
    margin-top: 2rem;
    display: flex;
    justify-content: center;
}

@media (max-width: 768px) {
    .news-container {
        padding: 1rem;
    }

    .news-header {
        flex-direction: column;
        gap: 1rem;
        text-align: center;
    }

    .news-grid {
        grid-template-columns: 1fr;
        gap: 1rem;
    }

    .news-actions {
        flex-direction: column;
        gap: 1rem;
    }

    .action-buttons {
        justify-content: center;
    }
}
</style>
@endpush