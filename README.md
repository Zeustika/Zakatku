# Zakatku - Web-Based Zakat Management System

**Zakatku** is a simple and efficient web application for managing zakat collection and distribution. Built using **PHP** and **MySQL**, this project allows administrators to track zakat payments, manage mustahik (recipients), and record transactions with ease.

---

## Key Features

* **Zakat Payment Records**: Easily log and manage zakat transactions.
* **Mustahik Data Management**: Add, update, or delete data of zakat recipients.
* **Transaction Reports**: View summaries and histories of zakat distribution.
* **Real-Time Date Filtering**: Filter transactions based on date ranges.

---

## Tech Stack

* **Backend**: PHP (Native)
* **Database**: MySQL
* **Frontend**: HTML5, CSS3, JavaScript
* **Libraries**: Bootstrap (for responsive UI), jQuery (for interactivity)

---

## How to Run Locally

### Prerequisites

* A web server (e.g., XAMPP, WAMP, Laragon)
* PHP 7.x or higher
* MySQL/MariaDB

### Setup Instructions

1. **Clone the Repository**:

   ```bash
   git clone https://github.com/Zeustika/Zakatku.git
   cd zakatku
   ```

2. **Move Project to Web Directory**:
   Place the project folder in your `htdocs` (XAMPP) or `www` (WAMP) directory.

3. **Create Database**:

   * Open `phpMyAdmin`.
   * Create a new database named `zakatku`.
   * Import the SQL file from `/db/zakatku.sql`.

4. **Configure Database Connection**:

   * Open the `koneksi.php` file.
   * Set your MySQL username, password, and database name.

5. **Start the Server**:

   * Run Apache and MySQL from your server control panel.
   * Visit the app in your browser at `http://localhost/zakatku`.

---

## Default Login

* **Username**: `iyus`
* **Password**: `12345`

*(You can change this in the database after first login.)*

---

## Optional Screenshots

> ![image](https://github.com/user-attachments/assets/2c940c6d-8acf-46ba-86ed-ffbcb70989f5)

> ![image](https://github.com/user-attachments/assets/093e567f-eeeb-42ae-8b85-1dd8cce5e293)

> ![image](https://github.com/user-attachments/assets/330304ff-6d81-4c8c-8e77-a571d816003d)
