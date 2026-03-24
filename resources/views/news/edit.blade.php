@extends('layouts.app')

@section('title', 'Editează Știrea: ' . $news->title)

@section('content')
<div class="news-form-container">
    <div class="form-header">
        <h1 class="form-title">
            <i class="fas fa-edit"></i>
            Editează Știrea
        </h1>
        <p class="form-subtitle">Modifică informațiile știrii</p>
    </div>

    <form action="{{ route('news.update', $news) }}" method="POST" enctype="multipart/form-data" class="news-form">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="title" class="form-label">
                <i class="fas fa-heading"></i>
                Titlu *
            </label>
            <input type="text" id="title" name="title" class="form-input @error('title') is-invalid @enderror"
                   value="{{ old('title', $news->title) }}" placeholder="Introdu titlul știrii" required>
            @error('title')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="excerpt" class="form-label">
                <i class="fas fa-quote-left"></i>
                Rezumat (opțional)
            </label>
            <textarea id="excerpt" name="excerpt" class="form-textarea @error('excerpt') is-invalid @enderror"
                      rows="3" placeholder="Un scurt rezumat al știrii">{{ old('excerpt', $news->excerpt) }}</textarea>
            @error('excerpt')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="content" class="form-label">
                <i class="fas fa-file-alt"></i>
                Conținut *
            </label>
            <textarea id="content" name="content" class="form-textarea @error('content') is-invalid @enderror"
                      rows="15" placeholder="Introdu conținutul știrii" required>{{ old('content', $news->content) }}</textarea>
            @error('content')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="image" class="form-label">
                <i class="fas fa-image"></i>
                Imagine (opțional)
            </label>
            @if($news->image)
                <div class="current-image">
                    <img src="{{ asset($news->image) }}" alt="Current image" class="preview-image">
                    <p>Imaginea curentă va fi înlocuită dacă încarci una nouă</p>
                </div>
            @endif
            <div class="file-upload">
                <input type="file" id="image" name="image" class="file-input @error('image') is-invalid @enderror"
                       accept="image/*">
                <label for="image" class="file-label">
                    <i class="fas fa-cloud-upload-alt"></i>
                    <span>{{ $news->image ? 'Schimbă imaginea' : 'Alege o imagine' }}</span>
                </label>
                <div class="file-info">Format acceptat: JPG, PNG, GIF. Dimensiune maximă: 2MB</div>
            </div>
            @error('image')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label class="checkbox-label">
                <input type="checkbox" name="published" value="1" {{ old('published', $news->published) ? 'checked' : '' }}>
                <span class="checkmark"></span>
                <i class="fas fa-globe"></i>
                Publică știrea
            </label>
        </div>

        <div class="form-actions">
            <button type="submit" class="btn-submit">
                <i class="fas fa-save"></i>
                Salvează Modificările
            </button>
            <a href="{{ route('news.show', $news) }}" class="btn-preview">
                <i class="fas fa-eye"></i>
                Previzualizează
            </a>
            <a href="{{ route('news.index') }}" class="btn-cancel">
                <i class="fas fa-times"></i>
                Anulează
            </a>
        </div>
    </form>
</div>
@endsection

@push('styles')
<style>
.news-form-container {
    max-width: 800px;
    margin: 0 auto;
    padding: 2rem;
}

.form-header {
    text-align: center;
    margin-bottom: 2rem;
}

.form-title {
    font-size: 2.5rem;
    color: #2c3e50;
    margin: 0;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 0.5rem;
}

.form-subtitle {
    color: #7f8c8d;
    margin: 0.5rem 0 0 0;
    font-size: 1.1rem;
}

.news-form {
    background: white;
    padding: 2rem;
    border-radius: 12px;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
    border: 1px solid #e0e0e0;
}

.form-group {
    margin-bottom: 1.5rem;
}

.form-label {
    display: block;
    font-weight: 600;
    color: #2c3e50;
    margin-bottom: 0.5rem;
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.form-input, .form-textarea {
    width: 100%;
    padding: 0.75rem;
    border: 2px solid #e0e0e0;
    border-radius: 8px;
    font-size: 1rem;
    transition: all 0.3s ease;
    background: #f8f9fa;
}

.form-input:focus, .form-textarea:focus {
    outline: none;
    border-color: #667eea;
    background: white;
    box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
}

.form-textarea {
    resize: vertical;
    min-height: 100px;
}

.current-image {
    margin-bottom: 1rem;
    text-align: center;
}

.preview-image {
    max-width: 200px;
    max-height: 150px;
    border-radius: 8px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    margin-bottom: 0.5rem;
}

.current-image p {
    font-size: 0.9rem;
    color: #7f8c8d;
    margin: 0;
}

.file-upload {
    position: relative;
}

.file-input {
    position: absolute;
    opacity: 0;
    width: 100%;
    height: 100%;
    cursor: pointer;
}

.file-label {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    padding: 2rem;
    border: 2px dashed #cbd5e0;
    border-radius: 8px;
    background: #f8f9fa;
    cursor: pointer;
    transition: all 0.3s ease;
    text-align: center;
}

.file-label:hover {
    border-color: #667eea;
    background: #edf2f7;
}

.file-label i {
    font-size: 2rem;
    color: #a0aec0;
    margin-bottom: 0.5rem;
}

.file-info {
    font-size: 0.9rem;
    color: #7f8c8d;
    margin-top: 0.5rem;
}

.checkbox-label {
    display: flex;
    align-items: center;
    cursor: pointer;
    font-weight: 500;
    color: #2c3e50;
    gap: 0.5rem;
    position: relative;
}

.checkbox-label input[type="checkbox"] {
    position: absolute;
    opacity: 0;
    cursor: pointer;
}

.checkmark {
    width: 20px;
    height: 20px;
    background: #f8f9fa;
    border: 2px solid #cbd5e0;
    border-radius: 4px;
    position: relative;
    transition: all 0.3s ease;
}

.checkbox-label input[type="checkbox"]:checked ~ .checkmark {
    background: #667eea;
    border-color: #667eea;
}

.checkmark:after {
    content: "";
    position: absolute;
    display: none;
    left: 6px;
    top: 2px;
    width: 6px;
    height: 10px;
    border: solid white;
    border-width: 0 2px 2px 0;
    transform: rotate(45deg);
}

.checkbox-label input[type="checkbox"]:checked ~ .checkmark:after {
    display: block;
}

.form-actions {
    display: flex;
    gap: 1rem;
    justify-content: center;
    margin-top: 2rem;
    padding-top: 2rem;
    border-top: 1px solid #e0e0e0;
}

.btn-submit, .btn-preview, .btn-cancel {
    padding: 0.75rem 1.5rem;
    border-radius: 8px;
    text-decoration: none;
    font-weight: 600;
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    transition: all 0.3s ease;
    cursor: pointer;
    border: none;
    font-size: 1rem;
}

.btn-submit {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    box-shadow: 0 4px 15px rgba(102, 126, 234, 0.3);
}

.btn-submit:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(102, 126, 234, 0.4);
}

.btn-preview {
    background: #28a745;
    color: white;
}

.btn-preview:hover {
    background: #218838;
}

.btn-cancel {
    background: #6c757d;
    color: white;
}

.btn-cancel:hover {
    background: #5a6268;
}

.invalid-feedback {
    color: #dc3545;
    font-size: 0.9rem;
    margin-top: 0.25rem;
}

.is-invalid {
    border-color: #dc3545 !important;
}

@media (max-width: 768px) {
    .news-form-container {
        padding: 1rem;
    }

    .news-form {
        padding: 1.5rem;
    }

    .form-actions {
        flex-direction: column;
    }

    .btn-submit, .btn-preview, .btn-cancel {
        width: 100%;
        justify-content: center;
    }
}
</style>
@endpush