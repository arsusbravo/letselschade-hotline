@extends('layouts.app')

@section('title', 'Letselschade-Hotline - Direct hulp na een ongeval')

@section('content')
    <!-- Hero Section -->
    <section class="hero" id="home">
        <div class="container">
            <div class="hero-content">
                <div class="hero-text">
                    <h1>De Letselschade-Hotline is er om je direct te helpen</h1>
                    <p>Snel hulp nodig na een ongeval? Wij staan voor u paraat met professionele begeleiding.</p>
                    <a href="#contact" class="cta-button">
                        <i class="fas fa-phone-alt"></i>
                        Direct contact opnemen
                    </a>
                </div>
                <div class="hero-image">
                    <img src="/images/header.png" alt="Letselschade-Hotline" loading="lazy" />
                </div>
            </div>
        </div>
    </section>

    <!-- Main Content -->
    <div class="container main-content">
        <!-- Snel hulp nodig section -->
        <section class="section">
            <h2><i class="fas fa-exclamation-triangle"></i> Snel hulp nodig na een ongeval?</h2>
            <p>Heb je letsel opgelopen door toedoen van een ander? Dan kun je snel hulp nodig hebben — bijvoorbeeld huishoudelijke hulp of ondersteuning bij dagelijkse taken, omdat je tijdelijk beperkt bent in je functioneren.</p>
            <p><strong>Direct hulp na een ongeval – één telefoontje en wij gaan voor u aan de slag!</strong></p>
            <p>Heeft u letsel opgelopen door toedoen van een ander? Dan heeft u nú hulp nodig. Denk aan huishoudelijke ondersteuning of praktische begeleiding bij uw herstel.</p>
            <p>Bij de Letselschade-Hotline staan wij voor u paraat.</p>
        </section>

        <!-- Waarom kiezen section -->
        <section class="section">
            <h2><i class="fas fa-star"></i> Waarom kiezen voor de Letselschade-Hotline?</h2>
            <div class="benefits-grid">
                <div class="benefit-card">
                    <h4><i class="fas fa-rocket"></i> Directe behandeling</h4>
                    <p><span class="checkmark">✅</span>Wij nemen uw zaak direct in behandeling</p>
                    <p><span class="checkmark">✅</span>Wij begeleiden u bij uw schadeclaim, zonder gedoe</p>
                    <p><span class="checkmark">✅</span>U krijgt waar u recht op heeft – snel, persoonlijk en professioneel</p>
                </div>
                <div class="benefit-card">
                    <h4><i class="fas fa-user-tie"></i> Expertise & Ervaring</h4>
                    <p><span class="checkmark">✔</span>U staat direct met een ervaren letselschade-expert in contact</p>
                    <p><span class="checkmark">✔</span>Wij nemen alle communicatie met de aansprakelijke verzekeraar van u over</p>
                    <p><span class="checkmark">✔</span>Wij zorgen voor een passende schadevergoeding</p>
                </div>
                <div class="benefit-card">
                    <h4><i class="fas fa-heart"></i> Uw herstel staat voorop</h4>
                    <p><span class="checkmark">✔</span>U kunt zich volledig richten op uw herstel – wij doen de rest</p>
                    <p><span class="checkmark">✔</span>U ontvangt geen rekening van ons, onze dienstverlening verhalen wij op wederpartij</p>
                </div>
            </div>
        </section>

        <!-- Zo helpen wij u section -->
        <section class="section">
            <h2><i class="fas fa-hands-helping"></i> Zo helpen wij u direct:</h2>
            <div class="benefits-grid">
                <div class="benefit-card">
                    <h4><i class="fas fa-home"></i> Praktische ondersteuning</h4>
                    <p><span class="checkmark">✔</span>Een vergoeding voor praktische zaken, zoals huishoudelijke hulp, regelen</p>
                </div>
                <div class="benefit-card">
                    <h4><i class="fas fa-user-md"></i> Medische begeleiding</h4>
                    <p><span class="checkmark">✔</span>Inschakeling van een medisch adviseur</p>
                </div>
                <div class="benefit-card">
                    <h4><i class="fas fa-clipboard-list"></i> Schade inventarisatie</h4>
                    <p><span class="checkmark">✔</span>Uw schade en rechten helder in kaart brengen</p>
                </div>
            </div>
        </section>

        <!-- Contact Section -->
        <section class="section" id="contact">
            <h2><i class="fas fa-phone-volume"></i> Laat geen tijd verloren gaan. Bel ons nu!</h2>
            <a href="tel:0881234567" class="phone-number">
                <i class="fas fa-phone"></i> 088 – 123 45 67
            </a>
            <p>Of vul ons contactformulier in met uw gegevens en wij bellen u zo snel mogelijk terug.</p>

            @include('components.contact-form')
        </section>

        <!-- Waarom direct bellen section -->
        <section class="section">
            <h2><i class="fas fa-clock"></i> Waarom direct bellen?</h2>
            <p>Snelle maatregelen zorgen ervoor dat u zo min mogelijk hinder heeft van de gevolgen van het u overkomen ongeval. Wij zorgen voor rust, duidelijkheid en daadkracht vanaf het eerste gesprek.</p>
            
            <h3>U heeft 2 manieren voor direct contact:</h3>
            <div class="benefits-grid">
                <div class="benefit-card">
                    <h4><i class="fas fa-phone-alt"></i> 1. Hotline Letselschade</h4>
                    <a href="tel:0881234567" class="phone-number">
                        <i class="fas fa-phone"></i> 088 – 123 45 67
                    </a>
                </div>
                <div class="benefit-card">
                    <h4><i class="fas fa-envelope"></i> 2. Contactformulier</h4>
                    <p>Vul het formulier hierboven in en wij nemen contact met u op.</p>
                </div>
            </div>
        </section>

        <!-- Over ons section -->
        <section class="section">
            <h2><i class="fas fa-info-circle"></i> Over Letselschade-Hotline</h2>
            <p>Letselschade-Hotline is een initiatief van <span class="highlight">Letselschade-begeleiding B.V.</span> om mensen met opgelopen letsel nog beter te helpen om hun schade te claimen.</p>
            <p><strong>Wij wensen u een goed en voorspoedig herstel toe en nemen direct contact met u op.</strong></p>
        </section>
    </div>
@endsection 