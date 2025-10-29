<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;

class ReviewsController extends Controller
{
    /**
     * Get all reviews data (static method for shared access)
     */
    public static function getAllReviews()
    {
        return [
            [
                'name' => 'David',
                'date' => '14 juli 2025',
                'comment' => 'Na mijn auto-ongeluk ben ik snel en uitstekend geholpen door Judith. Het resultaat was precies zoals gehoopt; ik kan haar van harte aanbevelen.'
            ],
            [
                'name' => 'Saskia',
                'date' => '27 juni 2025',
                'comment' => 'Vanaf het eerste contact met Roel en Judith voelde ik me deskundig en persoonlijk begeleid. De afhandeling was accuraat en met een mooi resultaat.'
            ],
            [
                'name' => 'Malcolm',
                'date' => '17 maart 2025',
                'comment' => 'Dank aan Judith en Roel voor hun deskundigheid, vasthoudendheid en betrokkenheid. Ik beveel Letselschade-begeleiding B.V. Breda zeker aan.'
            ],
            [
                'name' => 'Henk',
                'date' => '13 februari 2025',
                'comment' => 'Ik ben zeer tevreden over de professionele en doortastende aanpak. Dankzij Judith en Roel is mijn zaak succesvol afgerond.'
            ],
            [
                'name' => 'Carlo Berntsen',
                'date' => '22 november 2024',
                'comment' => 'Roel en Judith hebben mij zeer professioneel geholpen bij mijn letselschadezaak. Ik raad Letselschade-begeleiding Breda absoluut aan.'
            ],
            [
                'name' => 'Lisa',
                'date' => '18 oktober 2024',
                'comment' => 'Na mijn auto-ongeluk werd alles duidelijk uitgelegd en ook thuis met mij doorgenomen. De afronding verliep soepel en ik ben supergoed geholpen.'
            ],
            [
                'name' => 'Ellen',
                'date' => '2 augustus 2024',
                'comment' => 'Ik ben heel dankbaar voor de zorg en het meedenken. Regelmatige updates en goed advies gaven veel rust.'
            ],
            [
                'name' => 'Marianne Lagerweij-van Zanten',
                'date' => '24 juli 2024',
                'comment' => 'Door de bemiddeling van Letselschade-begeleiding ontving ik binnen een jaar vergoeding. Zelf regelen liep vast; dit team verdient een 10+.'
            ],
            [
                'name' => 'Kitty',
                'date' => '22 juli 2024',
                'comment' => 'Vanaf het eerste contact voelde ik me in deskundige en betrokken handen. Afspraken werden nagekomen en de communicatie was steeds helder.'
            ],
            [
                'name' => 'José',
                'date' => '18 juli 2024',
                'comment' => 'Het contact met Judith en Roel was warm en professioneel. Zonder hen had ik nooit zo\'n goed financieel resultaat behaald.'
            ],
            [
                'name' => 'Maureen Jacobs',
                'date' => '9 juli 2024',
                'comment' => 'Roel gaf thuis helder advies en Judith communiceerde duidelijk per telefoon en mail. Ik wist altijd wat er van mij verwacht werd en ben zeer tevreden.'
            ],
            [
                'name' => 'Linda Scheffer',
                'date' => '17 juni 2024',
                'comment' => 'Ondanks een langzame start door omstandigheden is de zaak netjes opgelost. Bij een volgende keer kies ik weer voor Letselschade-begeleiding.'
            ],
            [
                'name' => 'Ramon K',
                'date' => '21 mei 2024',
                'comment' => 'Judith en Roel stonden altijd klaar met advies en dachten mee in mijn herstel. Hun inzet maakte de afhandeling een stuk makkelijker.'
            ],
            [
                'name' => 'Frank',
                'date' => '16 april 2024',
                'comment' => 'Ik ben na mijn arbeidsongeval duidelijk en zorgvuldig begeleid door Roel en Judith. Het dossier is nu rond en ik ben hen erg dankbaar.'
            ],
            [
                'name' => 'Youri',
                'date' => '11 maart 2024',
                'comment' => 'Communicatie was altijd duidelijk en reacties waren snel. Vragen werden meteen opgepakt, wat na het ongeluk veel steun gaf.'
            ],
            [
                'name' => 'Theo Wijgergangs',
                'date' => '22 februari 2024',
                'comment' => 'Alle rompslomp na mijn aanrijding is deskundig overgenomen. Ik ben zeer vriendelijk en professioneel geholpen.'
            ],
            [
                'name' => 'Rei Hosokawa',
                'date' => '7 februari 2024',
                'comment' => 'From the first home visit to the final calls, I felt truly looked after. Clear communication and professional dedication made all the difference.'
            ],
            [
                'name' => 'Anoniem',
                'date' => '30 augustus 2023',
                'comment' => 'Ik ben altijd netjes en correct geholpen. Heel tevreden over de aanpak.'
            ],
            [
                'name' => 'Mw. Evers-van Gils',
                'date' => '20 april 2023',
                'comment' => 'Na mijn ongeval waren Roel en Judith mijn steun en toeverlaat. Dankzij hun hulp kon ik het nu netjes afsluiten.'
            ],
            [
                'name' => 'Rob Zwart',
                'date' => '4 januari 2023',
                'comment' => 'Professioneel en meedenkend bureau met uitstekende communicatie. Ik werd steeds keurig op de hoogte gehouden.'
            ],
            [
                'name' => 'Dhr. Jacobs',
                'date' => '28 december 2022',
                'comment' => 'Drie jaar lang ben ik uitstekend bijgestaan met maximale resultaten. Judith en Roel waren altijd goed bereikbaar voor al mijn vragen.'
            ],
            [
                'name' => 'Yağmur',
                'date' => '21 september 2022',
                'comment' => 'Altijd bereikbaar en je wordt echt gehoord. Warm bedrijf dat er is in zware tijden.'
            ],
            [
                'name' => 'Desiré',
                'date' => '12 september 2022',
                'comment' => 'Persoonlijke, menselijke benadering die doorvertaalt naar een sterke claim. Dankzij hen kreeg ik behandelingen vergoed en vond ik rust.'
            ],
            [
                'name' => 'Anoniem',
                'date' => '9 september 2022',
                'comment' => 'Hartelijk dank voor de begeleiding van mijn letselschade. Zonder jullie was dit niet gelukt.'
            ],
            [
                'name' => 'Said (Delft)',
                'date' => '20 juli 2022',
                'comment' => 'Ik ben uitstekend geholpen en 100% tevreden. Hartelijk dank voor alles.'
            ],
            [
                'name' => 'Raina',
                'date' => '24 juni 2022',
                'comment' => 'We zijn zeer tevreden over de hulp en de duidelijke, snelle mailcontacten met Judith. Dit bedrijf raden wij zeker aan.'
            ],
            [
                'name' => 'Jolanda',
                'date' => '22 juni 2022',
                'comment' => 'Het contact was snel en betrokken, met aandacht voor mijn gezondheid. Ik ontving ook een passende vergoeding—bedankt voor de goede zorg.'
            ],
            [
                'name' => 'José',
                'date' => '2 mei 2022',
                'comment' => 'Roel en Judith boden in een moeilijke periode vakkundige en menselijke steun. Financieel én persoonlijk meer dan verwacht.'
            ],
            [
                'name' => 'C.V. Nijmeijer',
                'date' => '13 april 2022',
                'comment' => 'Vragen werden snel beantwoord en problemen voortvarend aangepakt. Mijn dossier is onlangs uitstekend afgesloten.'
            ],
            [
                'name' => 'Poppe Wijnsma',
                'date' => '28 maart 2022',
                'comment' => 'Mijn letselschade is adequaat afgehandeld met een goed financieel resultaat. Ik beveel dit bureau van harte aan.'
            ],
            [
                'name' => 'Emilia',
                'date' => '7 februari 2022',
                'comment' => 'De zaak verliep soepel met goed contact en snelle reacties. Zeer tevreden over het resultaat.'
            ],
            [
                'name' => 'Anoniem',
                'date' => '6 februari 2022',
                'comment' => 'Vanaf het eerste huisbezoek voelde ik me kundig geholpen. Telefonisch en per mail werd ik steeds netjes te woord gestaan.'
            ],
            [
                'name' => 'Dave',
                'date' => '27 december 2021',
                'comment' => 'Na mijn bedrijfsongeval ben ik uitstekend begeleid door Judith en Roel. Ik kan Letselschade-begeleiding BV aan iedereen aanbevelen.'
            ],
            [
                'name' => 'Jessica',
                'date' => '27 december 2021',
                'comment' => 'Acht jaar lang bleven ze betrokken en gaven ze snelle, duidelijke updates. Daardoor is de zaak naar volle tevredenheid afgerond.'
            ],
            [
                'name' => 'Marga van den Berg',
                'date' => '11 oktober 2021',
                'comment' => 'Na een kop-staartbotsing kreeg ik begripvolle en effectieve hulp. Dankzij hun aanpak herstelde ik bijna volledig en werd alles netjes geregeld.'
            ],
            [
                'name' => 'Mw. Lourens',
                'date' => '9 september 2021',
                'comment' => 'Ik ben van begin tot eind supertevreden over de samenwerking. Hartelijk dank voor alles wat u voor mij heeft gedaan.'
            ],
            [
                'name' => 'Peter',
                'date' => '2 augustus 2021',
                'comment' => 'Professionele begeleiding met duidelijke afstemming over elke stap. Er was naast deskundigheid ook aandacht voor de mens.'
            ],
            [
                'name' => 'Margriet',
                'date' => '30 juli 2021',
                'comment' => 'Een goed bedrijf dat doet wat het belooft. Van mij krijgen ze een dikke 9.'
            ],
            [
                'name' => 'Karima Saddik',
                'date' => '21 juni 2021',
                'comment' => 'Judith en Roel begeleidden mijn complexe zaak transparant, betrokken en bereikbaar. Dat gaf vertrouwen en leidde tot het juiste resultaat.'
            ],
            [
                'name' => 'Theo Gaarenstroom',
                'date' => '20 april 2021',
                'comment' => 'Zeer tevreden met de begeleiding en uitkomst van mijn letselschade. Ik kan hen iedereen aanbevelen.'
            ],
            [
                'name' => 'Yvonne',
                'date' => '14 april 2021',
                'comment' => 'Na vijf zware jaren is mijn zaak goed afgesloten dankzij volharding en duidelijke samenwerking. Ik beveel Letselschade-begeleiding zeker aan.'
            ],
            [
                'name' => 'Ingrid',
                'date' => '8 maart 2021',
                'comment' => 'Ik kreeg duidelijke antwoorden en het beste resultaat in mijn zaak. Ze namen al mijn vragen serieus en regelden alles uitstekend.'
            ],
            [
                'name' => 'Zlatan',
                'date' => '25 februari 2021',
                'comment' => 'Fijn en professioneel geholpen, altijd bereikbaar. Absoluut een aanrader.'
            ],
            [
                'name' => 'Adolphe',
                'date' => '10 december 2020',
                'comment' => 'Ondanks stress en tegenwerking bleef het team rustig en duidelijk communiceren. Het is nu gelukkig afgerond.'
            ],
            [
                'name' => 'Nadine',
                'date' => '8 december 2020',
                'comment' => 'Mijn claim is naar grote tevredenheid afgehandeld. Bedankt voor de deskundigheid.'
            ],
            [
                'name' => 'Willem',
                'date' => '22 november 2020',
                'comment' => 'Na een slechte start bij een ander kantoor kozen we voor Letselschade-begeleiding, en dat maakte het verschil. Roel en Judith werkten professioneel, to the point en hielden ons continu op de hoogte.'
            ],
            [
                'name' => 'Ron Groters',
                'date' => '17 september 2020',
                'comment' => 'We kozen voor korte lijnen en een informele, duidelijke aanpak; dat pakte uitstekend uit. Roel is kundig, helder en zonder poespas—een aanrader.'
            ],
            [
                'name' => 'Gerrie Bouwhuis',
                'date' => '17 september 2020',
                'comment' => 'In een lastige wending hebben jullie me weer uit het dal geholpen. Alles is alsnog rondgekomen; hartelijk dank.'
            ],
            [
                'name' => 'Corrie Dusseljee',
                'date' => '3 juni 2020',
                'comment' => 'Na een aanrijding nam Letselschade-begeleiding de zaak voortvarend over. Ik werd steeds geïnformeerd en de afhandeling was keurig.'
            ],
            [
                'name' => 'Anoniem',
                'date' => '3 juni 2020',
                'comment' => 'Ze kijken verder dan alleen het letsel en begeleiden van begin tot eind. Alles werd perfect geregeld—dank!'
            ],
            [
                'name' => 'Anoniem',
                'date' => '18 april 2020',
                'comment' => 'Meelevende mensen die het uiterste voor je doen en alles helder uitleggen. Het contact verliep soepel en ik ben zeer tevreden.'
            ],
            [
                'name' => 'Edward K.',
                'date' => '13 maart 2020',
                'comment' => 'Complexe situatie, maar vanaf het begin kreeg ik krachtige, professionele steun. Ze werkten efficiënt en consequent richting resultaat.'
            ],
            [
                'name' => 'Eyup Kondu',
                'date' => '13 maart 2020',
                'comment' => 'Ik ben blij dat ik voor Letselschade-begeleiding heb gekozen. Roel en zijn team raad ik iedereen met letsel aan.'
            ],
            [
                'name' => 'Lilian Mohamedjar',
                'date' => '7 maart 2020',
                'comment' => 'Zeven jaar lang kreeg ik empathische en vasthoudende begeleiding door Roel en Judith. Het eindresultaat is rechtvaardig en ik ben zeer tevreden.'
            ],
            [
                'name' => 'Anoniem',
                'date' => '7 maart 2020',
                'comment' => 'Sinds 2015 ben ik volledig ontzorgd en steeds goed op de hoogte gehouden. Dankzij hun vasthoudendheid is de zaak met succes afgerond.'
            ],
            [
                'name' => 'Jeremy P. Doorduyn',
                'date' => '17 februari 2020',
                'comment' => 'Waar rechtsbijstand tekortschiet, maakte Letselschade-begeleiding echt het verschil. Deskundig, menselijk en met een goede eindregeling.'
            ],
            [
                'name' => 'Miranda',
                'date' => '18 januari 2020',
                'comment' => 'Bedankt voor de volhardende inzet en prettige samenwerking. Ik zou jullie zeker aanraden.'
            ],
            [
                'name' => 'Anita Noten',
                'date' => '18 januari 2020',
                'comment' => 'Dankzij de goede ondersteuning en heldere informatie is mijn zaak naar volle tevredenheid afgehandeld. Mijn complimenten!'
            ],
            [
                'name' => 'Femke',
                'date' => '19 december 2019',
                'comment' => 'Ik werd regelmatig en snel geïnformeerd en heb een uitstekende eindregeling gekregen. Mocht het nodig zijn, kies ik opnieuw voor dit bureau.'
            ],
            [
                'name' => 'M. Radhe',
                'date' => '14 december 2019',
                'comment' => 'Mijn dossier is goed en zorgvuldig behandeld. Ik ben heel blij met jullie werk.'
            ],
            [
                'name' => 'Jacqueline',
                'date' => '25 november 2019',
                'comment' => 'Fijne ondersteuning na mijn ongeval en een nette financiële afwikkeling. Alles naar tevredenheid geregeld.'
            ],
            [
                'name' => 'Nelson Perestrelo',
                'date' => '22 juli 2019',
                'comment' => 'Het proces duurde lang, maar de communicatie bleef helder en respectvol. Er is een nette schikking bereikt waardoor ik het kan afsluiten.'
            ],
            [
                'name' => 'Bert',
                'date' => '15 juli 2019',
                'comment' => 'Dank voor de begeleiding; alleen had ik dit nooit gered. Het duurde even, maar het is goed afgewikkeld.'
            ],
            [
                'name' => 'Arjan',
                'date' => '15 juli 2019',
                'comment' => 'Bij mijn eerste ongeval was de actieve communicatie erg prettig. De begeleiding was uitstekend.'
            ],
            [
                'name' => 'Jantine Oudesluijs',
                'date' => '15 juli 2019',
                'comment' => 'Dank voor zes jaar inzet bij mijn medische-foutzaak. Het persoonlijke contact en medeleven waren uitzonderlijk.'
            ],
            [
                'name' => 'T. Kostense',
                'date' => '22 mei 2019',
                'comment' => 'Vriendelijke medewerkers met duidelijke communicatie begeleidden ons door het hele proces. Alles is naar behoren afgehandeld, wat veel uitmaakt in zo\'n periode.'
            ],
            [
                'name' => 'Erna de Lorijn-Husken',
                'date' => '25 april 2019',
                'comment' => 'Jullie hebben snel, geduldig en met aandacht geluisterd. Zonder jullie was dit nooit gelukt—enorm bedankt.'
            ],
            [
                'name' => 'C. Geneugelijk',
                'date' => '5 april 2019',
                'comment' => 'Judith handelde onze zaak snel en goed af en Roel gaf tijdens huisbezoeken sterke adviezen. Heel veel dank voor de hulp.'
            ],
            [
                'name' => 'Mado',
                'date' => '15 maart 2019',
                'comment' => 'Er werd meteen na het ongeluk gehandeld en afspraken werden nagekomen. Ik voelde me gezien, niet als nummer—super bedankt!'
            ],
            [
                'name' => 'Ed Saelens',
                'date' => '25 januari 2019',
                'comment' => 'Persoonlijke én professionele begeleiding na blijvend letsel. Er is correct en doortastend onderhandeld met de tegenpartij.'
            ],
            [
                'name' => 'Rene Bertens',
                'date' => '10 december 2018',
                'comment' => 'Ik ben zeer tevreden met alle hulp die ik heb gekregen. Bedankt voor de inzet.'
            ],
            [
                'name' => 'Fadoua',
                'date' => '16 november 2018',
                'comment' => 'De bemiddeling was prettig en de uitkomst erg goed. Bedankt voor de afhandeling van mijn claim.'
            ],
            [
                'name' => 'Maarten',
                'date' => '16 november 2018',
                'comment' => 'Mijn zaak uit 2015 is zeer goed behartigd met professionele hulp van Roel en snelle, duidelijke mails van Judith. Dank voor alles!'
            ],
            [
                'name' => 'Mw. Wat',
                'date' => '16 november 2018',
                'comment' => 'Ik ben deskundig en goed geadviseerd. De afhandeling was naar tevredenheid.'
            ],
            [
                'name' => 'Robert',
                'date' => '31 augustus 2018',
                'comment' => 'Drie jaar lang ben ik professioneel begeleid na mijn fietsongeluk. Snel schakelen en efficiënte aanpak—heel veel dank.'
            ],
            [
                'name' => 'J.J.W. Kok',
                'date' => '31 augustus 2018',
                'comment' => 'Hartelijk dank voor alles. Ik ben zeer tevreden.'
            ],
            [
                'name' => 'Laurina',
                'date' => '22 juli 2018',
                'comment' => 'Letselschade-begeleiding overtrof mijn verwachtingen met deskundig advies en persoonlijke aandacht. Ze hebben alles gedaan voor het beste resultaat.'
            ],
            [
                'name' => 'Oussama El Hammouti',
                'date' => '19 juni 2018',
                'comment' => 'Ik werd geholpen bij het aansprakelijk stellen van de tegenpartij. Vanaf het begin voelde ik me gehoord en gesteund.'
            ],
            [
                'name' => 'Jamila',
                'date' => '7 juni 2018',
                'comment' => 'Professionele hulp, snelle service en duidelijke communicatie leverden succes op. Doortastend en standvastig—ik raad hen iedereen aan.'
            ],
            [
                'name' => 'Miriam',
                'date' => '23 maart 2018',
                'comment' => 'Erg fijne, professionele én persoonlijke benadering. Ik voelde me gehoord en serieus genomen.'
            ],
            [
                'name' => 'Roy',
                'date' => '23 februari 2018',
                'comment' => 'Heldere en professionele communicatie per telefoon en e-mail. Ik kan Letselschade-begeleiding iedereen aanraden.'
            ],
            [
                'name' => 'Anoniem',
                'date' => '9 februari 2018',
                'comment' => 'Waar wij twijfelden, ging Roel door—met succes. Bedankt voor de goede zorgen.'
            ],
            [
                'name' => 'Anoniem',
                'date' => '9 februari 2018',
                'comment' => 'Tweeënhalf jaar lang stond het team klaar met vlotte, keurige antwoorden en sterke begeleiding. Dankzij hen werden alle kosten vergoed en kon ik verder.'
            ],
            [
                'name' => 'Latysha',
                'date' => '9 februari 2018',
                'comment' => 'Ik ben blij dat ik bij jullie terechtkon in een moeilijke periode. Dank u wel voor alles.'
            ],
            [
                'name' => 'Irma Haider',
                'date' => '9 februari 2018',
                'comment' => 'Snel reageren, persoonlijke betrokkenheid en een mooi resultaat. Ik beveel dit bureau van harte aan.'
            ],
            [
                'name' => 'Khalid',
                'date' => '22 januari 2018',
                'comment' => 'Door volharding en vasthoudendheid behaalde LB mijn volledige rechten. Ondanks tegenwerking van de verzekeraar bleef het team doorgaan tot tevreden afronding.'
            ]
        ];
    }

    /**
     * Display paginated reviews
     */
    public function index(Request $request)
    {
        $allReviews = self::getAllReviews();
        $perPage = 10; // Reviews per page
        $currentPage = $request->get('page', 1);
        
        // Manual pagination for array data
        $total = count($allReviews);
        $offset = ($currentPage - 1) * $perPage;
        $items = array_slice($allReviews, $offset, $perPage);
        
        $reviews = new LengthAwarePaginator(
            $items,
            $total,
            $perPage,
            $currentPage,
            [
                'path' => $request->url(),
                'query' => $request->query(),
            ]
        );
        
        return view('reviews', compact('reviews'));
    }
}

