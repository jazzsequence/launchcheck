#!/bin/bash
DB_HOST="${DB_HOST:-localhost}" # Default to localhost if not set


DB_EXISTS=$(mysql -u root -e "SHOW DATABASES LIKE 'pantheon';" | grep "pantheon" > /dev/null; echo "$?")

# If the database does not exist, create it along with the user and grant privileges
if [ $DB_EXISTS -ne 0 ]; then
    mysql -u root -e "CREATE DATABASE pantheon; CREATE USER 'pantheon'@'localhost' IDENTIFIED BY 'pantheon'; GRANT ALL PRIVILEGES ON pantheon.* TO 'pantheon'@'localhost'; FLUSH PRIVILEGES;"
else
    echo "Database pantheon already exists."
fi
