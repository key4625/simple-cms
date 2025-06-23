# Aggiornamento alla nuova versione con supporto percorsi personalizzati

## Passaggi per l'aggiornamento

Dopo aver aggiornato i file, è necessario rigenerare l'autoloader di Composer per rendere disponibili le nuove funzioni helper:

```bash
# Da eseguire nella directory principale del progetto
composer dump-autoload
```

## Configurazione del base_url

Per configurare il CMS affinché funzioni in una sottocartella:

1. Aprire il file `src/config.php`
2. Modificare il valore di `base_url` inserendo il percorso della sottocartella:

```php
// Per esempio, se il CMS è in http://tuosito.com/simple-cms
'base_url' => '/simple-cms',
```

3. Se il CMS è installato nella root del dominio, lasciare vuoto il valore:

```php
'base_url' => '',
```

## Utilizzo nelle viste

Le viste sono state aggiornate per utilizzare il base_url nei collegamenti. Utilizzare sempre il base_url nei template personalizzati:

```php
<!-- Link corretti con base_url -->
<a href="<?= $base_url ?>/">Home</a>
<a href="<?= $base_url ?>/articoli">Articoli</a>

<!-- Per file CSS, JavaScript e altri asset -->
<link href="<?= $base_url ?>/src/assets/css/style.css" rel="stylesheet">
```

## Funzioni helper disponibili

Le seguenti funzioni sono ora disponibili in tutto il progetto:

- `base_url($path)`: Restituisce il percorso base con il path aggiunto
- `url($path)`: Restituisce l'URL completo (con protocollo e host)
- `redirect($path)`: Reindirizza a un percorso relativo al base_url
