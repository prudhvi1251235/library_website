
# 📚 Online College Library - Group L

**Group Name:** Group L  
**Project Title:** Online College Library  
**Deployed URL:** [Live on InfinityFree](http://grouplepizy.wuaze.com)  
**User_ID & Password:** GroupL  

---

## 👨‍🏫 Group Members & Contributions

| Name         | Student ID | Email                                       | Contribution |
|--------------|------------|---------------------------------------------|--------------|
| **Ajith Shaji** | 3156205    | ajith.shaji1@student.griffith.ie            | HTML layout for Home, Login, Contact, About pages; session setup and initial Documentation |
| **Prudhvi Raj** | 3163649    | prudhviraj.pola@student.griffith.ie         | Advanced CSS styling, UI redesign, search/filter bar, light/dark toggle |
| **Nagaraju**    | 3162836    | nagaraju.rekula@student.grifiith.ie         | Borrow/Unborrow PHP logic, book listing UI, student dashboard |
| **Ramya**       | 3155699    | ramya.tumati@student.griffith.ie            | Registration form (with role selector), admin dashboard, database setup and testing |

---

## 📝 Project Overview

The **Online College Library** is a web-based PHP and MySQL application that allows:

- Students to register/login
- View and borrow books
- Admins to manage books and view borrow records
- Role-based access (admin vs student)
- Clean UI with animations, search, dark/light toggle

---

## ✅ Features Implemented

### 🏠 Home Page
- Clean layout with navigation
- Login buttons for both Students and Admins
- About and Contact sections (styled using Flexbox)
- Background image and modern fonts

### 🔐 Login Page
- PHP-based login system
- Uses hashed passwords and sessions
- Role-specific dashboard redirect

### 📝 Registration Page
- Full name, email, password fields
- Dropdown to select role: Student or Admin
- Server-side validation and database integration

### 📋 Student Dashboard
- View available books with images
- Borrow button with a 4-book limit
- Unborrow feature with instant removal
- Search and filter books in real-time
- Dark/Light mode toggle
- Welcome message with logout

### 🛠 Admin Dashboard
- Add new books using a form
- View all books in a card layout
- Search/filter functionality
- View who borrowed what using a separate page
- Dark/light theme and logout

### 📖 Borrow Records (Admin-only)
- Shows student name, email, book title and borrow date
- Table-based clean UI
- Accessible only via admin dashboard

---

## ⚙️ Tech Stack

- **Frontend:** HTML, CSS, JavaScript  
- **Backend:** PHP (with sessions, security, validation)  
- **Database:** MySQL (hosted on InfinityFree)  
- **Deployment:** Fully hosted on [InfinityFree](https://infinityfree.net)

---

## 🧠 Server-side Features (As per SEWA Requirements)

- `$_SESSION` used for login and dashboard access  
- `$_POST` and `$_GET` used for form and action handling  
- Form validation and error handling done on server side  
- Full CRUD support for Admin (Create/Delete books)  
- Role-based permission implemented  
- Passwords are hashed using `password_hash()`  
- Borrow/Return system maintains database state

---

## 📌 Notes

- Responsive layout with animated cards
- Clean, readable code with inline comments
- No Netlify used — **entire project hosted on InfinityFree**
- Developed as per SEWA Assignment 3 server-side criteria

---
