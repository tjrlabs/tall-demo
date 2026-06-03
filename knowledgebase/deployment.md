# Deployment

## Production: Railway

The app is deployed on Railway at `https://tall-demo-production.up.railway.app`.

Two Railway services inside the project:
- **tall-demo** — the Laravel app (PHP-FPM + Nginx, built from Dockerfile)
- **Postgres** (named "fabulous-flow" in the project) — managed PostgreSQL database

## How the Docker build works

Multi-stage Dockerfile:
1. **assets stage** (node:22-alpine) — runs `npm ci` and `npm run build`, outputs `public/build/`
2. **app stage** (php:8.3-fpm-alpine) — installs PHP extensions (pdo_pgsql, opcache), installs composer deps, copies app + built assets, sets storage permissions

The `start.sh` script runs on container start and:
1. Writes the nginx config with the correct PORT (Railway injects $PORT)
2. Retries `php artisan migrate --force` up to 15 times (waits for DB to be ready)
3. Runs `php artisan db:seed --force` to ensure demo data exists
4. Caches config, routes, and views
5. Starts the scheduler loop in the background (`while true; do php artisan schedule:run; sleep 60; done`)
6. Starts PHP-FPM as a daemon
7. Starts Nginx in the foreground (keeps the container alive)

## Required Railway environment variables (tall-demo service)

```
APP_ENV=production
APP_DEBUG=false
APP_KEY=base64:...          # generate with: php artisan key:generate --show
APP_URL=https://tall-demo-production.up.railway.app
LOG_CHANNEL=stderr

DB_CONNECTION=pgsql
DB_HOST=nozomi.proxy.rlwy.net
DB_PORT=38158
DB_DATABASE=railway
DB_USERNAME=postgres
DB_PASSWORD=...             # from Postgres service variables

MAIL_MAILER=mailgun
MAILGUN_DOMAIN=sandboxa67bcb3fc0fc436e99e61f157b599985.mailgun.org
MAILGUN_SECRET=...
MAIL_FROM_ADDRESS=thejairaghav@gmail.com
MAILGUN_ENDPOINT=api.mailgun.net

GEMINI_API_KEY=...              # Gemini API key for event date extraction (free tier, gemini-2.0-flash)
```

## Key production config decisions

- **Trusted proxies**: `$middleware->trustProxies(at: '*')` in `bootstrap/app.php` — required because Railway terminates HTTPS at its load balancer and forwards HTTP to the container. Without this, Laravel generates http:// asset URLs which browsers block as mixed content.
- **CORS**: `config/cors.php` allows `*.beehiiv.com` origins so the app can be fetched from Beehiiv newsletter pages.
- **Nginx port**: Nginx listens on `$PORT` (injected by Railway). The Railway service networking must be configured to route to the same port (8080 by default).
- **Scheduler**: Runs inside the same container as the web server (no separate worker service). Acceptable for a demo.

## Local development

Uses Laravel Sail via Docker Compose directly (not the `sail` CLI — incompatible with Windows without Ubuntu WSL2):

```powershell
docker compose -f z:\TJR\Projects\tall-demo\compose.yaml up -d
```

Local services: `laravel.test` (PHP app), `scheduler` (artisan schedule loop), `pgsql` (PostgreSQL), `pgadmin` (DB GUI at http://127.0.0.1:5050).

Local app runs at `http://127.0.0.1` (not localhost — Docker networking quirk on Windows).
