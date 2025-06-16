# Simple CMS

Un Content Management System semplice sviluppato con PHP, SQLite e Bootstrap.

## Descrizione
CMS semplice realizzato in PHP per la gestione di un blog. Permette di creare, modificare e cancellare articoli, gestire categorie, caricare immagini e organizzare contenuti.

## Requisiti
- PHP 7.4 o superiore
- SQLite
- Server web (Apache, Nginx, ecc.)

## Tecnologie utilizzate
- PHP
- SQLite   
- Bootstrap 5
- Font Awesome
- PHP Sessions
- PHP PDO   

## Installazione


1. Clona o scarica il repository
2. Posiziona i file nella directory del tuo server web
3. Esegui `composer install` per installare le dipendenze
4. Esegui `php init_database.php` per inizializzare il database
5. Accedi all'area amministrativa usando:
   - Username: admin
   - Password: admin123

## Struttura del progetto

```
simple-cms/
├── index.php              # Punto di ingresso dell'applicazione
├── src/                   # Codice sorgente dell'applicazione
│   ├── Controllers/       # Controller dell'applicazione
│   ├── views/             # Template e viste
│   ├── assets/            # Asset CSS e JS
│   └── Database.php       # Classe per la connessione al database
├── uploads/               # Directory per il caricamento delle immagini
└── vendor/                # Dipendenze (generate da Composer)
```

## Utilizzo

### Frontend

Visita la home page per vedere gli articoli pubblicati. Puoi navigare attraverso le categorie o visualizzare i singoli articoli.

### Backend

1. Accedi all'area amministrativa tramite `/login`
2. Dalla dashboard puoi:
   - Gestire gli articoli (creare, modificare, eliminare)
   - Gestire le categorie
   - Caricare immagini per gli articoli

## Licenza

Questo progetto è rilasciato sotto la licenza [Creative Commons Attribution 4.0 International License](http://creativecommons.org/licenses/by/4.0/).

### Attribuzione

Se utilizzi questo software, sei tenuto a dare credito all'autore originale. Un esempio di attribuzione potrebbe essere:

```
Basato su Simple CMS, sviluppato da [Il tuo nome/organizzazione]
```

o semplicemente includere un link a questo repository.
