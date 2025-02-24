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
Klónozd a projektet:
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
3. Adatbázis Migrációk (Docker esetén)
Hozd létre az adatbázis táblákat:
    ```bash
    docker exec laravel_app php artisan migrate
    ```
4. Alkalmazás Indítása (Docker esetén)
Az alkalmazás elérhető lesz az alábbi címen:
    ```
    http://localhost:8080
    ```

### 3. Alternatíva Docker Nélkül

Ha nem szeretnél Dockert használni, kövesd az alábbi lépéseket:

1. **Környezeti változók beállítása**
   Másold az `.env.example` fájlt `.env` néven, majd konfiguráld az adatbázis kapcsolatot és egyéb beállításokat:
   ```bash
   cp .env.example .env
   ```

2. **Composer függőségek telepítése**
   Győződj meg róla, hogy a Composer telepítve van, majd futtasd:
   ```bash
   composer install
   ```

3. **Node.js függőségek telepítése**
   Telepítsd az npm csomagokat:
   ```bash
   npm install
   ```

4. **Assetek buildelése**
   Futtasd a Vite build parancsot:
   ```bash
   npm run build
   ```

5. **Adatbázis migrációk**
   Hozd létre az adatbázis táblákat:
   ```bash
   php artisan migrate
   ```

6. **Fejlesztői szerver indítása**
   Indítsd el a Laravel beépített szerverét:
   ```bash
   php artisan serve
   ```
   Az alkalmazás alapértelmezés szerint elérhető lesz itt:
   ```
   http://127.0.0.1:8000
   ```


---

## Használati Útmutató

1. **Ügyfelek Listázása**: Az alkalmazás főoldalán megjelennek az ügyfelek adatai.
2. **Ügyfél Autói**: Kattints egy ügyfél nevére, hogy megjelenjenek az autói.
3. **Szerviznapló Megtekintése**: Kattints egy autó sorszámára, hogy megjelenjen annak szerviznaplója.
4. **Kereső Funkció**: Az oldal tetején található kereső segítségével ügyfeleket kereshetsz név vagy okmányazonosító alapján
