# EverAfter Events — WordPress Theme Install Guide

Theme folder: `wp-theme/everafter/`

## What the theme includes

| File | Purpose |
| --- | --- |
| `style.css` | WordPress theme header + the site's styles (same design system as the static demo) |
| `functions.php` | Theme support (title tag, thumbnails, custom logo, HTML5), registers the `primary` and `footer` nav menus, registers the private `everafter_enquiry` custom post type, enqueues Bootstrap 5 + Google Fonts + the theme stylesheet |
| `header.php` / `footer.php` | Shared site header (Bootstrap nav using `wp_nav_menu`) and footer |
| `index.php` | Fallback template (blog/archive loop) |
| `front-page.php` | Home page template (hero, how-we-work, studio, featured gallery) |
| `page-packages.php` | Packages page template — package content is edited as **page content** in the editor |
| `page-enquiry.php` | Enquiry page template — validates the form, emails it via `wp_mail()` to the site admin, and saves a copy as a private `everafter_enquiry` post (visible under **Enquiries** in wp-admin) |

## Packages: page content (chosen approach)

Packages are edited as ordinary page content on the Packages page rather than a custom post type. This keeps editing simple for a site owner: add/edit package blocks directly in the block editor. The template renders the page content inside the styled layout. (A CPT would add admin overhead with no benefit for a fixed set of three packages.)

## Install on any WordPress host

1. **Upload the theme:** zip the `everafter` folder (or upload via SFTP) to `wp-content/themes/everafter/`.
2. **Activate:** in wp-admin go to **Appearance → Themes** and activate **EverAfter Events**.
3. **Create the pages:**
   - **Home** — assign the "Home" template (`front-page.php`) or set it as the front page.
   - **Packages** — assign the "Packages" template (`page-packages.php`) and add the package content in the editor.
   - **Enquiry** — assign the "Enquiry" template (`page-enquiry.php`).
   - Optionally a **Gallery** page using the default template with a gallery block.
4. **Set the front page:** **Settings → Reading → Your homepage displays → A static page**, homepage = Home.
5. **Set menus:** **Appearance → Menus** — create a menu (Home, Packages, Gallery, Enquiry) and assign it to the **Primary** location; optionally a second menu for the **Footer** location.
6. **Enquiries:** form submissions are emailed to the admin email (`get_option('admin_email')`) and listed under **Enquiries** in wp-admin. Make sure the host can send mail (or install an SMTP plugin such as WP Mail SMTP).
7. **Customiser:** a custom logo can be set under **Appearance → Customize → Site Identity**.

## Requirements

- WordPress 6.0+, PHP 7.4+ (PHP 8.x recommended)
- No plugins required. Bootstrap 5 and Google Fonts are loaded from CDNs by `functions.php`; the site needs internet access for those, or they can be self-hosted.
