# NGO Website - Hope Foundation

A comprehensive non-profit organization website built with Laravel, featuring modern design and full content management capabilities.

## 🌟 Features

### Frontend
- **Modern Homepage** with hero slides, statistics counter, and impact areas
- **Projects Showcase** with ongoing and completed project categories
- **Team Management** with member profiles and roles
- **Notices** system for announcements
- **Contact Forms** with email notifications
- **Newsletter Subscription** with admin management
- **Responsive Design** optimized for all devices

### Admin Dashboard
- **Hero Slides Management** with drag-and-drop uploads
- **Statistics Management** with real-time counters
- **Team Members Management** with photo uploads
- **Partners Management** with logo displays
- **Content Management** with rich text editor
- **Media Library** for file management
- **Newsletter Subscribers** management and export
- **Contact Messages** inbox

## 🛠️ Tech Stack

- **Framework:** Laravel 10
- **Database:** MySQL
- **Frontend:** Bootstrap 5, AOS animations
- **File Storage:** Laravel Storage with public disk
- **Authentication:** Laravel built-in auth
- **Rich Text Editor:** Integrated WYSIWYG editor
- **Icons:** Font Awesome 6

## 📦 Installation

1. **Clone the repository**
   ```bash
   git clone https://github.com/anandkanishkZ/ngo.git
   cd ngo
   ```

2. **Install dependencies**
   ```bash
   composer install
   ```

3. **Environment setup**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

4. **Database configuration**
   - Update `.env` with your database credentials
   - Create database: `nonprofit_db`

5. **Run migrations**
   ```bash
   php artisan migrate --seed
   ```

6. **Storage setup**
   ```bash
   php artisan storage:link
   ```

7. **Start the server**
   ```bash
   php artisan serve
   ```

## 🔐 Default Login

- **Email:** admin@hope.org
- **Password:** password

## 🎯 Key Modules

### 1. Hero Slides
- Dynamic homepage banners
- Multiple animation options
- Background image uploads
- Call-to-action buttons

### 2. Statistics Counter
- Animated number counters
- Icon customization
- Order management
- Real-time updates

### 3. Team Management
- Member profiles with photos
- Role assignments
- Social media links
- Featured members

### 4. Projects
- Project categorization
- Progress tracking
- Image galleries
- Status management

### 5. Newsletter System
- Email collection
- Subscriber management
- Export functionality
- Unsubscribe handling

## 🎨 Design Features

- **Professional UI** with modern card-based layouts
- **Smooth Animations** using AOS library
- **Responsive Design** for mobile-first approach
- **Color Scheme** optimized for non-profit branding
- **Typography** carefully selected for readability

## 🔄 Recent Updates

- ✅ Complete donation system removal
- ✅ Hero slides form with WordPress-style UI
- ✅ Statistics counter individual animations
- ✅ Newsletter subscription system
- ✅ Admin dashboard enhancements
- ✅ Database optimizations

## 🚀 Deployment

The project is ready for production deployment on:
- Shared hosting (cPanel)
- VPS/Cloud servers
- Docker containers

## 📝 License

Open-source project for educational and non-profit use.

## 👥 Contributing

1. Fork the repository
2. Create a feature branch
3. Make your changes
4. Submit a pull request

## 📞 Support

For issues and questions, please create an issue on GitHub or contact the development team.

---

**Built with ❤️ for non-profit organizations making a difference in the world.**
