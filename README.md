# SzymokiCMS
Small CMS for mini webpages

CMS based on Codeigniter 4 PHP 7.4 framework


### Wersja lokalna
Instalujemy zależności composera
```
composer install
```

Kopiujemy plik konfiguracyjny i uzupełniamy go adres danymi bazy danych itp
```
cp .env_local2 .env
```

Włączamy serwer testowy (wersja PHP 7.4)
```
cd public_html
php -S 0.0.0.0:9999
```
