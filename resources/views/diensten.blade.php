@extends('layouts.app')

@section('title', 'Diensten - Letselschade-Hotline')

@section('content')
    <!-- Hero Section -->
    <section class="hero">
        <div class="container">
            <div class="hero-content">
                <div class="hero-text">
                    <h1><i class="fas fa-cogs"></i> Onze Diensten</h1>
                    <p>Professionele begeleiding bij letselschade claims. Wij staan voor u paraat met expertise en ervaring.</p>
                </div>
                <div class="hero-image">
                    <img src="/images/header.png" alt="Letselschade-Hotline Diensten" loading="lazy" />
                </div>
            </div>
        </div>
    </section>

    <!-- Main Content -->
    <div class="container main-content">
        <!-- Directe Behandeling Section -->
        <section class="section">
            <h2><i class="fas fa-rocket"></i> Directe Behandeling</h2>
            <p>Bij de Letselschade-Hotline begrijpen wij dat tijd van essentieel belang is na een ongeval. Daarom bieden wij directe behandeling van uw zaak aan.</p>
            
            <div class="benefits-grid">
                <div class="benefit-card">
                    <h4><i class="fas fa-clock"></i> Snelle Reactie</h4>
                    <p>Wij nemen uw zaak binnen 24 uur in behandeling en nemen direct contact met u op voor een eerste gesprek.</p>
                </div>
                <div class="benefit-card">
                    <h4><i class="fas fa-file-contract"></i> Directe Claimbegeleiding</h4>
                    <p>Wij begeleiden u bij uw schadeclaim zonder gedoe. Alle communicatie met verzekeraars nemen wij van u over.</p>
                </div>
                <div class="benefit-card">
                    <h4><i class="fas fa-check-circle"></i> Persoonlijke Aanpak</h4>
                    <p>U krijgt waar u recht op heeft – snel, persoonlijk en professioneel. Wij zorgen voor een passende schadevergoeding.</p>
                </div>
            </div>
        </section>

        <!-- Expertise & Ervaring Section -->
        <section class="section">
            <h2><i class="fas fa-user-tie"></i> Expertise & Ervaring</h2>
            <p>Ons team bestaat uit ervaren letselschade-experts die al jarenlang actief zijn in de branche. Wij kennen alle ins en outs van letselschade claims.</p>
            
            <div class="benefits-grid">
                <div class="benefit-card">
                    <h4><i class="fas fa-graduation-cap"></i> Ervaren Experts</h4>
                    <p>U staat direct met een ervaren letselschade-expert in contact die uw zaak persoonlijk begeleidt.</p>
                </div>
                <div class="benefit-card">
                    <h4><i class="fas fa-comments"></i> Communicatie Overname</h4>
                    <p>Wij nemen alle communicatie met de aansprakelijke verzekeraar van u over, zodat u zich kunt richten op uw herstel.</p>
                </div>
                <div class="benefit-card">
                    <h4><i class="fas fa-balance-scale"></i> Juridische Expertise</h4>
                    <p>Onze experts kennen alle juridische aspecten van letselschade en zorgen voor een optimale schadevergoeding.</p>
                </div>
            </div>
        </section>

        <!-- Praktische Ondersteuning Section -->
        <section class="section">
            <h2><i class="fas fa-hands-helping"></i> Praktische Ondersteuning</h2>
            <p>Na een ongeval heeft u vaak praktische hulp nodig. Wij regelen dit voor u en zorgen ervoor dat u de ondersteuning krijgt die u verdient.</p>
            
            <div class="benefits-grid">
                <div class="benefit-card">
                    <h4><i class="fas fa-home"></i> Huishoudelijke Hulp</h4>
                    <p>Wij regelen een vergoeding voor huishoudelijke hulp, zodat u zich kunt richten op uw herstel zonder zorgen over dagelijkse taken.</p>
                </div>
                <div class="benefit-card">
                    <h4><i class="fas fa-car"></i> Vervoer & Mobiliteit</h4>
                    <p>Indien nodig regelen wij vervoer en mobiliteitshulpmiddelen om uw dagelijks leven zo normaal mogelijk te laten verlopen.</p>
                </div>
                <div class="benefit-card">
                    <h4><i class="fas fa-tools"></i> Praktische Zaken</h4>
                    <p>Wij helpen bij het regelen van praktische zaken zoals aanpassingen aan uw woning of werkplek.</p>
                </div>
            </div>
        </section>

        <!-- Medische Begeleiding Section -->
        <section class="section">
            <h2><i class="fas fa-user-md"></i> Medische Begeleiding</h2>
            <p>Uw gezondheid staat voorop. Wij zorgen voor de juiste medische begeleiding en behandeling die u nodig heeft.</p>
            
            <div class="benefits-grid">
                <div class="benefit-card">
                    <h4><i class="fas fa-stethoscope"></i> Medisch Adviseur</h4>
                    <p>Wij schakelen een medisch adviseur in die uw letsel beoordeelt en de beste behandeling voorstelt.</p>
                </div>
                <div class="benefit-card">
                    <h4><i class="fas fa-hospital"></i> Behandeling & Revalidatie</h4>
                    <p>Wij regelen de juiste medische behandeling en revalidatie die u nodig heeft voor een optimaal herstel.</p>
                </div>
                <div class="benefit-card">
                    <h4><i class="fas fa-pills"></i> Medicatie & Therapie</h4>
                    <p>Indien nodig regelen wij medicatie en therapie die niet door uw eigen verzekering wordt vergoed.</p>
                </div>
            </div>
        </section>

        <!-- Schade Inventarisatie Section -->
        <section class="section">
            <h2><i class="fas fa-clipboard-list"></i> Schade Inventarisatie</h2>
            <p>Wij brengen uw schade en rechten helder in kaart, zodat u precies weet waar u recht op heeft.</p>
            
            <div class="benefits-grid">
                <div class="benefit-card">
                    <h4><i class="fas fa-search"></i> Uitgebreide Analyse</h4>
                    <p>Wij analyseren uw situatie grondig en brengen alle schade in kaart, zowel materieel als immaterieel.</p>
                </div>
                <div class="benefit-card">
                    <h4><i class="fas fa-calculator"></i> Schadeberekening</h4>
                    <p>Wij maken een gedetailleerde schadeberekening op basis van uw letsel, inkomensverlies en andere gevolgen.</p>
                </div>
                <div class="benefit-card">
                    <h4><i class="fas fa-gavel"></i> Juridische Positie</h4>
                    <p>Wij beoordelen uw juridische positie en zorgen ervoor dat u de maximale schadevergoeding krijgt waar u recht op heeft.</p>
                </div>
            </div>
        </section>

        <!-- Uw Herstel Staat Voorop Section -->
        <section class="section">
            <h2><i class="fas fa-heart"></i> Uw Herstel Staat Voorop</h2>
            <p>Wij geloven dat u zich volledig moet kunnen richten op uw herstel. Daarom doen wij al het andere voor u.</p>
            
            <div class="benefits-grid">
                <div class="benefit-card">
                    <h4><i class="fas fa-user-clock"></i> Focus op Herstel</h4>
                    <p>U kunt zich volledig richten op uw herstel – wij doen de rest. Geen zorgen over administratie of communicatie.</p>
                </div>
                <div class="benefit-card">
                    <h4><i class="fas fa-euro-sign"></i> Geen Eigen Bijdrage</h4>
                    <p>U ontvangt geen rekening van ons. Onze dienstverlening verhalen wij op de wederpartij.</p>
                </div>
                <div class="benefit-card">
                    <h4><i class="fas fa-shield-alt"></i> Bescherming van Uw Rechten</h4>
                    <p>Wij beschermen uw rechten en zorgen ervoor dat u niet wordt overvraagd door verzekeraars.</p>
                </div>
            </div>
        </section>

        <!-- Waarom Kiezen Section -->
        <section class="section">
            <h2><i class="fas fa-star"></i> Waarom Kiezen voor Onze Diensten?</h2>
            <div class="benefits-grid">
                <div class="benefit-card">
                    <h4><i class="fas fa-award"></i> Bewezen Expertise</h4>
                    <p>Jarenlange ervaring in letselschade claims met een hoog slagingspercentage.</p>
                </div>
                <div class="benefit-card">
                    <h4><i class="fas fa-users"></i> Persoonlijke Aanpak</h4>
                    <p>Elke cliënt krijgt persoonlijke begeleiding van een vaste expert.</p>
                </div>
                <div class="benefit-card">
                    <h4><i class="fas fa-handshake"></i> Transparante Communicatie</h4>
                    <p>Wij houden u altijd op de hoogte van de voortgang van uw zaak.</p>
                </div>
            </div>
        </section>

        <!-- Contact CTA Section -->
        <section class="section">
            <h2><i class="fas fa-phone-volume"></i> Klaar om te Starten?</h2>
            <p>Neem vandaag nog contact met ons op voor een gratis intakegesprek. Wij staan voor u paraat om u te helpen.</p>
            
            <div class="cta-section">
                <a href="tel:0881234567" class="phone-number">
                    <i class="fas fa-phone"></i> 088 – 123 45 67
                </a>
                <a href="/contact" class="cta-button">
                    <i class="fas fa-envelope"></i>
                    Contact Opnemen
                </a>
            </div>
        </section>
    </div>
@endsection 