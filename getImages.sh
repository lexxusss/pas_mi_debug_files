#!/bin/bash

#/usr/bin/mysql -u root pasujemi -e"UPDATE offer o LEFT OUTER JOIN product_image pi ON pi.temporary_product_id=o.temporary_product_id SET updated_at='1990-01-01' WHERE o.temporary_product_id IS NOT NULL AND pi.temporary_product_id IS NULL;"

#/usr/bin/mysql -u root pasujemi -e"UPDATE offer o LEFT OUTER JOIN product_image pi ON pi.product_id=o.product_id SET updated_at='1990-01-01' WHERE o.product_id IS NOT NULL AND pi.product_id IS NULL;"

#rows=`/usr/bin/mysql -u root pasujemi --skip-column-names -e"SELECT round(count(*)/50)+1 FROM offer WHERE updated_at='1990-01-01' AND deleted_at IS NULL;"`

#cd /var/www/html/pasujemi

#for i in `seq 1 $rows`; do
#/usr/bin/php app/console pasujemi:import:update
#done

cd ~lrzepecki/php/
/bin/php -f getImages.php

