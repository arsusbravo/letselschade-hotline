<div class="contact-form">
    <form action="#" method="POST">
        <div class="form-row">
            <div class="form-group">
                <label for="first_name"><i class="fas fa-user"></i> Voornaam *</label>
                <input type="text" id="first_name" name="first_name" required>
            </div>
            <div class="form-group">
                <label for="last_name"><i class="fas fa-user"></i> Achternaam *</label>
                <input type="text" id="last_name" name="last_name" required>
            </div>
        </div>
        
        <div class="form-row">
            <div class="form-group">
                <label for="email"><i class="fas fa-envelope"></i> Email *</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="phone"><i class="fas fa-phone"></i> Telefoonnummer *</label>
                <input type="tel" id="phone" name="phone" required>
            </div>
        </div>
        
        <div class="form-group">
            <label for="address"><i class="fas fa-map-marker-alt"></i> Adres *</label>
            <input type="text" id="address" name="address" placeholder="Straat, huisnummer, postcode en plaats" required>
        </div>
        
        <div class="form-row">
            <div class="form-group">
                <label for="accident_date"><i class="fas fa-calendar"></i> Datum ongeval *</label>
                <input type="date" id="accident_date" name="accident_date" required>
            </div>
            <div class="form-group">
                <label for="accident_type"><i class="fas fa-car-crash"></i> Type ongeval *</label>
                <select id="accident_type" name="accident_type" required>
                    <option value="">Selecteer type ongeval</option>
                    <option value="verkeer">Verkeersongeval</option>
                    <option value="werk">Arbeidsongeval</option>
                    <option value="sport">Sportongeval</option>
                    <option value="medisch">Medische fout</option>
                    <option value="slip">Slip en val</option>
                    <option value="anders">Anders</option>
                </select>
            </div>
        </div>
        
        <div class="form-group">
            <label for="accident_description"><i class="fas fa-file-alt"></i> Wat is er gebeurd? *</label>
            <textarea id="accident_description" name="accident_description" rows="4" placeholder="Beschrijf kort wat er is gebeurd en welke letsel u heeft opgelopen" required></textarea>
        </div>
        
        <div class="form-row">
            <div class="form-group">
                <label for="liable_party"><i class="fas fa-question-circle"></i> Is er een schuldige wederpartij?</label>
                <select id="liable_party" name="liable_party">
                    <option value="">Selecteer een optie</option>
                    <option value="yes">Ja</option>
                    <option value="no">Nee</option>
                    <option value="unknown">Onbekend</option>
                </select>
            </div>
            <div class="form-group">
                <label for="call_time"><i class="fas fa-clock"></i> Wanneer mogen wij u bellen?</label>
                <select id="call_time" name="call_time">
                    <option value="">Selecteer een tijdstip</option>
                    <option value="morning">Ochtend (9:00 - 12:00)</option>
                    <option value="afternoon">Middag (12:00 - 17:00)</option>
                    <option value="evening">Avond (17:00 - 20:00)</option>
                </select>
            </div>
        </div>
        
        <div class="form-group">
            <label for="additional_info"><i class="fas fa-info-circle"></i> Aanvullende informatie</label>
            <textarea id="additional_info" name="additional_info" rows="3" placeholder="Eventuele aanvullende informatie die u wilt delen"></textarea>
        </div>
        
        <div class="form-group checkbox-group">
            <label class="checkbox-label">
                <input type="checkbox" name="privacy_policy" required>
                <span class="checkmark"></span>
                Ik ga akkoord met de <a href="#" class="link">privacyverklaring</a> *
            </label>
        </div>
        
        <div class="form-group checkbox-group">
            <label class="checkbox-label">
                <input type="checkbox" name="newsletter">
                <span class="checkmark"></span>
                Ik wil op de hoogte blijven van letselschade nieuws (optioneel)
            </label>
        </div>
        
        <button type="submit" class="submit-btn">
            <i class="fas fa-paper-plane"></i> Versturen
        </button>
    </form>
</div> 