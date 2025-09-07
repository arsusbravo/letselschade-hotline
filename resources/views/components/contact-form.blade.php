<div class="contact-form">
    <form action="/webreaction/contact" method="POST" id="contact-form">
        @csrf
        
        <!-- Anti-spam honeypot field (hidden) -->
        <input type="text" name="website" style="display:none" tabindex="-1" autocomplete="off">
        
        <!-- Anti-spam timestamp -->
        <input type="hidden" name="form_start_time" value="{{ time() }}">
        
        <div class="form-group">
            <label for="gender"><i class="fas fa-user"></i> Aanhef *</label>
            <select id="gender" name="gender" required>
                <option value="">Selecteer aanhef</option>
                <option value="dhr">Dhr.</option>
                <option value="mevr">Mevr.</option>
            </select>
        </div>
        
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
        
        <div class="form-group">
            <label for="email"><i class="fas fa-envelope"></i> E-mailadres *</label>
            <input type="email" id="email" name="email" placeholder="uw@email.nl" required>
        </div>
        
        <div class="form-group">
            <label for="telephone"><i class="fas fa-phone"></i> Telefoonnummer</label>
            <input type="tel" id="telephone" name="telephone" placeholder="088 076 76 76">
            <small class="field-help">Optioneel - wij bellen u terug als u dit invult</small>
        </div>
        
        <div class="form-group">
            <label for="subject"><i class="fas fa-tag"></i> Onderwerp *</label>
            <select id="subject" name="subject" required>
                <option value="">Selecteer een onderwerp</option>
                <option value="letselschade">Letselschade claim</option>
                <option value="verkeer">Verkeersongeval</option>
                <option value="werk">Arbeidsongeval</option>
                <option value="medisch">Medische fout</option>
                <option value="slip">Slip en val</option>
                <option value="vraag">Algemene vraag</option>
                <option value="anders">Anders</option>
            </select>
        </div>
        
        <div class="form-group">
            <label for="details"><i class="fas fa-comment"></i> Bericht *</label>
            <textarea id="details" name="details" rows="5" placeholder="Beschrijf uw situatie of vraag..." required></textarea>
        </div>
        
        
        <button type="submit" class="submit-btn">
            <i class="fas fa-paper-plane"></i> Bericht versturen
        </button>
    </form>
</div>