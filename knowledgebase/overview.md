# Project Overview

This is a TALL stack demo app that simulates an event reminder system. It is used as a live demo — typically embedded in or linked from a Beehiiv newsletter.

## What it does

The app shows a single fake event post page. A visitor can click "Remind me", enter their email address, and choose to be reminded 15, 30, or 60 minutes before the event starts. The app stores the reminder and a background scheduler sends the email via Mailgun at the right time.

## Demo flow

1. Visitor lands on the event page showing a post title, body, and countdown to the event.
2. Visitor clicks "Remind me" — a modal opens (Livewire + Alpine.js).
3. Visitor enters email and selects reminder timing (15 / 30 / 60 mins before).
4. On submit, reminder is saved to the database. Duplicate guard prevents the same email from registering twice for the same event.
5. A scheduler runs every minute, finds due reminders, sends emails via Mailgun, and marks them as sent.
6. The demo clock can be rewound via `/demo/reset?minutes=X` to simulate the event happening soon.

## Purpose

Live demo of the TALL stack for presentations and newsletters. Single post, single event, minimal UI.
