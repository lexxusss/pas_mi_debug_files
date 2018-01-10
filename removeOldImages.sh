#/bin/bash
/usr/bin/ionice -c2 -n7 find /var/www/html/pasujemi/web/uploads/product/ -mtime +1 -delete
/usr/bin/ionice -c2 -n7 find /var/www/html/pasujemi/web/uploads/product2015/ -mtime +1 -delete

