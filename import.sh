#!/bin/bash

#dirHome=/home/lrzepecki/php
dirHome=/Applications/MAMP/htdocs/AUTENTI/PasujeMi_debug_files

function download {
    echo "Import $1";

	/usr/bin/wget -a $dirHome/csv/import.log -O $dirHome/csv/$1 "$2"
	if [ $? -ne 0 ] ; then
		echo "Probuje ponownie..." ;
		/usr/bin/wget -a $dirHome/csv/import.log -O $dirHome/csv/$1 "$2"
	fi
}

function downloadGz {
    download $1 $2

    echo "Unpack $1";
    /usr/bin/gunzip -f $dirHome/csv/$1

}


#IMPORT NEW TEMPLATES
#downloadGz import-new-datafeed.csv.gz "https://productdata.awin.com/datafeed/download/apikey/977be54b7b887488e3938750b8cb49e8/language/any/cid/141,205,198,206,203,199,204,201/columns/aw_deep_link,product_name,aw_product_id,merchant_product_id,merchant_image_url,description,merchant_category,search_price,merchant_name,merchant_id,category_name,category_id,aw_image_url,currency,store_price,delivery_cost,merchant_deep_link,language,last_updated,display_price,data_feed_id,brand_name,brand_id,colour,product_short_description,specifications,condition,product_model,model_number,dimensions,keywords,promotional_text,product_type,commission_group,merchant_product_category_path,merchant_product_second_category,merchant_product_third_category,rrp_price,saving,savings_percent,base_price,base_price_amount,base_price_text,product_price_old,delivery_restrictions,delivery_weight,warranty,terms_of_contract,delivery_time,in_stock,stock_quantity,valid_from,valid_to,is_for_sale,web_offer,pre_order,stock_status,size_stock_status,size_stock_amount,merchant_thumb_url,large_image,alternate_image,aw_thumb_url,alternate_image_two,alternate_image_three,alternate_image_four,reviews,average_rating,rating,number_available,custom_1,custom_2,custom_3,custom_4,custom_5,custom_6,custom_7,custom_8,custom_9,ean,isbn,upc,mpn,parent_product_id,product_GTIN,basket_link,Fashion%3Asuitable_for,Fashion%3Acategory,Fashion%3Asize,Fashion%3Amaterial,Fashion%3Apattern,Fashion%3Aswatch,GroupBuying%3Aevent_date,GroupBuying%3Aexpiry_date,GroupBuying%3Aexpiry_time,GroupBuying%3Aevent_city,GroupBuying%3Aevent_address,GroupBuying%3Anumber_sessions,GroupBuying%3Aterms,GroupBuying%3Anumber_sold,GroupBuying%3Amin_required,GroupBuying%3Asupplier,GroupBuying%3Agroup_latitude,GroupBuying%3Agroup_longitude,GroupBuying%3Adeal_start,GroupBuying%3Adeal_end/format/csv/delimiter/%2C/compression/gzip/adultcontent/1/"
downloadGz new-datafeed_awin.csv.gz "https://productdata.awin.com/datafeed/download/apikey/977be54b7b887488e3938750b8cb49e8/language/pl/fid/19817/columns/aw_deep_link,product_name,aw_product_id,merchant_product_id,merchant_image_url,description,merchant_category,search_price,merchant_name,merchant_id,category_name,category_id,aw_image_url,currency,store_price,delivery_cost,merchant_deep_link,language,last_updated,display_price,data_feed_id,brand_name,brand_id,colour,product_short_description,specifications,condition,product_model,model_number,dimensions,keywords,promotional_text,product_type,commission_group,merchant_product_category_path,merchant_product_second_category,merchant_product_third_category,rrp_price,saving,savings_percent,base_price,base_price_amount,base_price_text,product_price_old,delivery_restrictions,delivery_weight,warranty,terms_of_contract,delivery_time,in_stock,stock_quantity,valid_from,valid_to,is_for_sale,web_offer,pre_order,stock_status,size_stock_status,size_stock_amount,merchant_thumb_url,large_image,alternate_image,aw_thumb_url,alternate_image_two,alternate_image_three,alternate_image_four,reviews,average_rating,rating,number_available,custom_1,custom_2,custom_3,custom_4,custom_5,custom_6,custom_7,custom_8,custom_9,ean,isbn,upc,mpn,parent_product_id,product_GTIN,basket_link,Fashion%3Asuitable_for,Fashion%3Acategory,Fashion%3Asize,Fashion%3Amaterial,Fashion%3Apattern,Fashion%3Aswatch/format/csv/delimiter/%2C/compression/gzip/adultcontent/1/"


#   echo -e $TXT  | /sbin/sendmail lukasz@pasujemi.com kasia@pasujemi.com

# parsowanie pobranych plikow CSV do tabeli przejsciowej (x_products)
   /usr/bin/php -f $dirHome/import-csv.php

# analiza bazy przejsciowej i import do bazy wlasciwej aplikacji
#   /usr/bin/php -f $dirHome/import-db.php

# pobranie glownych obrazkow ze stron sklepow dla product i temporary_product
#   $dirHome/getImages.sh

# po pobraniu obrazkow ponownie analiza i import (odkrycie produktow ktorym pobrano obrazki)
#   /usr/bin/php -f $dirHome/import-db.php

# pobranie sklwpowych urli produktow dla offer (uzywane do szukania produktow w adminie)
#   $dirHome/updateRealUrl.sh

# higienicznie
#chown -R apache /var/www/html/pasujemi/app/cache/ /var/www/html/pasujemi/app/logs/

#   /usr/sbin/apachectl restart
#   /bin/chown -R apache:apache /var/www/html

#/bin/systemctl restart varnish.service - nie uzywane!
#/bin/systemctl restart mariadb

#   echo -e "Subject: Koniec importu\nFrom: System PasujeMi.pl <no-reply@pasujemi.com>\n\nKoniec importu"  | /sbin/sendmail lukasz@pasujemi.com kasia@pasujemi.com

