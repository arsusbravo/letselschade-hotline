@extends('layouts.app')

@section('title', 'Contact - Letselschade-Hotline')

@section('content')
    <!-- Hero Section -->
    <section class="hero">
        <div class="container">
            <div class="hero-content">
                <div class="hero-text">
                    <h1><i class="fas fa-phone-volume"></i> Contact</h1>
                    <p>Neem direct contact met ons op. Wij staan voor u paraat om u te helpen bij uw letselschade claim.</p>
                </div>
                <div class="hero-image">
                    <img src="/images/header.png" alt="Letselschade-Hotline Contact" loading="lazy" />
                </div>
            </div>
        </div>
    </section>

    <!-- Main Content -->
    <div class="container main-content">
        <!-- Direct Contact Section -->
        <section class="section">
            <h2><i class="fas fa-phone"></i> Direct Contact</h2>
            <p>Heeft u letsel opgelopen door toedoen van een ander? Neem vandaag nog contact met ons op. Wij zijn 24/7 bereikbaar voor spoedgevallen.</p>
            
            <div class="contact-methods">
                <div class="contact-method">
                    <div class="contact-icon">
                        <i class="fas fa-phone-alt"></i>
                    </div>
                    <div class="contact-info">
                        <h3>Telefoon</h3>
                        <a href="tel:0880767676" class="phone-number">088 076 76 76</a>
                        <p>Maandag t/m Vrijdag:<br>9:00 - 18:00</p>
                        <p>Weekend: 10:00 - 16:00</p>
                    </div>
                </div>
                
                <div class="contact-method">
                    <div class="contact-icon">
                        <i class="fas fa-envelope"></i>
                    </div>
                    <div class="contact-info">
                        <h3>Email</h3>
                        <a href="mailto:info@letselschade-hotline.nl">info@letselschade-hotline.nl</a>
                        <p>Reactie binnen 2 uur</p>
                    </div>
                </div>
                
                <div class="contact-method">
                    <div class="contact-icon">
                        <i class="fas fa-clock"></i>
                    </div>
                    <div class="contact-info">
                        <h3>Openingstijden</h3>
                        <ul class="opening-hours">
                            <li>Maandag - Vrijdag: 9:00 - 18:00</li>
                            <li>Zaterdag: 10:00 - 16:00</li>
                            <li>Zondag: Gesloten</li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>

        <!-- Team Section -->
        <div class="team-section">
            <h2><i class="fas fa-users"></i> Ons Team</h2>
            <p>Onze ervaren letselschade experts staan voor u klaar om u te helpen bij uw claim. Beide zijn gecertificeerde Registerexperts Personenschade (NIVRE).</p>
            
            <div class="team-grid">
                <div class="team-member">
                    <div class="member-photo">
                        <img src="/images/roel.jpg" alt="Roel van Reenen - Registerexpert Personenschade" loading="lazy" />
                    </div>
                    <div class="member-info">
                        <h3>Roel van Reenen</h3>
                        <p class="member-title">Registerexpert Personenschade (NIVRE)</p>
                        <p class="member-description">Ruim 25 jaar ervaring als belangenbehartiger. Het slachtoffer staat altijd centraal en heeft recht op de best mogelijke zorg en persoonlijke begeleiding.</p>
                        <div class="member-contact">
                            <p><i class="fas fa-phone"></i> 088 076 76 76</p>
                            <p><i class="fas fa-envelope"></i> roel@letselschade-hotline.nl</p>
                        </div>
                    </div>
                </div>
                
                <div class="team-member">
                    <div class="member-photo">
                        <img src="/images/judith.jpg" alt="Judith van Helmont-Mallee - Registerexpert Personenschade" loading="lazy" />
                    </div>
                    <div class="member-info">
                        <h3>Judith van Helmont-Mallee</h3>
                        <p class="member-title">Registerexpert Personenschade (NIVRE)</p>
                        <p class="member-description">Gespecialiseerd in het begeleiden van slachtoffers van verkeersongevallen en arbeidsongevallen. Persoonlijk contact met cliënten staat hoog in het vaandel.</p>
                        <div class="member-contact">
                            <p><i class="fas fa-phone"></i> 088 076 76 76</p>
                            <p><i class="fas fa-envelope"></i> judith@letselschade-hotline.nl</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Contact Form Section -->
        <section class="section">
            <h2><i class="fas fa-envelope"></i> Contactformulier</h2>
            <p>Vul het onderstaande formulier in en wij nemen binnen 2 uur contact met u op. Uw gegevens worden vertrouwelijk behandeld.</p>
            
            @include('components.contact-form')
        </section>

        <!-- FAQ Section -->
        <section class="section">
            <h2><i class="fas fa-question-circle"></i> Veelgestelde Vragen</h2>
            
            <ul class="faq-list">
                <li class="faq-item">
                    <h4><i class="fas fa-clock"></i> Hoe snel reageren jullie?</h4>
                    <p>Wij nemen binnen 24 uur contact met u op na het versturen van het contactformulier. Voor spoedgevallen zijn wij ook buiten kantooruren bereikbaar.</p>
                </li>
                
                <li class="faq-item">
                    <h4><i class="fas fa-euro-sign"></i> Wat kost jullie dienstverlening?</h4>
                    <p>U betaalt niets aan ons. Onze dienstverlening verhalen wij op de aansprakelijke partij. U heeft dus geen eigen bijdrage.</p>
                </li>
                
                <li class="faq-item">
                    <h4><i class="fas fa-shield-alt"></i> Hoe beschermen jullie mijn privacy?</h4>
                    <p>Wij behandelen al uw gegevens vertrouwelijk en in overeenstemming met de AVG. Uw privacy staat bij ons voorop.</p>
                </li>
                
                <li class="faq-item">
                    <h4><i class="fas fa-gavel"></i> Wat als ik niet tevreden ben?</h4>
                    <p>U kunt altijd kosteloos van onze diensten afzien. Wij streven naar 100% klanttevredenheid en staan open voor feedback.</p>
                </li>
            </ul>
        </section>

        <!-- Office Information Section -->
        <section class="section">
            <h2><i class="fas fa-building"></i> Over Letselschade-Hotline</h2>
            <p>Letselschade-Hotline is een initiatief van <span class="highlight">Letselschade-begeleiding B.V.</span> om mensen met opgelopen letsel nog beter te helpen om hun schade te claimen.</p>
            
            <div class="company-info">
                <div class="info-item">
                    <h4><i class="fas fa-map-marker-alt"></i> Adres</h4>
                    <p>Letselschade-begeleiding B.V.<br>
                    Hoofdkantoor<br>
                    Postbus 123<br>
                    1000 AB Amsterdam</p>
                </div>
                
                <div class="info-item">
                    <h4><i class="fas fa-phone"></i> Contact</h4>
                    <p>Telefoon: 088 076 76 76<br>
                    Email: info@letselschade-hotline.nl<br>
                    KvK: 12345678<br>
                    BTW: NL123456789B01</p>
                </div>
                
                <div class="info-item">
                    <h4><i class="fas fa-certificate"></i> Certificeringen</h4>
                    <ul class="certifications">
                        <li>ISO 9001 gecertificeerd</li>
                        <li>Lid van Nederlandse Vereniging van Letselschade Advocaten</li>
                        <li>Erkend door de Nederlandse Orde van Advocaten</li>
                    </ul>
                </div>
            </div>
        </section>
    </div>
@endsection 