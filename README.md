## Hero Slider CMS

This project now includes a dynamic Home page hero managed via Dashboard > Hero Slides.

1. Log in to the dashboard and go to Hero Slides to add slides.
2. Upload a background image and set overlay, title/subtitle styles, and buttons.

Note: Ensure the storage symlink exists so uploaded images are accessible:

```
php artisan storage:link
```

# Hope Foundation - Non-Profit Organization Website

A beautiful, responsive website built with Laravel for non-profit organizations. Features modern design, donation system, volunteer management, events, blog, and contact functionality.

## 🌟 Features

- **Modern Design**: Beautiful, responsive design with awesome animations and effects
- **Donation System**: Secure donation forms with impact tracking
- **Volunteer Management**: Comprehensive volunteer application system
- **Event Management**: Event listings with registration capabilities
- **Blog System**: Share stories, news, and updates
- **Contact System**: Contact form with inquiry management
- **Mobile Responsive**: Optimized for all devices
- **SEO Optimized**: Search engine friendly structure

## 🚀 Quick Start for cPanel Hosting

### Prerequisites
- cPanel hosting account with PHP 8.1+
- MySQL database
- Composer (if available on hosting)

### Installation Steps

#### 1. Upload Files
1. Download/extract all project files
2. Upload the entire `nonprofit-website` folder to your hosting account
3. Move contents of `public` folder to your domain's public folder (usually `public_html`)
4. Keep the rest of the Laravel application files outside the public folder for security

#### 2. Database Setup
1. Create a new MySQL database in cPanel
2. Import the database structure using these tables:

```sql
-- Events table
CREATE TABLE events (
    id bigint(20) unsigned NOT NULL AUTO_INCREMENT,
    title varchar(255) NOT NULL,
    description text NOT NULL,
    date date NOT NULL,
    time time NOT NULL,
    location varchar(255) NOT NULL,
    image varchar(255) DEFAULT NULL,
    max_participants int DEFAULT NULL,
    registration_required tinyint(1) NOT NULL DEFAULT '0',
    created_at timestamp NULL DEFAULT NULL,
    updated_at timestamp NULL DEFAULT NULL,
    PRIMARY KEY (id)
);

-- Blog Posts table
CREATE TABLE blog_posts (
    id bigint(20) unsigned NOT NULL AUTO_INCREMENT,
    title varchar(255) NOT NULL,
    content text NOT NULL,
    excerpt text NOT NULL,
    image varchar(255) DEFAULT NULL,
    author varchar(255) NOT NULL,
    published_at timestamp NULL DEFAULT NULL,
    created_at timestamp NULL DEFAULT NULL,
    updated_at timestamp NULL DEFAULT NULL,
    PRIMARY KEY (id)
);

-- Donations table
CREATE TABLE donations (
    id bigint(20) unsigned NOT NULL AUTO_INCREMENT,
    donor_name varchar(255) NOT NULL,
    donor_email varchar(255) NOT NULL,
    donor_phone varchar(20) DEFAULT NULL,
    amount decimal(10,2) NOT NULL,
    donation_type enum('one-time','monthly') NOT NULL,
    message text DEFAULT NULL,
    status enum('pending','completed','failed') NOT NULL DEFAULT 'pending',
    created_at timestamp NULL DEFAULT NULL,
    updated_at timestamp NULL DEFAULT NULL,
    PRIMARY KEY (id)
);

-- Contacts table
CREATE TABLE contacts (
    id bigint(20) unsigned NOT NULL AUTO_INCREMENT,
    name varchar(255) NOT NULL,
    email varchar(255) NOT NULL,
    subject varchar(255) NOT NULL,
    message text NOT NULL,
    status enum('new','read','replied') NOT NULL DEFAULT 'new',
    created_at timestamp NULL DEFAULT NULL,
    updated_at timestamp NULL DEFAULT NULL,
    PRIMARY KEY (id)
);
```

#### 3. Configuration
1. Copy `.env.example` to `.env`
2. Update database configuration in `.env`:
```env
DB_CONNECTION=mysql
DB_HOST=localhost
DB_PORT=3306
DB_DATABASE=your_database_name
DB_USERNAME=your_database_username
DB_PASSWORD=your_database_password
```

3. Update app configuration:
```env
APP_NAME="Your Organization Name"
APP_URL=https://yourdomain.com
APP_ENV=production
APP_DEBUG=false
```

#### 4. File Permissions
Set the following permissions:
- `storage/` folder: 755
- `bootstrap/cache/` folder: 755
- All files: 644
- All folders: 755

#### 5. Generate Application Key
Run this command or add manually to `.env`:
```bash
php artisan key:generate
```

If you can't run artisan commands, generate a random 32-character string and add to `.env`:
```env
APP_KEY=base64:YourGeneratedKeyHere
```

## 📁 Directory Structure

```
nonprofit-website/
├── app/
│   ├── Http/Controllers/
│   └── Models/
├── database/
│   ├── migrations/
│   └── seeders/
├── public/
│   ├── css/
│   ├── js/
│   ├── images/
│   └── index.php
├── resources/views/
├── routes/
└── .env
```

## 🎨 Customization

### Updating Content
1. **Organization Name**: Update in `.env` file and `resources/views/layouts/app.blade.php`
2. **Colors**: Modify CSS variables in `resources/views/layouts/app.blade.php`
3. **Logo**: Replace logo references in navigation
4. **Contact Information**: Update in footer and contact page

### Adding Sample Data
Run the database seeder to add sample events, blog posts, and donations:
```bash
php artisan db:seed
```

### Color Scheme
The website uses these main colors:
- Primary: #2c3e50 (Dark Blue)
- Secondary: #e74c3c (Red)
- Accent: #f39c12 (Orange)
- Success: #27ae60 (Green)

## 📱 Responsive Design

The website is fully responsive and optimized for:
- Desktop (1200px+)
- Tablet (768px-1199px)
- Mobile (up to 767px)

## 🔧 Technical Features

- **Laravel Framework**: Robust PHP framework
- **Bootstrap 5**: Modern CSS framework
- **Font Awesome**: Icon library
- **AOS (Animate On Scroll)**: Smooth animations
- **Google Fonts**: Custom typography
- **MySQL Database**: Reliable data storage

## 🛡️ Security

- CSRF protection on all forms
- Input validation and sanitization
- Environment variable configuration
- SQL injection protection
- XSS protection

## 📧 Email Configuration

For contact forms and notifications, configure email in `.env`:
```env
MAIL_MAILER=smtp
MAIL_HOST=your-smtp-host
MAIL_PORT=587
MAIL_USERNAME=your-email@domain.com
MAIL_PASSWORD=your-email-password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=your-email@domain.com
MAIL_FROM_NAME="${APP_NAME}"
```

## 🚀 Performance Optimization

### For Production:
1. Enable caching:
```bash
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

2. Optimize images in `public/images/`
3. Enable Gzip compression in cPanel
4. Use a CDN for static assets

## 🆘 Troubleshooting

### Common Issues:

1. **500 Internal Server Error**
   - Check file permissions
   - Verify `.env` configuration
   - Check error logs in cPanel

2. **Database Connection Error**
   - Verify database credentials
   - Ensure database exists
   - Check database server status

3. **CSS/JS Not Loading**
   - Check file paths in views
   - Verify files uploaded correctly
   - Clear browser cache

4. **Forms Not Working**
   - Check CSRF token
   - Verify form action URLs
   - Check server error logs

## 📄 License

This project is open-source and available under the MIT License.

## 🤝 Contributing

1. Fork the repository
2. Create your feature branch
3. Commit your changes
4. Push to the branch
5. Create a Pull Request

## 📞 Support

For support and customization services, contact:
- Email: support@yourorganization.org
- Website: https://yourorganization.org

---

**Made with ❤️ for making the world a better place**
