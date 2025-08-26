# Hospitality Starter — Laravel + Inertia/React (i18n-first)

Starter projekat za ugostiteljstvo/turizam sa **višejezičnošću od starta**: `/{locale}` prefiks (sr-Latn-RS, sr-Cyrl-RS, en), Inertia/React UI, SEO `hreflang`, i demo CMS stranica sa JSON prevodima (Spatie Translatable).

> Tag: `v0.1.0` — i18n osnova spremna kao template za nove projekte.

---

## Šta je unutra

- **Laravel 12** + PHP 8.2+
- **Inertia + React 18** (Vite)
- **Breeze** (auth skeleton)
- **i18n osnova**:  
  - `config/i18n.php` (default, fallback, supported)  
  - `SetLocale` middleware + `/{locale}` rute  
  - Inertia share (`locale`, `locales`, `auth`)  
  - React i18next + `LanguageSwitcher` komponenta  
  - SEO `hreflang` Blade komponenta  
- **CMS demo**: `Page` model (translatable JSON), migracija, seeder, ruta i Inertia prikaz

---

## Brzi start (Windows/XAMPP)

**Prereq**
- PHP 8.2+, Composer
- Node 18+ (npm/pnpm)
- MySQL 8+ (XAMPP) — napravi bazu npr. `hospitality_db`

**Setup**
```bash
composer install
cp .env.example .env

# .env minimalno:
# APP_URL=http://127.0.0.1:8088
# DB_CONNECTION=mysql
# DB_HOST=127.0.0.1
# DB_PORT=3306
# DB_DATABASE=hospitality_db
# DB_USERNAME=root
# DB_PASSWORD=
# CACHE_DRIVER=file
# SESSION_DRIVER=file
# QUEUE_CONNECTION=sync

php artisan key:generate
php artisan migrate
php artisan db:seed --class=PageSeed
Dev serveri (dva termina)


# 1) PHP dev (ako artisan serve ne radi na Win):
php -S 127.0.0.1:8088 -t public

# 2) Vite dev:
npm install
npm run dev
Otvori

http://127.0.0.1:8088/sr-Latn-RS/

http://127.0.0.1:8088/sr-Cyrl-RS/

http://127.0.0.1:8088/en/

Demo CMS Page (čitanje prevoda iz DB):

/sr-Latn-RS/stranica/kako-funkcionise

/sr-Cyrl-RS/stranica/како-функционише

/en/stranica/how-it-works

i18n – kako je rešeno
Konfig jezika: config/i18n.php
(default: sr-Latn-RS, fallback: en, supported: sr-Latn-RS, sr-Cyrl-RS, en)

Middleware: app/Http/Middleware/SetLocale.php

Rute: routes/web.php → sve javne rute pod /{locale} prefiksom.

SEO: resources/views/components/seo/hreflang.blade.php uključeno u resources/views/app.blade.php

Inertia share: u AppServiceProvider@boot() deli: locale, locales, auth

React i18n: resources/js/i18n/index.js + resources/js/Components/LanguageSwitcher.jsx

Dodavanje novog jezika

Dodaj ga u config/i18n.php (npr. de, it, hu …).

Dodaj UI ključeve u resources/js/i18n/index.js.

(Po potrebi) Unesi prevode u translatable polja (Page, kasnije Plan/Meal).

Hreflang linkovi se generišu automatski.

Struktura (ključni delovi)

app/
  Domain/Cms/Page.php                # translatable (Spatie)
  Http/Middleware/SetLocale.php
  Providers/AppServiceProvider.php   # Inertia::share(...)

config/i18n.php

database/
  migrations/****_create_pages_table.php
  seeders/PageSeed.php

resources/
  js/
    app.jsx                          # initI18n + glob za Pages
    i18n/index.js
    Components/LanguageSwitcher.jsx
    Pages/Welcome.jsx
    Pages/PageView.jsx
  views/app.blade.php                # @vite, @inertia, @include hreflang
  views/components/seo/hreflang.blade.php

routes/web.php                       # {locale} grupa + demo Page ruta
Build (bez dev servera)

npm run build
# koristi public/build/manifest.json
Troubleshooting (najčešće)
ERR_CONNECTION_REFUSED → dev server nije upaljen. Pokreni:
php -S 127.0.0.1:8088 -t public

Unable to locate file in Vite manifest: ... → pokreni npm run dev ili npm run build; proveri da app.jsx globuje ./Pages/**/*.jsx.

Class Inertia not found ili App\Providers\Inertia → dodaj use Inertia\Inertia; (i use Illuminate\Support\Facades\Vite;) u AppServiceProvider.

SQLite i JSON (JSON_UNQUOTE not found) → koristi MySQL (preporuka) ili SQLite-kompatibilan upit (json_extract uz navodnike).

optimize:clear traži cache tabelu → u .env koristi CACHE_DRIVER=file i SESSION_DRIVER=file za dev ili napravi tabele:
php artisan cache:table && php artisan session:table && php artisan migrate.

Korišćenje kao template
Preporuka: u GitHub repou uključite Settings → Template repository i pokrećite nove projekte klikom na Use this template.

Nakon kreiranja, uradite: composer install, .env, migrate, db:seed, npm install, npm run dev.

Git grane & tagovi
main — template (stabilno)

feature/* — nove funkcionalnosti (npr. feature/order-wizard)

Tagovi:

v0.1.0 — i18n foundation

.gitattributes (LF preporuka)

* text=auto
*.php       text eol=lf
*.blade.php text eol=lf
*.js        text eol=lf
*.jsx       text eol=lf
*.ts        text eol=lf
*.tsx       text eol=lf
*.css       text eol=lf
*.scss      text eol=lf
*.json      text eol=lf
*.md        text eol=lf
*.yml       text eol=lf
*.yaml      text eol=lf
*.png  -text
*.jpg  -text
*.jpeg -text
*.gif  -text
*.webp -text
*.ico  -text
*.pdf  -text
*.ttf  -text
*.otf  -text
*.woff -text
*.woff2 -text
Renormalizacija:


git add --renormalize .
git commit -m "chore(gitattributes): normalize line endings"
Roadmap (predloga za sledeće korake)
Order Wizard 1–5: plan → kcal → trajanje → adresa/zone → potvrda

obračun iz price_matrix

validacija zone/prozora

kreiranje orders

PDF predračun + email potvrda

Delivery: zone/windows/shipping + manifest i export kurirskih ruta

Admin (Filament): Orders Kanban, Menu Builder, Price Matrix

Payments V2: Stripe/PayPal (kasnije), fiskalni modul (Srbija)

Mobile (RN/Expo): klijentska app + “assistant waiter” (stolovi, KDS)

Licenca
Starter je deo internih radova za Hospitality/Tourism ponudu. Open-source delovi prate licence svojih autora (Laravel, Breeze, itd.).