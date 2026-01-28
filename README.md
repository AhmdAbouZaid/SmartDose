# 💊 SmartDose
**Smart Pill Dispenser E-Commerce Platform**

A comprehensive e-commerce platform for medical products and smart pill dispensers built with Laravel 12 and modern web technologies.

---

## 📋 Table of Contents
- [About](#about)
- [Features](#features)
- [Technologies](#technologies)
- [Database Structure](#database-structure)
- [Installation](#installation)
- [Usage](#usage)
- [User Roles](#user-roles)
- [Screenshots](#screenshots)
- [Future Work](#future-work)
- [Contributing](#contributing)
- [License](#license)

---

## 🎯 About

SmartDose is a full-featured e-commerce platform designed to sell medical products and smart pill dispensers. The platform addresses critical healthcare challenges including medication non-adherence (affecting 50% of patients) and provides a modern solution for purchasing healthcare products online.

### Key Statistics Addressed:
- **125,000+** deaths annually from medication non-adherence
- **50%** of patients don't take medications as prescribed
- **$300B** in avoidable healthcare costs

---

## ✨ Features

### Authentication & Authorization
- User registration and login
- Email verification
- Password reset functionality
- Role-based access control (Admin/User)
- Profile management

### Product Management
- Browse medical products catalog
- Product search and filtering
- Detailed product information
- Stock tracking
- Admin product CRUD operations

### Order System
- Multi-item shopping cart
- Order creation and tracking
- Order history with filters
- Order cancellation (pending orders)
- Delivery confirmation by users
- Real-time stock management

### Payment System
- Cash on Delivery (COD) fully implemented
- Automatic order completion
- Transaction tracking
- Payment status management

### Admin Dashboard
- View all customer orders
- Manage any order
- Cancel pending orders
- Customer information access
- Full system oversight

### User Experience
- Responsive mobile-first design
- User-friendly interface
- Simplified payment descriptions
- Clear status messages
- About Us page
- Contact form

---

## 🛠 Technologies

### Backend
- **Framework:** Laravel 12
- **Database:** MySQL
- **Authentication:** Laravel Breeze
- **ORM:** Eloquent

### Frontend
- **CSS Framework:** Tailwind CSS
- **JavaScript:** Alpine.js
- **Build Tool:** Vite
- **Fonts:** Poppins (Google Fonts)

### Design
- **Color Scheme:** Blue (#007bff) to Cyan (#00c4cc) gradient
- **Typography:** Poppins (400, 500, 600, 700)
- **Responsive:** Mobile-first approach

---

## 🗄️ Database Structure

### Main Tables

#### Users
```
- id
- name
- email
- password
- role (enum: 'user', 'admin')
- timestamps
```

#### Products
```
- id
- name
- description
- price (decimal)
- stock (integer)
- image
- timestamps
```

#### Orders
```
- id
- user_id (foreign key)
- total (decimal)
- status (enum: pending/completed/cancelled)
- delivered_at (timestamp)
- timestamps
```

#### Order Items
```
- id
- order_id (foreign key)
- product_id (foreign key)
- quantity
- price
- timestamps
```

#### Payments
```
- id
- order_id (foreign key)
- amount
- status (enum: pending/success/failed/refunded)
- transaction_id
- payment_gateway
- payment_method
- response_data (json)
- timestamps
```

---

## 🚀 Installation

### Prerequisites
- PHP >= 8.2
- Composer
- MySQL
- Node.js & NPM

### Steps

1. **Clone the repository**
```bash
git clone https://github.com/AhmdAbouZaid/SmartDose.git
cd SmartDose
```

2. **Install PHP dependencies**
```bash
composer install
```

3. **Install NPM dependencies**
```bash
npm install
```

4. **Environment setup**
```bash
cp .env.example .env
php artisan key:generate
```

5. **Configure database**
Edit `.env` file with your database credentials:
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=smartdose
DB_USERNAME=your_username
DB_PASSWORD=your_password
```

6. **Run migrations and seeders**
```bash
php artisan migrate
php artisan db:seed
```

7. **Create storage link**
```bash
php artisan storage:link
```

8. **Build assets**
```bash
npm run build
# Or for development
npm run dev
```

9. **Start the server**
```bash
php artisan serve
```

Visit: `http://localhost:8000`

---

## 📖 Usage

### Default Accounts

#### Admin Account
```
Email: admin@smartdose.com
Password: admin123
```

#### Test User Account
```
Email: user@smartdose.com
Password: user123
```

### Main Routes
- `/` - Homepage
- `/about` - About Us
- `/contact` - Contact Us
- `/dashboard` - User Dashboard
- `/products` - Product Catalog
- `/orders` - Order Management
- `/profile` - User Profile

---

## 👥 User Roles

### Admin Features
- View all orders from all customers
- Access customer information
- Manage any order
- Cancel any pending order
- Full CRUD operations on products
- View order and transaction IDs
- Access technical payment information

### User Features
- Browse and purchase products
- Create and track orders
- View personal order history
- Cancel own pending orders
- Confirm delivery receipt
- Update profile information
- Simplified order display

---

## 📸 Screenshots

### Homepage
![Homepage](screenshots/homepage.png)

### Product Catalog
![Products](screenshots/products.png)

### Order Management
![Orders](screenshots/orders.png)

### Admin Dashboard
![Admin](screenshots/admin.png)

---

## 🔮 Future Work

### Planned Features
- **Payment Gateway Integration**
  - PayPal integration
  - Stripe payment processing
  - Credit card payments
  
- **Enhanced Features**
  - AI-powered chatbot for customer support
  - Email notifications for order updates
  - SMS alerts for delivery status
  - Customer product reviews and ratings
  - Loyalty program and rewards
  - Advanced analytics dashboard
  - Real-time order tracking
  - Multi-language support
  - Wishlist functionality
  - Product recommendations

- **Admin Enhancements**
  - Sales reports and analytics
  - Inventory management tools
  - Customer relationship management
  - Automated email campaigns

---

## 🤝 Contributing

Contributions are welcome! Please feel free to submit a Pull Request.

1. Fork the project
2. Create your feature branch (`git checkout -b feature/AmazingFeature`)
3. Commit your changes (`git commit -m 'Add some AmazingFeature'`)
4. Push to the branch (`git push origin feature/AmazingFeature`)
5. Open a Pull Request

---

## 📝 License

This project is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

---

## 👨‍💻 Developer

**Made by Arywan**

---

## 📞 Contact

For any inquiries or support, please contact us through the [Contact Page](http://localhost:8000/contact).

---

## ⚙️ Additional Notes

- All routes are protected with authentication middleware
- Admin routes use policy-based authorization
- Database transactions ensure order data integrity
- Automatic stock management on order creation/cancellation
- Seeded database includes 15 medical products
- Fully responsive design for all devices

---

**© 2025 SmartDose - Smart Pill Dispenser E-Commerce Platform**
