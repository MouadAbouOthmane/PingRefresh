# Ping Script with Expiration and Periodic Client Requests

This project is a simple server-side PHP script that pings multiple IP addresses, saves the results to a file, and serves the results to a client-side JavaScript that requests updated results every 10 seconds. The script ensures that ping results are refreshed if they are older than a specified expiration time.

## Features

- Pings multiple IP addresses using PHP.
- Saves ping results to a file with a timestamp.
- Automatically refreshes ping results when they are expired.
- Client-side JavaScript fetches the latest ping results every 10 seconds using AJAX.
- Displays ping results dynamically in the browser without page refresh.

## Technologies Used

- PHP
- JavaScript (with `fetch()` for AJAX)
- HTML
- JSON

## Installation

### Prerequisites

- A server with PHP installed (e.g., Apache, Nginx, etc.).
- Make sure the server has access to the `ping` command.
- Optionally, a browser to display the results dynamically.

### Steps to Install and Run

1. **Clone the repository:**
   ```bash
   git clone https://github.com/MouadAbouOthmane/PingRefresh.git
   cd ping-script
