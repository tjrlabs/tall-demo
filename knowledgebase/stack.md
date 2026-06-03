# Tech Stack

| Layer | Technology | Version |
|-------|-----------|---------|
| Backend framework | Laravel | 13.x |
| Reactive UI | Livewire | 3.x |
| Frontend interactivity | Alpine.js | 3.x (bundled with Livewire) |
| CSS | Tailwind CSS | 3.x |
| Database | PostgreSQL | 18 (local), Railway managed (prod) |
| Email | Mailgun (sandbox) | via symfony/mailgun-mailer |
| Asset bundler | Vite | via laravel-vite-plugin |
| PHP | PHP | 8.3 |
| Local dev | Laravel Sail (Docker Compose) | — |
| Production | Railway | Docker-based deployment |

## Key packages

- `livewire/livewire` — reactive components without writing JavaScript
- `symfony/mailgun-mailer` + `symfony/http-client` — Mailgun transport for Laravel mailer
- `laravel/breeze` — auth scaffolding (installed but auth not the focus of the demo)
