@extends('layouts.app')

@section('title', 'Klantbeoordelingen - Letselschade-Hotline')

@section('content')
    <!-- Hero Section -->
    <section class="hero">
        <div class="container">
            <div class="hero-content">
                <div class="hero-text">
                    <h1><i class="fas fa-comments"></i> Klantbeoordelingen</h1>
                    <p>Lees wat onze klanten zeggen over onze service en begeleiding bij letselschade claims.</p>
                </div>
                <div class="hero-image">
                    <img src="/images/header.png" alt="Klantbeoordelingen Letselschade-Hotline" loading="lazy" />
                </div>
            </div>
        </div>
    </section>

    <!-- Main Content -->
    <div class="container main-content">
        <section class="section">
            <div class="reviews-header">
                <h2><i class="fas fa-star"></i> Wat zeggen onze klanten?</h2>
                <p>Wij zijn trots op de tevredenheid van onze klanten. Hieronder vindt u alle beoordelingen van mensen die wij hebben geholpen bij hun letselschade claim.</p>
            </div>

            @if($reviews->count() > 0)
                <div class="reviews-list">
                    @foreach($reviews as $review)
                        <div class="review-item">
                            <div class="review-item-header">
                                <div class="review-item-author">
                                    <div class="review-item-icon">
                                        <i class="fas fa-user-circle"></i>
                                    </div>
                                    <div class="review-item-info">
                                        <h3 class="review-item-name">{{ $review['name'] }}</h3>
                                        <p class="review-item-date">
                                            <i class="fas fa-calendar-alt"></i> {{ $review['date'] }}
                                        </p>
                                    </div>
                                </div>
                                <div class="review-item-stars">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                </div>
                            </div>
                            <div class="review-item-content">
                                <p>"{{ $review['comment'] }}"</p>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Pagination -->
                <div class="pagination-wrapper">
                    {{ $reviews->links('vendor.pagination.default') }}
                </div>
            @else
                <div class="no-reviews">
                    <p>Er zijn nog geen beoordelingen beschikbaar.</p>
                </div>
            @endif
        </section>
    </div>
@endsection

