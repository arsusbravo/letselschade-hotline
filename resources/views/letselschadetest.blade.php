@extends('layouts.app')

@section('title', 'Letselschadetest - Test uw kansen op schadevergoeding')

@section('content')
    <!-- Hero Section -->
    <section class="hero">
        <div class="container">
            <div class="hero-content">
                <div class="hero-text">
                    <h1>Letselschadetest</h1>
                    <p>Ontdek binnen 2 minuten of u recht heeft op schadevergoeding</p>
                    <a href="#form-section" class="cta-button">
                        <i class="fas fa-play-circle"></i>
                        Start de test nu
                    </a>
                </div>
                <div class="hero-image">
                    <img src="/images/header.png" alt="Letselschadetest" loading="lazy" />
                </div>
            </div>
        </div>
    </section>

    <!-- Main Content -->
    <div class="container main-content">
        <!-- Opening Section -->
        <section class="section test-intro">
            <div class="test-header">
                <h2><i class="fas fa-clipboard-check"></i> Gratis Letselschadetest</h2>
                <div class="test-benefits">
                    <div class="benefit-highlight">
                        <div class="benefit-icon">
                            <i class="fas fa-clock"></i>
                        </div>
                        <div class="benefit-content">
                            <h3>2 Minuten</h3>
                            <p>Snelle test</p>
                        </div>
                    </div>
                    <div class="benefit-highlight">
                        <div class="benefit-icon">
                            <i class="fas fa-euro-sign"></i>
                        </div>
                        <div class="benefit-content">
                            <h3>100% Gratis</h3>
                            <p>Geen kosten</p>
                        </div>
                    </div>
                    <div class="benefit-highlight">
                        <div class="benefit-icon">
                            <i class="fas fa-shield-alt"></i>
                        </div>
                        <div class="benefit-content">
                            <h3>Vrijblijvend</h3>
                            <p>Geen verplichtingen</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="test-description">
                <h3>Heeft u letsel opgelopen door toedoen van een ander?</h3>
                <p class="lead-text">
                    <strong>Dan heeft u mogelijk recht op een schadevergoeding!</strong> 
                    Onze experts hebben duizenden mensen geholpen met het claimen van hun rechtmatige vergoeding.
                </p>
                
                <div class="urgency-message">
                    <div class="urgency-icon">
                        <i class="fas fa-exclamation-triangle"></i>
                    </div>
                    <div class="urgency-content">
                        <h4>Wacht niet te lang!</h4>
                        <p>Hoe sneller u handelt, hoe beter wij u kunnen helpen. Sommige claims hebben een beperkte geldigheid.</p>
                    </div>
                </div>

                <div class="cta-intro">
                    <h4>Vul onderstaande test in en ontdek:</h4>
                    <ul class="benefits-list">
                        <li><i class="fas fa-check"></i> Of u recht heeft op schadevergoeding</li>
                        <li><i class="fas fa-check"></i> Welke hulp u direct kunt krijgen</li>
                        <li><i class="fas fa-check"></i> Hoe hoog uw schadevergoeding kan zijn</li>
                        <li><i class="fas fa-check"></i> Wat de volgende stappen zijn</li>
                    </ul>
                </div>
            </div>
        </section>

        <!-- Application Form -->
        <section class="section form-section" id="form-section">
            <div class="form-intro">
                <h3><i class="fas fa-play-circle"></i> Start de test nu</h3>
                <p>Beantwoord de onderstaande vragen zo volledig mogelijk voor het beste advies.</p>
            </div>
            
            @include('components.application-form')
        </section>

        <!-- After Form Section -->
        <section class="section guarantee-section">
            <h3><i class="fas fa-handshake"></i> Onze belofte aan u</h3>
            <div class="guarantees">
                <div class="guarantee-item">
                    <i class="fas fa-user-shield"></i>
                    <h4>100% Vertrouwelijk</h4>
                    <p>Uw gegevens worden veilig behandeld volgens de AVG-wetgeving</p>
                </div>
                <div class="guarantee-item">
                    <i class="fas fa-phone-alt"></i>
                    <h4>Direct Contact</h4>
                    <p>Binnen 2 uur neemt een expert contact met u op</p>
                </div>
                <div class="guarantee-item">
                    <i class="fas fa-euro-sign"></i>
                    <h4>Geen Eigen Risico</h4>
                    <p>U betaalt pas als wij succesvol zijn</p>
                </div>
            </div>
        </section>
    </div>
@endsection
