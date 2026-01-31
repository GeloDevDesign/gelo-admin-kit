#!/bin/bash

# --- CONFIGURATION ---
# CHANGE THE CORRECT DOMAIN
DOMAIN="test.domain.com"
# USER_NAME will be based on the hosting provider
SSH_USER_NAME="#####"
DOMAIN_PATH="/home/${USER_NAME}/domains/${DOMAIN}"
CORE_DIR="$DOMAIN_PATH/laravel_core"
PUBLIC_DIR="$DOMAIN_PATH/public_html"

echo "🚀 Starting Deployment..."

# 1. Update Codebase (Commented out)
# echo "📂 Pulling latest changes from Git..."
# cd $CORE_DIR
# git pull origin main

# 2. Install Dependencies (Commented out)
# echo "📦 Installing Composer dependencies..."
# composer install --no-dev --optimize-autoloader --no-interaction

# --- PREPARATION ---
cd $CORE_DIR

# 3. Rebuild Symlink (Override & Create)
echo "🔗 Setting up Storage Symlink..."

# If public_html/storage exists (as folder or link), delete it first (Override)
if [ -d "$PUBLIC_DIR/storage" ] || [ -L "$PUBLIC_DIR/storage" ]; then
    echo "⚠️  Existing storage folder found. Removing to override..."
    rm -rf "$PUBLIC_DIR/storage"
fi

# Run the link command exactly as requested
echo "✨ Creating new storage symlink..."
ln -s "$CORE_DIR/storage/app/public" "$PUBLIC_DIR/storage"

echo "✅ Storage linked successfully."

# 4. Run Database Migrations (Interactive)
echo "🗄️ Database Migration Setup..."
read -p "Choose migration mode: (y = normal migrate / f = migrate:fresh / n = skip): " migrate_mode

if [ "$migrate_mode" == "y" ]; then
    echo "Running standard migration..."
    php artisan migrate --force
elif [ "$migrate_mode" == "f" ]; then
    echo "⚠️  WARNING: You selected migrate:fresh. This will WIPE all database tables."
    read -p "Are you absolutely sure? (yes/no): " confirm_fresh
    if [ "$confirm_fresh" == "yes" ]; then
        echo "Running migrate:fresh..."
        php artisan migrate:fresh --seed --force
    else
        echo "Fresh migration cancelled."
    fi
else
    echo "Skipping migration."
fi

# 5. Sync Public Assets (DISABLED)
# Since assets are already in public_html, we skip this step.
echo "⏭️  Skipping Asset Sync (Assets are already in public_html)..."
# rsync -av --exclude='index.php' --exclude='.htaccess' --exclude='storage' $CORE_DIR/public/ $PUBLIC_DIR/

# 6. Clear Caches
echo "🧹 Clearing caches..."
php artisan optimize:clear
php artisan config:cache
php artisan route:cache
php artisan view:cache

# 7. Self-Destruct
# Uses "$0" to target THIS script file, whatever it is named.
rm -- "$0"

echo "✅ Deployment Finished Successfully! This script has been automatically deleted to secure public_html."