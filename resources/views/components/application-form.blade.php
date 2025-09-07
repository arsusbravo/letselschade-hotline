<div class="contact-form application-form">
    @if(session('success'))
        <div class="alert alert-success">
            <i class="fas fa-check-circle"></i>
            {{ session('success') }}
        </div>
    @endif
    
    @if($errors->any())
        <div class="alert alert-error">
            <i class="fas fa-exclamation-triangle"></i>
            <strong>Er zijn enkele problemen met uw invoer:</strong>
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    
    <div class="form-wizard">
        <!-- Wizard Header -->
        <div class="form-wizard-header">
            <h2 class="form-wizard-title">
                <i class="fas fa-clipboard-list"></i>
                Letselschadetest
            </h2>
            <p class="form-wizard-subtitle">
                Vul stap voor stap uw gegevens in voor een gratis en vrijblijvende beoordeling
            </p>
            
            <!-- Progress Bar -->
            <div class="progress-container">
                <div class="progress-bar">
                    <div class="progress-line">
                        <div class="progress-line-fill" id="progress-line-fill"></div>
                    </div>
                    <div class="progress-step active" data-step="1">
                        <div class="progress-step-circle">1</div>
                        <div class="progress-step-label">Soort ongeval</div>
                    </div>
                    <div class="progress-step" data-step="2">
                        <div class="progress-step-circle">2</div>
                        <div class="progress-step-label">Gebeurtenis</div>
                    </div>
                    <div class="progress-step" data-step="3">
                        <div class="progress-step-circle">3</div>
                        <div class="progress-step-label">Schade</div>
                    </div>
                    <div class="progress-step" data-step="4">
                        <div class="progress-step-circle">4</div>
                        <div class="progress-step-label">Arbeid</div>
                    </div>
                    <div class="progress-step" data-step="5">
                        <div class="progress-step-circle">5</div>
                        <div class="progress-step-label">Extra hulp</div>
                    </div>
                    <div class="progress-step" data-step="6">
                        <div class="progress-step-circle">6</div>
                        <div class="progress-step-label">Contact</div>
                    </div>
                </div>
            </div>
        </div>
        
        <form action="{{ route('webreaction.store') }}" method="POST" id="application-form" novalidate>
        @csrf
        
        <!-- Required fields for WebreactionController -->
        <input type="hidden" name="lead_type_id" value="1">
        <input type="hidden" name="postal_code_id" value="1000">
        <input type="hidden" name="postal_code_letters" value="AA">
        <input type="hidden" name="house_number" value="1">
        
        <!-- Stap 1 - Soort ongeval -->
        <div class="form-step active" data-step="1">
            <div class="step-indicator">
                <i class="fas fa-info-circle"></i>
                Stap 1 van 6
            </div>
            <h3><i class="fas fa-car-crash"></i> Stap 1 – Soort ongeval</h3>
            
            <div class="form-group">
                <label><i class="fas fa-question-circle"></i> Waarmee had u te maken? *</label>
                <div class="radio-group">
                    <label class="radio-option">
                        <input type="radio" name="soort_ongeval" value="verkeer" required>
                        <div class="radio-card">
                            <i class="fas fa-car radio-icon"></i>
                            <span class="radio-text">Verkeersongeval</span>
                        </div>
                    </label>
                    <label class="radio-option">
                        <input type="radio" name="soort_ongeval" value="bedrijf" required>
                        <div class="radio-card">
                            <i class="fas fa-building radio-icon"></i>
                            <span class="radio-text">Bedrijfsongeval</span>
                        </div>
                    </label>
                    <label class="radio-option">
                        <input type="radio" name="soort_ongeval" value="dier" required>
                        <div class="radio-card">
                            <i class="fas fa-paw radio-icon"></i>
                            <span class="radio-text">Letsel door dier</span>
                        </div>
                    </label>
                    <label class="radio-option">
                        <input type="radio" name="soort_ongeval" value="wegdek" required>
                        <div class="radio-card">
                            <i class="fas fa-road radio-icon"></i>
                            <span class="radio-text">Schade door slecht wegdek</span>
                        </div>
                    </label>
                    <label class="radio-option">
                        <input type="radio" name="soort_ongeval" value="sportschool" required>
                        <div class="radio-card">
                            <i class="fas fa-dumbbell radio-icon"></i>
                            <span class="radio-text">Schade in de sportschool</span>
                        </div>
                    </label>
                </div>
            </div>
            
            <!-- Navigation -->
            <div class="form-navigation">
                <button type="button" class="nav-button btn-previous" disabled>
                    <i class="fas fa-arrow-left"></i>
                    Vorige
                </button>
                <button type="button" class="nav-button btn-next" data-next="2">
                    Volgende
                    <i class="fas fa-arrow-right"></i>
                </button>
            </div>
        </div>

        <!-- Stap 2 - Gebeurtenis -->
        <div class="form-step" data-step="2">
            <div class="step-indicator">
                <i class="fas fa-info-circle"></i>
                Stap 2 van 6
            </div>
            <h3><i class="fas fa-calendar-alt"></i> Stap 2 – Gebeurtenis</h3>
            
            <div class="form-group">
                <label for="datum_ongeval"><i class="fas fa-calendar"></i> Datum van het ongeval *</label>
                <input type="date" id="ongeval_datum" name="ongeval_datum" max="{{ date('Y-m-d') }}" required>
                <small class="field-help">Selecteer de datum waarop het ongeval heeft plaatsgevonden (vandaag of eerder)</small>
            </div>

            <div class="form-group">
                <label><i class="fas fa-users"></i> Is de tegenpartij bekend? *</label>
                <div class="radio-group">
                    <label class="radio-option">
                        <input type="radio" name="tegenpartij" value="ja" required>
                        <div class="radio-card">
                            <i class="fas fa-check-circle radio-icon"></i>
                            <span class="radio-text">Ja</span>
                        </div>
                    </label>
                    <label class="radio-option">
                        <input type="radio" name="tegenpartij" value="nee" required>
                        <div class="radio-card">
                            <i class="fas fa-question-circle radio-icon"></i>
                            <span class="radio-text">Nee / Onbekend</span>
                        </div>
                    </label>
                </div>
            </div>

            <div class="form-group">
                <label><i class="fas fa-clock"></i> Wilt u snel geholpen worden? *</label>
                <div class="radio-group">
                    <label class="radio-option">
                        <input type="radio" name="snel_hulp" value="ja" required>
                        <div class="radio-card">
                            <i class="fas fa-phone-alt radio-icon"></i>
                            <span class="radio-text">Ja, graag direct contact</span>
                        </div>
                    </label>
                    <label class="radio-option">
                        <input type="radio" name="snel_hulp" value="nee" required>
                        <div class="radio-card">
                            <i class="fas fa-info-circle radio-icon"></i>
                            <span class="radio-text">Nee, alleen informatie</span>
                        </div>
                    </label>
                </div>
            </div>

            <div class="form-group">
                <label for="letsel"><i class="fas fa-heartbeat"></i> Korte omschrijving letsel *</label>
                <textarea id="letsel_beschrijving" name="letsel_beschrijving" rows="3" placeholder="Beschrijf kort het opgelopen letsel" required></textarea>
            </div>
            
            <!-- Navigation -->
            <div class="form-navigation">
                <button type="button" class="nav-button btn-previous" data-prev="1">
                    <i class="fas fa-arrow-left"></i>
                    Vorige
                </button>
                <button type="button" class="nav-button btn-next" data-next="3">
                    Volgende
                    <i class="fas fa-arrow-right"></i>
                </button>
            </div>
        </div>

        <!-- Stap 3 - Schade -->
        <div class="form-step" data-step="3">
            <div class="step-indicator">
                <i class="fas fa-info-circle"></i>
                Stap 3 van 6
            </div>
            <h3><i class="fas fa-exclamation-triangle"></i> Stap 3 – Schade</h3>
            
            <div class="form-group">
                <label><i class="fas fa-chart-line"></i> Hoe ernstig is de schade? *</label>
                <div class="radio-group">
                    <label class="radio-option">
                        <input type="radio" name="schade_ernst" value="licht" required>
                        <div class="radio-card damage-light">
                            <i class="fas fa-thumbs-up radio-icon"></i>
                            <span class="radio-text">Licht</span>
                        </div>
                    </label>
                    <label class="radio-option">
                        <input type="radio" name="schade_ernst" value="matig" required>
                        <div class="radio-card damage-moderate">
                            <i class="fas fa-exclamation-triangle radio-icon"></i>
                            <span class="radio-text">Matig</span>
                        </div>
                    </label>
                    <label class="radio-option">
                        <input type="radio" name="schade_ernst" value="ernstig" required>
                        <div class="radio-card damage-severe">
                            <i class="fas fa-exclamation-circle radio-icon"></i>
                            <span class="radio-text">Ernstig</span>
                        </div>
                    </label>
                </div>
            </div>

            <div class="form-group">
                <label for="schade_omschrijving"><i class="fas fa-file-alt"></i> Korte omschrijving schade *</label>
                <textarea id="schade_omschrijving" name="schade_omschrijving" rows="3" placeholder="Beschrijf kort de opgelopen schade" required></textarea>
            </div>

            <div class="form-group">
                <label for="schadebedrag"><i class="fas fa-euro-sign"></i> Indicatie schadebedrag (indien bekend)</label>
                <input type="text" id="schadebedrag" name="schadebedrag" placeholder="Bijvoorbeeld: €5.000 of onbekend">
            </div>
            
            <!-- Navigation -->
            <div class="form-navigation">
                <button type="button" class="nav-button btn-previous" data-prev="2">
                    <i class="fas fa-arrow-left"></i>
                    Vorige
                </button>
                <button type="button" class="nav-button btn-next" data-next="4">
                    Volgende
                    <i class="fas fa-arrow-right"></i>
                </button>
            </div>
        </div>

        <!-- Stap 4 - Arbeid & persoonlijke situatie -->
        <div class="form-step" data-step="4">
            <div class="step-indicator">
                <i class="fas fa-info-circle"></i>
                Stap 4 van 6
            </div>
            <h3><i class="fas fa-briefcase"></i> Stap 4 – Arbeid & persoonlijke situatie</h3>
            
            <div class="form-group">
                <label><i class="fas fa-user-injured"></i> Mate van arbeidsongeschiktheid *</label>
                <div class="radio-group">
                    <label class="radio-option">
                        <input type="radio" name="arbeidsongeschiktheid" value="geen" required>
                        <div class="radio-card">
                            <i class="fas fa-user-check radio-icon"></i>
                            <span class="radio-text">Geen</span>
                        </div>
                    </label>
                    <label class="radio-option">
                        <input type="radio" name="arbeidsongeschiktheid" value="gedeeltelijk" required>
                        <div class="radio-card">
                            <i class="fas fa-user-clock radio-icon"></i>
                            <span class="radio-text">Gedeeltelijk (geschatte duur)</span>
                        </div>
                    </label>
                    <label class="radio-option">
                        <input type="radio" name="arbeidsongeschiktheid" value="volledig" required>
                        <div class="radio-card">
                            <i class="fas fa-user-times radio-icon"></i>
                            <span class="radio-text">Volledig (geschatte duur)</span>
                        </div>
                    </label>
                </div>
            </div>

            <div class="form-group">
                <label><i class="fas fa-store"></i> Bent u zelfstandig ondernemer? *</label>
                <div class="radio-group">
                    <label class="radio-option">
                        <input type="radio" name="ondernemer" value="ja" required>
                        <div class="radio-card">
                            <i class="fas fa-briefcase radio-icon"></i>
                            <span class="radio-text">Ja</span>
                        </div>
                    </label>
                    <label class="radio-option">
                        <input type="radio" name="ondernemer" value="nee" required>
                        <div class="radio-card">
                            <i class="fas fa-user-tie radio-icon"></i>
                            <span class="radio-text">Nee</span>
                        </div>
                    </label>
                </div>
            </div>

            <div class="form-group">
                <label for="leeftijd"><i class="fas fa-birthday-cake"></i> Uw leeftijd *</label>
                <input type="number" id="leeftijd" name="leeftijd" min="18" max="100" placeholder="Bijvoorbeeld: 35" required>
            </div>
            
            <!-- Navigation -->
            <div class="form-navigation">
                <button type="button" class="nav-button btn-previous" data-prev="3">
                    <i class="fas fa-arrow-left"></i>
                    Vorige
                </button>
                <button type="button" class="nav-button btn-next" data-next="5">
                    Volgende
                    <i class="fas fa-arrow-right"></i>
                </button>
            </div>
        </div>

        <!-- Stap 5 - Extra hulp -->
        <div class="form-step" data-step="5">
            <div class="step-indicator">
                <i class="fas fa-info-circle"></i>
                Stap 5 van 6
            </div>
            <h3><i class="fas fa-hands-helping"></i> Stap 5 – Extra hulp</h3>
            
            <div class="form-group">
                <label><i class="fas fa-plus-circle"></i> Welke extra hulp heeft u nodig?</label>
                <div class="checkbox-group-multiple">
                    <label class="checkbox-option">
                        <input type="checkbox" name="extra_hulp[]" value="huishouding">
                        <div class="checkbox-card">
                            <i class="fas fa-home checkbox-icon"></i>
                            <span class="checkbox-text">Hulp in de huishouding</span>
                        </div>
                    </label>
                    <label class="checkbox-option">
                        <input type="checkbox" name="extra_hulp[]" value="kinderopvang">
                        <div class="checkbox-card">
                            <i class="fas fa-baby checkbox-icon"></i>
                            <span class="checkbox-text">Opvang voor de kinderen</span>
                        </div>
                    </label>
                    <label class="checkbox-option">
                        <input type="checkbox" name="extra_hulp[]" value="huisbezoek">
                        <div class="checkbox-card">
                            <i class="fas fa-user-md checkbox-icon"></i>
                            <span class="checkbox-text">Bezoek aan huis</span>
                        </div>
                    </label>
                </div>
            </div>
            
            <!-- Navigation -->
            <div class="form-navigation">
                <button type="button" class="nav-button btn-previous" data-prev="4">
                    <i class="fas fa-arrow-left"></i>
                    Vorige
                </button>
                <button type="button" class="nav-button btn-next" data-next="6">
                    Volgende
                    <i class="fas fa-arrow-right"></i>
                </button>
            </div>
        </div>

        <!-- Stap 6 - Contactgegevens -->
        <div class="form-step" data-step="6">
            <div class="step-indicator">
                <i class="fas fa-info-circle"></i>
                Stap 6 van 6 - Laatste stap!
            </div>
            <h3><i class="fas fa-address-book"></i> Stap 6 – Contactgegevens</h3>
            
            <div class="form-row">
                <div class="form-group">
                    <label for="firstname"><i class="fas fa-user"></i> Voornaam *</label>
                    <input type="text" id="firstname" name="firstname" placeholder="Voornaam" required>
                </div>
                <div class="form-group">
                    <label for="lastname"><i class="fas fa-user"></i> Achternaam *</label>
                    <input type="text" id="lastname" name="lastname" placeholder="Achternaam" required>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="telephone"><i class="fas fa-phone"></i> Telefoonnummer *</label>
                    <input type="tel" id="telephone" name="telephone" placeholder="088 076 76 76" required>
                </div>
                <div class="form-group">
                    <label for="email"><i class="fas fa-envelope"></i> E-mailadres *</label>
                    <input type="email" id="email" name="email" placeholder="uw@email.nl" required>
                </div>
            </div>

            <div class="form-group">
                <label for="availableTime"><i class="fas fa-clock"></i> Wanneer bent u het beste te bereiken? *</label>
                <select id="availableTime" name="availableTime" required>
                    <option value="">Selecteer tijd</option>
                    <option value="9">09:00</option>
                    <option value="10">10:00</option>
                    <option value="11">11:00</option>
                    <option value="12">12:00</option>
                    <option value="13">13:00</option>
                    <option value="14">14:00</option>
                    <option value="15">15:00</option>
                    <option value="16">16:00</option>
                    <option value="17">17:00</option>
                </select>
            </div>
            
            <div class="form-group">
                <label for="details"><i class="fas fa-comment"></i> Eventuele vragen en/of opmerkingen</label>
                <textarea id="details" name="details" rows="3" placeholder="Heeft u nog vragen of opmerkingen?"></textarea>
            </div>

            <!-- Privacy en Newsletter -->
            <div class="form-group checkbox-group required-checkbox">
                <label class="checkbox-label">
                    <input type="checkbox" name="privacy_akkoord" required>
                    <span class="checkmark"></span>
                    Ik ga akkoord met de <a href="/privacy" target="_blank" class="privacy-link">privacyverklaring</a> *
                </label>
            </div>
            
            <div class="form-group checkbox-group">
                <label class="checkbox-label">
                    <input type="checkbox" name="newsletter">
                    <span class="checkmark"></span>
                    Ik wil op de hoogte blijven van letselschade nieuws (optioneel)
                </label>
            </div>

            <!-- Navigation -->
            <div class="form-navigation">
                <button type="button" class="nav-button btn-previous" data-prev="5">
                    <i class="fas fa-arrow-left"></i>
                    Vorige
                </button>
                <button type="submit" class="nav-button btn-submit">
                    <i class="fas fa-paper-plane"></i>
                    Vraag gratis en vrijblijvend hulp aan
                </button>
            </div>
        </div>
        </form>
    </div>
</div>
