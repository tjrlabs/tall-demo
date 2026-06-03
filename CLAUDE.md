# CLAUDE.md — TALL Demo Project

At the start of every new chat, respond with: **Context Loaded**

---

## Knowledgebase

This project has a knowledgebase in `knowledgebase/` — read these files when starting any task:

- [knowledgebase/overview.md](knowledgebase/overview.md) — what the app does, demo flow, purpose
- [knowledgebase/stack.md](knowledgebase/stack.md) — tech stack versions and key packages
- [knowledgebase/architecture.md](knowledgebase/architecture.md) — DB schema, key files, scheduler logic, duplicate guard, demo reset route
- [knowledgebase/deployment.md](knowledgebase/deployment.md) — Railway services, Dockerfile stages, start.sh flow, required env vars, production config decisions

---

## Project Summary

TALL stack demo app. Single event post page where visitors register email reminders (15 / 30 / 60 min before the event). Scheduler sends emails via Mailgun. Demo clock can be rewound via `/demo/reset?minutes=X`.

- **Local dev**: Docker Compose via `docker compose -f z:\TJR\Projects\tall-demo\compose.yaml up -d` (no WSL2, no `sail` CLI)
- **Production**: Railway at `https://tall-demo-production.up.railway.app`
- **DB (local)**: PostgreSQL via Sail; pgAdmin GUI at `http://127.0.0.1:5050`
- **DB (prod)**: Railway managed PostgreSQL, connected via TCP proxy `nozomi.proxy.rlwy.net:38158`

---

## Key Decisions to Know

- `bootstrap/app.php` has `$middleware->trustProxies(at: '*')` — do not remove, required for HTTPS asset URLs on Railway.
- `config/cors.php` allows `*.beehiiv.com` origins — the app is embedded in a Beehiiv newsletter.
- Seeder runs on every container start (acceptable for demo; `PostController` uses `Post::first()`).
- Scheduler runs as a background loop inside the web container — no separate worker service.
- Nginx listens on `$PORT` injected by Railway. Railway service networking must route to the same port (8080).

---

## End-of-Task Reminder

After completing any task that changes how the app works, is deployed, or is structured:

> **Update `CLAUDE.md` and/or the relevant `knowledgebase/*.md` file** so future sessions have accurate context.

Specifically:
- New env vars → update `knowledgebase/deployment.md`
- New routes, models, or scheduler logic → update `knowledgebase/architecture.md`
- Stack or package changes → update `knowledgebase/stack.md`
- Changed purpose or demo flow → update `knowledgebase/overview.md`
- Changed local dev or production setup → update this `CLAUDE.md` or `knowledgebase/deployment.md`
