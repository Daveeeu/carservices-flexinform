# README.md

## Projekt Leírása

Ez a projekt egy Laravel 11 alapú alkalmazás, amely Docker konténerben fut. Az alkalmazás a Vite 6.0.11-et használja az assetek kezelésére, és Node.js 23.6.0-val, valamint npm 10.9.2-vel kompatibilis. Az adatbázis MySQL-t vagy MariaDB-t használ, és a frontend JavaScript-et (Vue.js) alkalmaz.

---

## Használt Verziók

- **PHP**: 8.2.x
- **Laravel**: 11.x
- **Node.js**: 23.6.0
- **npm**: 10.9.2
- **Vite**: ^6.0.11
- **Docker**: Legfrissebb verzió (Docker Compose támogatással)
- **MySQL/MariaDB**: 10.x

---

## Telepítési Útmutató

### 1. Projekt Klónozása
Klónozd a projektet
```bash
git clone https://github.com/Daveeeu/carservices-flexinform
cd carservices-flexinform
```

### 2. Docker Konténerek Indítása
A projekt Docker alapú, ezért szükséges a Docker Compose használata:
1. Győződj meg róla, hogy a Docker és a Docker Compose telepítve van.
2. Indítsd el a konténereket:
   ```bash
   docker-compose up --build -d
   ```

### 3. Adatbázis Migrációk
Hozd létre az adatbázis táblákat:
```bash
docker exec laravel_app php artisan migrate
```

### 4. Alkalmazás Indítása
Az alkalmazás elérhető lesz az alábbi címen:
```
http://localhost:8080
```

---

## Használati Útmutató

1. **Ügyfelek Listázása**: Az alkalmazás főoldalán megjelennek az ügyfelek adatai.
2. **Ügyfél Autói**: Kattints egy ügyfél nevére, hogy megjelenjenek az autói.
3. **Szerviznapló Megtekintése**: Kattints egy autó sorszámára, hogy megjelenjen annak szerviznaplója.
4. **Kereső Funkció**: Az oldal tetején található kereső segítségével ügyfeleket kereshetsz név vagy okmányazonosító alapján.
