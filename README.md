# BT ParkShare

A website to facilitate residents sharing parking spots for guests at Bellevue Towers Condominium.

Residents can offer their available parking spaces to fellow residents who need guest parking, making it easy to coordinate and share this limited resource within the community.

## Features

- **Account Registration** — Residents register with name, email, unit, parking spot, and phone. Accounts require admin approval.
- **Share Your Spot** — Specify date/time windows when your parking spot is available for others.
- **Find a Spot** — Search for available spots by date/time range and reserve one instantly.
- **Smart Time Splitting** — If a shared spot covers more time than requested, the remainder stays available for others.
- **Email Notifications** — Confirmations sent to both parties on booking; expiry reminders sent to borrowers.
- **Admin Panel** — Manage users, view all donations/bookings, perform CRUD operations.
- **Secure** — Password hashing, CSRF protection, prepared statements, session security.

## Tech Stack

- **PHP 8+** with SQLite (no external database server needed)
- **Bootstrap 5** for responsive UI
- Designed for **GoDaddy Plesk** Linux hosting

## Installation

1. Upload all files to your Plesk document root (e.g., `httpdocs/`)
2. Edit `config.php` — set your domain, admin email, and cron token
3. Visit `https://yourdomain.com/install.php` to initialize the database
4. Log in with the default admin credentials shown, then **change the password**
5. Delete or rename `install.php`
6. Set up a cron job in Plesk (every 15 minutes):

   ```bash
   php /var/www/vhosts/yourdomain/httpdocs/cron.php YOUR_CRON_TOKEN
   ```

## License

This work is licensed under the [Creative Commons Attribution 4.0 International License (CC BY 4.0)](https://creativecommons.org/licenses/by/4.0/).

You are free to share and adapt this material for any purpose, including commercially, as long as you give appropriate attribution.
