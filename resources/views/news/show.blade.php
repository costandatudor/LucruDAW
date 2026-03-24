@extends('layouts.app')

@section('title', $news->title)

@section('content')
<div class="news-show-container">
    <article class="news-article">
        @if($news->image)
            <div class="article-hero">
                <img src="{{ asset($news->image) }}" alt="{{ $news->title }}" class="hero-image">
            </div>
        @endif

        <div class="article-content">
            <div class="article-meta">
                <div class="meta-info">
                    <span class="article-date">
                        <i class="fas fa-calendar"></i>
                        {{ $news->published_at ? $news->published_at->format('d F Y \l\a H:i') : $news->created_at->format('d F Y \l\a H:i') }}
                    </span>
                    <span class="article-author">
                        <i class="fas fa-user"></i>
                        {{ $news->author }}
                    </span>
                    @if($news->published)
                        <span class="article-status published">
                            <i class="fas fa-check-circle"></i>
                            Publicat
                        </span>
                    @else
                        <span class="article-status draft">
                            <i class="fas fa-clock"></i>
                            Draft
                        </span>
                    @endif
                </div>

                <div class="article-actions">
                    <a href="{{ route('news.edit', $news) }}" class="btn-edit">
                        <i class="fas fa-edit"></i>
                        Editează
                    </a>
                    <a href="{{ route('news.index') }}" class="btn-back">
                        <i class="fas fa-arrow-left"></i>
                        Înapoi la știri
                    </a>
                </div>
            </div>

            <h1 class="article-title">{{ $news->title }}</h1>

            @if($news->excerpt)
                <div class="article-excerpt">
                    <p>{{ $news->excerpt }}</p>
                </div>
            @endif

            <div class="article-body">
                {!! nl2br(e($news->content)) !!}
            </div>
        </div>
    </article>
</div>
@endsection

@push('styles')
<style>
.news-show-container {
    max-width: 800px;
    margin: 0 auto;
    padding: 2rem;
}

.news-article {
    background: white;
    border-radius: 12px;
    overflow: hidden;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
    border: 1px solid #e0e0e0;
}

.article-hero {
    height: 300px;
    overflow: hidden;
}

.hero-image {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.article-content {
    padding: 2rem;
}

.article-meta {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 2rem;
    padding-bottom: 1rem;
    border-bottom: 1px solid #e0e0e0;
}

.meta-info {
    display: flex;
    flex-wrap: wrap;
    gap: 1rem;
    align-items: center;
}

.article-date, .article-author, .article-status {
    display: flex;
    align-items: center;
    gap: 0.25rem;
    font-size: 0.9rem;
    color: #7f8c8d;
}

.article-status {
    padding: 0.25rem 0.5rem;
    border-radius: 4px;
    font-size: 0.8rem;
    font-weight: 500;
}

.article-status.published {
    background: #d4edda;
    color: #155724;
}

.article-status.draft {
    background: #fff3cd;
    color: #856404;
}

.article-actions {
    display: flex;
    gap: 0.5rem;
}

.btn-edit, .btn-back {
    padding: 0.5rem 1rem;
    border-radius: 6px;
    text-decoration: none;
    font-weight: 500;
    display: inline-flex;
    align-items: center;
    gap: 0.25rem;
    transition: all 0.3s ease;
}

.btn-edit {
    background: #ffc107;
    color: #212529;
}

.btn-edit:hover {
    background: #e0a800;
}

.btn-back {
    background: #6c757d;
    color: white;
}

.btn-back:hover {
    background: #5a6268;
}

.article-title {
    font-size: 2.5rem;
    color: #2c3e50;
    margin: 0 0 1.5rem 0;
    line-height: 1.2;
}

.article-excerpt {
    background: #f8f9fa;
    padding: 1.5rem;
    border-radius: 8px;
    margin-bottom: 2rem;
    border-left: 4px solid #667eea;
}

.article-excerpt p {
    margin: 0;
    font-size: 1.1rem;
    color: #495057;
    font-style: italic;
}

.article-body {
    line-height: 1.8;
    color: #2c3e50;
    font-size: 1.1rem;
}

.article-body p {
    margin-bottom: 1.5rem;
}

@media (max-width: 768px) {
    .news-show-container {
        padding: 1rem;
    }

    .article-content {
        padding: 1.5rem;
    }

    .article-meta {
        flex-direction: column;
        gap: 1rem;
        align-items: flex-start;
    }

    .article-actions {
        align-self: stretch;
        justify-content: center;
    }

    .article-title {
        font-size: 2rem;
    }
}
</style>
@endpush