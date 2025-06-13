docker system prune -a -f # Clear All Inactive Things from Docker

rm -rf postgres/data/ postgres/dump.sql/ # Remove Postgres Data and Dump

sed -i '/^APP_KEY=/d' .env # Remove APP_KEY from .env
echo "" >> .env # Add blank line
echo "APP_KEY=" >> .env # Generate and add new APP_KEY