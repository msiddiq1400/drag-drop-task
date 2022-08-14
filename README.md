## Steps to run the app

git clone URL
composer install
npm install

#### Step 1
    Create a database with your user inside mysql and update env file with db name and credentials

#### Step 2
    php artisan migrate (will create the required tables)

#### Step 3
    php artisan db:seed --class=MessageSeeder (will add the 10 messages inside DB)
#### Step 4
    php artisan serve (will run the app on localhost:8000)