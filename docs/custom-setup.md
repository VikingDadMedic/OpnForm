
# Setting Up OpnForm for Local Development and Self-Hosting

Based on the documentation, I'll guide you through setting up OpnForm locally for development using Docker (the recommended approach) and then explain how to transition to self-hosting in production.

## Local Development Setup with Docker

Let's start with the Docker development environment, which provides hot-reload, debugging support, and pre-configured services.

### Prerequisites
- Docker and Docker Compose installed on your machine
- Git installed
- Basic understanding of Docker concepts

### Step 1: Clone the Repository
```bash
git clone https://github.com/JhumanJ/OpnForm.git
cd OpnForm
```

### Step 2: Run the Setup Script in Development Mode
```bash
chmod +x scripts/docker-setup.sh
./scripts/docker-setup.sh --dev
```

This script will:
- Create necessary environment files
- Pull or build required Docker images
- Start all containers in development mode
- Display access information

### Step 3: Access Your Development Environment
- Frontend: http://localhost:3000
- API: http://localhost/api

### Initial Login Credentials
- Email: `admin@opnform.com`
- Password: `password`

You'll be prompted to change these credentials after first login.

> **Note**: Public registration is disabled in the self-hosted version. Use the admin account to invite additional users.

## Development Environment Features

The Docker development setup includes:

- **Frontend Development**:
  - Hot Module Replacement (HMR) for instant updates
  - Vue DevTools integration
  - Source maps for debugging
  - Fast refresh that preserves component state
  - Error overlay in the browser

- **Backend Development**:
  - PHP hot reload
  - Xdebug integration
  - Direct access to Laravel's Artisan commands

### Common Development Tasks

Running commands in containers:
```bash
# Laravel Artisan commands
docker compose -f docker-compose.dev.yml exec api php artisan [command]

# NPM commands
docker compose -f docker-compose.dev.yml exec ui npm [command]

# Database commands
docker compose -f docker-compose.dev.yml exec db psql -U forge
```

Viewing logs:
```bash
# All containers
docker compose -f docker-compose.dev.yml logs -f

# Specific container (e.g., frontend)
docker compose -f docker-compose.dev.yml logs -f ui
```

## Moving to Production Self-Hosting

When you're ready to move to production, follow these steps for a Docker-based self-hosted deployment:

### Step 1: Clone the Repository (on Your Production Server)
```bash
git clone https://github.com/JhumanJ/OpnForm.git
cd OpnForm
```

### Step 2: Run the Production Setup Script
```bash
chmod +x scripts/docker-setup.sh
./scripts/docker-setup.sh
```

### Step 3: Access Your OpnForm Instance
Your instance will be available at `http://localhost` on the production server.

## Essential Configuration for Self-Hosting

After setting up your self-hosted instance, you'll want to configure these essential components:

### 1. File Storage (S3 or Local)
For S3 storage, configure:
- `AWS_ACCESS_KEY_ID`
- `AWS_SECRET_ACCESS_KEY`
- `AWS_DEFAULT_REGION`
- `AWS_BUCKET`

Don't forget to configure CORS for your S3 bucket.

### 2. Email Service
Set up email notifications by configuring these environment variables:
```
MAIL_MAILER=smtp
MAIL_HOST=your-smtp-server.com
MAIL_PORT=587
MAIL_USERNAME=your-username
MAIL_PASSWORD=your-password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=noreply@yourdomain.com
MAIL_FROM_NAME="Your Company Name"
```

### 3. Custom Domain
To use your own domain:
1. Configure DNS records to point to your server
2. Update the environment variables:
   - Set `APP_URL` in `api/.env`
   - Set `NUXT_PUBLIC_APP_URL` and `NUXT_PUBLIC_API_BASE` in `client/.env`
3. Set up SSL certificates for security

## Important Considerations for Self-Hosting

Referring to the cloud vs. self-hosting comparison, remember that with self-hosting you'll need to manage:

- Server availability and scaling
- Database management
- Backups and monitoring
- SSL certificates
- Manual upgrades and maintenance
- Support (mainly through Discord)

## Troubleshooting Common Issues

### Container Issues
```bash
# Clean everything and restart
./scripts/docker-setup.sh --dev  # For development
# or
./scripts/docker-setup.sh  # For production
```

### Permission Issues
```bash
# Fix storage permissions
docker compose -f docker-compose.dev.yml exec api chmod -R 775 storage
docker compose -f docker-compose.dev.yml exec api chmod -R 775 vendor
```

### Database Issues
```bash
# Check database status
docker compose exec db pg_isready

# View database logs
docker compose logs db
```

### Cache Issues
```bash
# Clear various caches
docker compose exec api php artisan cache:clear
docker compose exec api php artisan config:clear
docker compose exec api php artisan route:clear
```

## Updating Environment Variables

When changing environment variables in your `.env` files, you need to recreate the containers:

```bash
# For all services
docker compose down
docker compose up -d
```

> **Warning**: A simple `docker compose restart` will not reload environment variables. You must use `down` and `up` commands to recreate the containers.

Would you like more specific information about any part of this setup process?
