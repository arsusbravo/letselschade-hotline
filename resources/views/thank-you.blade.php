@extends('layouts.app')

@section('title', 'Bedankt - Letselschade Hotline')

@section('content')
<div class="container">
    <div class="thank-you-page">
        <div class="success-icon">
            <i class="fas fa-check-circle"></i>
        </div>
        
        <h1>Bedankt voor uw aanvraag!</h1>
        
        <div class="success-message">
            <p>Uw letselschade aanvraag is succesvol verzonden. Onze letselschade experts nemen binnen 2 uur contact met u op.</p>
        </div>
        
        <div class="next-steps">
            <h2><i class="fas fa-list-check"></i> Wat gebeurt er nu?</h2>
            
            <div class="steps-grid">
                <div class="step-item">
                    <div class="step-number">1</div>
                    <div class="step-content">
                        <h3>Beoordeling</h3>
                        <p>Onze experts beoordelen uw geval binnen 2 uur</p>
                    </div>
                </div>
                
                <div class="step-item">
                    <div class="step-number">2</div>
                    <div class="step-content">
                        <h3>Contact</h3>
                        <p>Wij bellen u terug voor een gratis adviesgesprek</p>
                    </div>
                </div>
                
                <div class="step-item">
                    <div class="step-number">3</div>
                    <div class="step-content">
                        <h3>Actie</h3>
                        <p>Samen werken we aan uw schadevergoeding</p>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="contact-info">
            <h3><i class="fas fa-phone"></i> Direct contact nodig?</h3>
            <p>Bel ons direct voor spoedeisende zaken:</p>
            <a href="tel:0880767676" class="phone-number">
                <i class="fas fa-phone"></i> 088 076 76 76
            </a>
        </div>
        
        <div class="additional-resources">
            <h3><i class="fas fa-info-circle"></i> Meer informatie</h3>
            <div class="resource-links">
                <a href="/diensten" class="resource-link">
                    <i class="fas fa-clipboard-list"></i>
                    Onze diensten
                </a>
                <a href="/letselschadetest" class="resource-link">
                    <i class="fas fa-play-circle"></i>
                    Letselschadetest
                </a>
                <a href="/contact" class="resource-link">
                    <i class="fas fa-envelope"></i>
                    Contact
                </a>
            </div>
        </div>
        
        <div class="back-to-home">
            <a href="/" class="cta-button">
                <i class="fas fa-home"></i>
                Terug naar home
            </a>
        </div>
    </div>
</div>
@endsection
