# 🌟 Kraftoon Lab – Resin Products Shopping Website

Kraftoon Lab is an e‑commerce website where customers can explore and purchase beautiful resin products like keychains and custom art pieces.  
This project is built with *HTML, CSS, JavaScript (Frontend)* and *PHP, MySQL (Backend)* using XAMPP.

---

## 🚀 Features

✅ User authentication (Sign Up / Login)  
✅ Shopping cart with +, -, and remove buttons  
✅ Grand Total calculation with taxes  
✅ Checkout flow  
✅ Admin panel to manage products and users  
✅ Responsive design with a clean and simple theme matching resin art aesthetics  

---

## 🛠️ Tech Stack

*Frontend:*  
- HTML5  
- CSS3  
- JavaScript  

*Backend:*  
- PHP (with XAMPP server)  
- MySQL database  

---

## 📂 Project Structure
kraftoon_lab/ 
├── index.html 
├── login.php 
├── signup.php 
├── admin/ │
   ├── admin_dashboard.php │
   └── manage_products.php ├── assets/ │
   ├── css/ │
   ├── js/ │
   └── images/
   └── database/
   └── users.sql

---

## ⚙️ Setup Instructions

1. *Clone the repository:*
   ```bash
   git clone https://github.com/<your-username>/kraftoon_lab.git
   cd kraftoon_lab

2. Set up the database:

Open phpMyAdmin on XAMPP

Create a database (e.g., kraftoon_lab_db)

Import users.sql (and other .sql files if available)



3. Run the project:

Place the project folder in htdocs (XAMPP)

Start Apache and MySQL in XAMPP

Open in browser:

http://localhost/kraftoon_lab/





---

🔑 Admin Access

To access the admin panel:

Manually set your user role to admin in the database:


UPDATE users SET role='admin' WHERE email='youremail@example.com';

Login with that account.



---

🤝 Contributing

Contributions are welcome!
If you’d like to improve styling, add features, or fix bugs:

1. Fork this repository


2. Create a new branch (git checkout -b feature-name)


3. Commit your changes (git commit -m 'Added new feature')


4. Push to your branch (git push origin feature-name)


5. Open a Pull Request 🎉




---

📧 Contact

Project by: Divya Sharma
📍 Chandigarh, India
📧 div72ya@gmail.com
📱 +91‑9816559002


---

✨ Thank you for checking out Kraftoon Lab! If you like this project, give it a ⭐ on GitHub! ✨