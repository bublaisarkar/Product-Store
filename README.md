# 🛒 Product Store - PHP & MySQL CRUD Application

A fully functional, responsive product management system built with **PHP** and **MySQL**. This project demonstrates core backend capabilities, including database administration, server-side form handling, and file system management.

## 🚀 Live Demo
https://cogzin-product-store.great-site.net/

## ✨ Key Features
* **Full CRUD Logic:** Create, Read, Update, and Delete products seamlessly.
* **Image Upload System:** Handles physical file uploads with unique naming conventions to prevent overwriting.
* **Database Admin:** Optimized MySQL schema managed via phpMyAdmin.
* **Dynamic UI:** Built with Bootstrap 5 featuring modals, alerts, and responsive tables.
* **Security:** Implemented data sanitization and SQL injection prevention.
* **Clean Cleanup:** Automatically deletes image files from the server when a product is removed.

## 🛠️ Tech Stack
* **Frontend:** HTML5, CSS3, JavaScript, Bootstrap 5
* **Backend:** PHP (Procedural)
* **Database:** MySQL
* **Tools:** phpMyAdmin, XAMPP, Git

## 📸 Screenshots
<img width="1314" height="629" alt="image" src="https://github.com/user-attachments/assets/fe212865-0df5-400b-9d5d-cecf57137ff8" />

## 📂 Project Structure
```text
├── uploads/          # Physical storage for product images
├── connection.php    # Database configuration & global paths
├── crud.php          # Backend logic (INSERT, UPDATE, DELETE)
├── index.php         # Main dashboard & Product listing
├── edit.php          # Product modification form
└── favicon.ico       # Brand icon

⚙️ Installation & Setup
Clone the repository:

git clone https://github.com/bublaisarkar/Product-Store.git

Database Setup:

Open phpMyAdmin and create a database named product_db.

Import the provided SQL structure.

Configure Connection:

Update connection.php with your local or live credentials.

Run:

Move the folder to htdocs (XAMPP) and visit localhost/product-store.

👤 Author
Bublai Sarkar

Junior Web Developer

LinkedIn : https://www.linkedin.com/in/bublai-sarkar/
