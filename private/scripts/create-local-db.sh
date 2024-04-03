#!/bin/bash
DB_HOST="${DB_HOST:-localhost}" # Default to localhost if not set
DB_PASS="${MYSQL_ROOT_PASSWORD:-}"

# If DB_PASS is set, define a CMD that includes the password.
if [ -n "$DB_PASS" ]; then
    CMD="mysql -u root -p$DB_PASS"
else
    CMD="mysql -u root"
fi

DB_EXISTS=$($CMD -e "SHOW DATABASES LIKE 'pantheon';" | grep "pantheon" > /dev/null; echo "$?")

# If the database does not exist, create it along with the user and grant privileges
if [ $DB_EXISTS -ne 0 ]; then
    $CMD -e "CREATE DATABASE pantheon; CREATE USER 'pantheon'@'localhost' IDENTIFIED BY 'pantheon'; GRANT ALL PRIVILEGES ON pantheon.* TO 'pantheon'@'localhost'; FLUSH PRIVILEGES;"
else
    echo "Database pantheon already exists."
fi
