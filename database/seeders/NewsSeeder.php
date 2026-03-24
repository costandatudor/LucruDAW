<?php

namespace Database\Seeders;

use App\Models\News;
use Illuminate\Database\Seeder;

class NewsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $news = [
            [
                'title' => 'Bine ați venit în sistemul nostru de știri',
                'content' => 'Suntem încântați să vă prezentăm noul nostru sistem de gestionare a știrilor. Acest sistem permite administratorilor să adauge, editeze și publice știri într-un mod simplu și eficient.

Caracteristicile principale includ:
- Interfață modernă și intuitivă
- Sistem de autentificare securizat
- Gestionare ușoară a conținutului
- Suport pentru imagini și fișiere media
- Publicare instantanee sau programată

Vă invităm să explorați toate funcționalitățile disponibile în dashboard-ul dumneavoastră.',
                'excerpt' => 'Descoperiți noul sistem de gestionare a știrilor cu interfață modernă și funcționalități avansate.',
                'author' => 'Administrator',
                'published' => true,
                'published_at' => now()->subDays(2),
            ],
            [
                'title' => 'Actualizare de securitate implementată',
                'content' => 'Am implementat o serie de măsuri de securitate suplimentare pentru a proteja datele dumneavoastră și pentru a asigura o experiență cât mai sigură.

Printre îmbunătățirile aduse se numără:
- Criptarea avansată a parolelor folosind algoritmul bcrypt
- Validarea robustă a datelor de intrare
- Protecție împotriva atacurilor CSRF
- Sesiuni securizate cu regenerare automată
- Monitorizare continuă a activității suspecte

Aceste măsuri asigură că platforma noastră rămâne una dintre cele mai sigure soluții disponibile.',
                'excerpt' => 'Implementăm noi măsuri de securitate pentru a proteja datele și a asigura o experiență sigură pentru toți utilizatorii.',
                'author' => 'Echipa Tehnică',
                'published' => true,
                'published_at' => now()->subDays(5),
            ],
            [
                'title' => 'Ghid pentru utilizarea sistemului de știri',
                'content' => 'Pentru a vă ajuta să utilizați cât mai eficient sistemul nostru de știri, am pregătit acest ghid complet cu toate funcționalitățile disponibile.

Cum să adăugați o știre nouă:
1. Accesați secțiunea "Știri" din meniul principal
2. Apăsați butonul "Adaugă Știre Nouă"
3. Completați titlul și conținutul
4. Adăugați un rezumat scurt (opțional)
5. Încărcați o imagine reprezentativă (opțional)
6. Alegeți dacă doriți să publicați imediat sau mai târziu

Sistemul vă permite să gestionați toate știrile într-un mod organizat și eficient.',
                'excerpt' => 'Ghid complet pentru utilizarea sistemului de știri, cu instrucțiuni pas cu pas pentru toate funcționalitățile.',
                'author' => 'Suport Tehnic',
                'published' => true,
                'published_at' => now()->subDays(7),
            ],
            [
                'title' => 'Îmbunătățiri în interfața de utilizator',
                'content' => 'Am adus numeroase îmbunătățiri la interfața de utilizator pentru a face experiența cât mai plăcută și intuitivă.

Principalele schimbări includ:
- Design modern și responsiv
- Navigare îmbunătățită cu meniuri clare
- Formulare interactive cu validare în timp real
- Animații subtile pentru o experiență fluidă
- Suport complet pentru dispozitive mobile
- Paletă de culori modernă și accesibilă

Toate aceste îmbunătățiri au fost implementate cu focus pe experiența utilizatorului și pe ușurința în utilizare.',
                'excerpt' => 'Interfața de utilizator a fost complet reînnoită cu design modern, responsiv și funcționalități îmbunătățite.',
                'author' => 'Echipa Design',
                'published' => true,
                'published_at' => now()->subDays(10),
            ],
            [
                'title' => 'Planuri de dezvoltare pentru viitor',
                'content' => 'Urmărim constant să îmbunătățim platforma noastră și să adăugăm noi funcționalități care să fie utile pentru utilizatori.

În viitorul apropiat planificăm:
- Sistem de comentarii pentru știri
- Căutare avansată și filtrare
- Export de știri în diferite formate
- Integrare cu rețele sociale
- Notificări push pentru știri noi
- Analize și statistici detaliate

Vă invităm să ne transmiteți sugestiile dumneavoastră pentru funcționalități noi pe care doriți să le vedeți implementate.',
                'excerpt' => 'Descoperiți planurile noastre de dezvoltare și funcționalitățile noi care vor fi adăugate în viitorul apropiat.',
                'author' => 'Management',
                'published' => false,
                'published_at' => null,
            ],
        ];

        foreach ($news as $article) {
            News::create($article);
        }
    }
}