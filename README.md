# EverAfter Events — Wedding & Event Planning (fictional)

A self-directed portfolio piece by **Khushi Khatri** (Glassboro, NJ). **EverAfter Events is a fictional wedding-planning studio — not a real business, not client work.** All copy, packages and prices are invented demo content; photography is placeholder imagery from picsum.photos.

## What it is

- A polished, responsive multi-page static site: home, packages & pricing, gallery, enquiry form.
- A custom WordPress theme (`wp-theme/everafter/`) that recreates the same site on WordPress, with real enquiry handling. See `README-WORDPRESS.md`.

## Stack

- HTML5, CSS3 (custom stylesheet), vanilla JavaScript
- Bootstrap 5 via CDN
- Google Fonts: Playfair Display + Jost
- Images: picsum.photos seeded URLs (placeholder only)

## Backend

- **Static demo:** none. The enquiry form runs in clearly labelled **demo mode** — submitting shows a demo confirmation with a demo reference number; nothing is sent or stored.
- **WordPress version:** the theme's enquiry page template (`page-enquiry.php`) uses `wp_mail()` to email enquiries to the site admin and saves a copy as a private custom post type entry (`everafter_enquiry`). Packages are edited as **page content** on the Packages page (chosen approach — simpler and easier for a site owner to edit than a CPT; see `README-WORDPRESS.md`).

## How to run locally

```bash
cd wedding-planner
python3 -m http.server 8000
# open http://localhost:8000
```

No build step, no dependencies to install. An internet connection is needed for the Bootstrap CDN, Google Fonts and placeholder images.

## Files

| File | Purpose |
| --- | --- |
| `index.html` | Home / hero |
| `packages.html` | Wedding packages + pricing |
| `gallery.html` | Event gallery |
| `enquiry.html` | Enquiry form (demo mode) |
| `css/style.css` | Shared theme styles |
| `js/main.js` | Scroll reveals + demo enquiry handling |
| `wp-theme/everafter/` | Custom WordPress theme |
| `README-WORDPRESS.md` | WordPress install & setup guide |
