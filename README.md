#  🎉 EventSphere 

## 📌 Project Overview  
EventSphere is a full-featured **Event Management System** built using **PHP (MVC Architecture)**, MySQL, HTML, CSS, and JavaScript.  
It allows **Admins** to manage events, users, and payments, while **Customers** can register, book events, make payments, and track their bookings.

---

## 🚀 Features  

### 🔑 User Features  
- User Signup & Login  
- View available events  
- Register for events  
- Manage personal profile  
- After Booking Confirm he can pay
- 
### 👨‍💼 Admin Features  
- Admin Login & Logout  
- Add, Update, Delete Admins
-  Add, Update, Delete Users 
- Manage Events (Add, Edit, Delete events)  
- View Confirm Payment  

---

## 🛠️ Technologies Used  
- **Frontend:** HTML5, CSS3, JavaScript  
- **Backend:** PHP (MVC Pattern)  
- **Database:** MySQL  
- **Server:** XAMPP (Apache, MySQL, PHP)  


```
## 📂 Project Structure  

Event-Management-System/
│── config/
│   └── database.php
│
│── controllers/
│   ├── LoginController.php
│   ├── UserController.php
│   ├── admin_event_controller.php
│   ├── admin_manage_booking.php
│   ├── admin_payment_controller.php
│   └── admin_manage_users_controller.php
│   └── admin_manage_controller.php
│   └── BookingController.php
│   └── CustomerDashboardController.php
│   └── logout.php
│   └── paymentController.php
│   └── profileController.php
│   
│
│── views/
│   ├── view_login.php
│   ├── view_profile.php
│   ├── Customer_view.php (Dashboard)
│   ├── payment.php
│   ├── register_signup.php
│   ├── admin_manage_booking.php
│   ├── admin_manage_users.php
│   ├── admin_manage_payment.php
│   └── success.php
│   └── my_booking.php
│   └── event_booking.php
│   └── booking_form.php
│   └──admin_view_manage.php
│   └── Admin_view.php
│   └── admin_manage.php 
│     
│    
│       
│
│
│── README.md
|
|





```
 **Configuration**:

    - Database credentials in `config/database.php` default to:
        - Host: `localhost`
        - Username: `root`
        - Password: `` (empty)
        - Database: `event_management_system`


        
---

## ⚡ Installation & Setup  

1. **Clone the Repository**  
   ```bash
   git clone https://github.com/AfnanBinIslamNahin/Event-Management-System.git

2. **Move Project to XAMPP**

Copy the folder to C:\xampp\htdocs\Event-Management-System\

3. **Import Database**

    -Open phpMyAdmin

    -Create a new database (name event_management_system)

    -Import the SQL file (database.sql) from the project

4 **Configure Database Connection**

   -Open database.php (or your db config file)

   -Set your MySQL username, password, and database name


  ## 🛠️ Technologies Used  
![PHP](https://img.shields.io/badge/PHP-777BB4?style=for-the-badge&logo=php&logoColor=white)  
![MySQL](https://img.shields.io/badge/MySQL-005C84?style=for-the-badge&logo=mysql&logoColor=white)  
![HTML5](https://img.shields.io/badge/HTML5-E34F26?style=for-the-badge&logo=html5&logoColor=white)  
![CSS3](https://img.shields.io/badge/CSS3-1572B6?style=for-the-badge&logo=css3&logoColor=white)  
![JavaScript](https://img.shields.io/badge/JavaScript-F7DF1E?style=for-the-badge&logo=javascript&logoColor=black)  
![XAMPP](https://img.shields.io/badge/XAMPP-FB7A24?style=for-the-badge&logo=xampp&logoColor=white)  


## Contact

For more information, reach out to:

- **Email:** [ 22-49350-3@student.aiub.edu](mailto:22-49350-3@student.aiub.edu)
- **Email:** [nahin.islam.bd4@gmail.com](mailto:nahin.islam.bd4@gmail.com)

