#!/bin/bash

function download {
    echo "Import $1";

	/usr/bin/wget -a /home/lrzepecki/php/csv/import.log -O /home/lrzepecki/php/csv/$1 "$2"
	if [ $? -ne 0 ] ; then
		echo "Probuje ponownie..." ;
		/usr/bin/wget -a /home/lrzepecki/php/csv/import.log -O /home/lrzepecki/php/csv/$1 "$2"
	fi
}

function downloadGz {
    download $1 $2

    echo "Unpack $1";
    /usr/bin/gunzip -f /home/lrzepecki/php/csv/$1

}

#zalando
download import-zalando.csv "http://productdata.zanox.com/exportservice/v1/rest/27899028C75167572.csv?ticket=6658B011FBCB0CDBE45FB47DA6D33AA2&productIndustryId=1&columnDelimiter=,&textQualifier=DoubleQuote&nullOutputFormat=NullValue&dateFormat=yyyy-MM-dd'T'HH:mm:ss:SSS&decimalSeparator=period&mc=&nb=&zi=&id=&pg=&na=&pp=&po=&cy=&du=&ds=&dl=&tm=&c1=&c2=&c3=&ia=&im=&il=&df=&dt=&lk=&ss=&sa=&af=&sp=&sv=&x1=&x2=&x3=&x4=&x5=&x6=&x7=&x8=&x9=&ea=&gt=&is=&td=&bp=&ba=&bt=&sh=&sn=&pc=&zs=&za=&mn=&mo=&co=&ma=&sz=&gn=&i1=&i2=&i3=&gZipCompress=null"

#answear
download import-answear.csv "http://productdata.zanox.com/exportservice/v1/rest/43232008C1533922214.csv?ticket=6658B011FBCB0CDBE45FB47DA6D33AA2&productIndustryId=1&columnDelimiter=,&textQualifier=DoubleQuote&nullOutputFormat=NullValue&dateFormat=yyyy-MM-dd'T'HH:mm:ss:SSS&decimalSeparator=period&mc=&nb=&zi=&id=&pg=&na=&pp=&po=&cy=&du=&ds=&dl=&tm=&c1=&c2=&c3=&ia=&im=&il=&df=&dt=&lk=&ss=&sa=&af=&sp=&sv=&x1=&x2=&x3=&x4=&x5=&x6=&x7=&x8=&x9=&ea=&gt=&is=&td=&bp=&ba=&bt=&sh=&sn=&pc=&zs=&za=&mn=&mo=&co=&ma=&sz=&gn=&i1=&i2=&i3=&gZipCompress=null"

#download import-answear.csv "http://productdata.zanox.com/exportservice/v1/rest/27612142C97199361.csv?ticket=6658B011FBCB0CDBE45FB47DA6D33AA2&productIndustryId=1&columnDelimiter=,&textQualifier=DoubleQuote&nullOutputFormat=NullValue&dateFormat=yyyy-MM-dd'T'HH:mm:ss:SSS&decimalSeparator=period&mc=&nb=&zi=&id=&pg=&na=&pp=&po=&cy=&du=&ds=&dl=&tm=&c1=&c2=&c3=&ia=&im=&il=&df=&dt=&lk=&ss=&sa=&af=&sp=&sv=&x1=&x2=&x3=&x4=&x5=&x6=&x7=&x8=&x9=&ea=&gt=&is=&td=&bp=&ba=&bt=&sh=&sn=&pc=&zs=&za=&mn=&mo=&co=&ma=&sz=&gn=&i1=&i2=&i3=&gZipCompress=null"

#asos
download import-asos.csv "http://productdata.zanox.com/exportservice/v1/rest/27623526C58613890.csv?ticket=6658B011FBCB0CDBE45FB47DA6D33AA2&productIndustryId=1&columnDelimiter=,&textQualifier=DoubleQuote&nullOutputFormat=NullValue&dateFormat=yyyy-MM-dd'T'HH:mm:ss:SSS&decimalSeparator=period&mc=&nb=&zi=&id=&pg=&na=&pp=&po=&cy=&du=&ds=&dl=&tm=&c1=&c2=&c3=&ia=&im=&il=&df=&dt=&lk=&ss=&sa=&af=&sp=&sv=&x1=&x2=&x3=&x4=&x5=&x6=&x7=&x8=&x9=&ea=&gt=&is=&td=&bp=&ba=&bt=&sh=&sn=&pc=&zs=&za=&mn=&mo=&co=&ma=&sz=&gn=&i1=&i2=&i3=&gZipCompress=null"

#stylepit
download import-stylepit.csv "http://productdata.zanox.com/exportservice/v1/rest/35220944C32276748.csv?ticket=6658B011FBCB0CDBE45FB47DA6D33AA2&productIndustryId=1&columnDelimiter=,&textQualifier=DoubleQuote&nullOutputFormat=NullValue&dateFormat=yyyy-MM-dd'T'HH:mm:ss:SSS&decimalSeparator=period&mc=&nb=&zi=&id=&pg=&na=&pp=&po=&cy=&du=&ds=&dl=&tm=&c1=&c2=&c3=&ia=&im=&il=&df=&dt=&lk=&ss=&sa=&af=&sp=&sv=&x1=&x2=&x3=&x4=&x5=&x6=&x7=&x8=&x9=&ea=&gt=&is=&td=&bp=&ba=&bt=&sh=&sn=&pc=&zs=&za=&mn=&mo=&co=&ma=&sz=&gn=&i1=&i2=&i3=&gZipCompress=null"

#stylepit
download import-badura.csv "http://productdata.zanox.com/exportservice/v1/rest/36180960C58755532.csv?ticket=6658B011FBCB0CDBE45FB47DA6D33AA2&productIndustryId=1&columnDelimiter=,&textQualifier=DoubleQuote&nullOutputFormat=NullValue&dateFormat=yyyy-MM-dd'T'HH:mm:ss:SSS&decimalSeparator=period&mc=&nb=&zi=&id=&pg=&na=&pp=&po=&cy=&du=&ds=&dl=&tm=&c1=&c2=&c3=&ia=&im=&il=&df=&dt=&lk=&ss=&sa=&af=&sp=&sv=&x1=&x2=&x3=&x4=&x5=&x6=&x7=&x8=&x9=&ea=&gt=&is=&td=&bp=&ba=&bt=&sh=&sn=&pc=&zs=&za=&mn=&mo=&co=&ma=&sz=&gn=&i1=&i2=&i3=&gZipCompress=null"

#Mivo / 28
download import-mivo.csv "http://productdata.zanox.com/exportservice/v1/rest/36276355C313824351.csv?ticket=6658B011FBCB0CDBE45FB47DA6D33AA2&productIndustryId=1&columnDelimiter=,&textQualifier=DoubleQuote&nullOutputFormat=NullValue&dateFormat=yyyy-MM-dd'T'HH:mm:ss:SSS&decimalSeparator=period&mc=&nb=&zi=&id=&pg=&na=&pp=&po=&cy=&du=&ds=&dl=&tm=&c1=&c2=&c3=&ia=&im=&il=&df=&dt=&lk=&ss=&sa=&af=&sp=&sv=&x1=&x2=&x3=&x4=&x5=&x6=&x7=&x8=&x9=&ea=&gt=&is=&td=&bp=&ba=&bt=&sh=&sn=&pc=&zs=&za=&mn=&mo=&co=&ma=&sz=&gn=&i1=&i2=&i3=&gZipCompress=null"

#Primamoda / 29
download import-primamoda.csv "http://productdata.zanox.com/exportservice/v1/rest/36276357C169613460.csv?ticket=6658B011FBCB0CDBE45FB47DA6D33AA2&productIndustryId=1&columnDelimiter=,&textQualifier=DoubleQuote&nullOutputFormat=NullValue&dateFormat=yyyy-MM-dd'T'HH:mm:ss:SSS&decimalSeparator=period&mc=&nb=&zi=&id=&pg=&na=&pp=&po=&cy=&du=&ds=&dl=&tm=&c1=&c2=&c3=&ia=&im=&il=&df=&dt=&lk=&ss=&sa=&af=&sp=&sv=&x1=&x2=&x3=&x4=&x5=&x6=&x7=&x8=&x9=&ea=&gt=&is=&td=&bp=&ba=&bt=&sh=&sn=&pc=&zs=&za=&mn=&mo=&co=&ma=&sz=&gn=&i1=&i2=&i3=&gZipCompress=null"

#STYLEBOP / 34
download import-stylebop.csv "http://productdata.zanox.com/exportservice/v1/rest/37028358C919809085.csv?ticket=6658B011FBCB0CDBE45FB47DA6D33AA2&productIndustryId=1&columnDelimiter=,&textQualifier=DoubleQuote&nullOutputFormat=NullValue&dateFormat=yyyy-MM-dd'T'HH:mm:ss:SSS&decimalSeparator=period&mc=&nb=&zi=&id=&pg=&na=&pp=&po=&cy=&du=&ds=&dl=&tm=&c1=&c2=&c3=&ia=&im=&il=&df=&dt=&lk=&ss=&sa=&af=&sp=&sv=&x1=&x2=&x3=&x4=&x5=&x6=&x7=&x8=&x9=&ea=&gt=&is=&td=&bp=&ba=&bt=&sh=&sn=&pc=&zs=&za=&mn=&mo=&co=&ma=&sz=&gn=&i1=&i2=&i3=&gZipCompress=null"

#Bonprix / 30
download import-bonprix.csv "http://api.tradedoubler.com/1.0/productsUnlimited;format=csv;fid=21545?token=B0587616F71191D42E8A2B78F1DA8ACA7DA037EB"

#Ohso / 31
download import-osho.csv "http://api.tradedoubler.com/1.0/productsUnlimited;format=csv;fid=23049?token=B0587616F71191D42E8A2B78F1DA8ACA7DA037EB"

#Deichmann / 32
download import-deichmann.csv "http://api.tradedoubler.com/1.0/productsUnlimited;format=csv;fid=18943?token=B0587616F71191D42E8A2B78F1DA8ACA7DA037EB"

#Pull&Bear / 35
download import-pullbear.csv "http://productdata.zanox.com/exportservice/v1/rest/39071394C925252918.csv?ticket=6658B011FBCB0CDBE45FB47DA6D33AA2&productIndustryId=1&columnDelimiter=,&textQualifier=DoubleQuote&nullOutputFormat=NullValue&dateFormat=yyyy-MM-dd'T'HH:mm:ss:SSS&decimalSeparator=period&mc=&nb=&zi=&id=&pg=&na=&pp=&po=&cy=&du=&ds=&dl=&tm=&c1=&c2=&c3=&ia=&im=&il=&df=&dt=&lk=&ss=&sa=&af=&sp=&sv=&x1=&x2=&x3=&x4=&x5=&x6=&x7=&x8=&x9=&ea=&gt=&is=&td=&bp=&ba=&bt=&sh=&sn=&pc=&zs=&za=&mn=&mo=&co=&ma=&sz=&gn=&i1=&i2=&i3=&gZipCompress=null"

TXT='Subject: Pobranie plikow z Zanox\nFrom: System PasujeMi.pl <no-reply@pasujemi.com>\n\n'
TXT+='Pobrano pliki z Zanox (rozmiar, data, nazwa):\n'
TXT+=`ls --time-style=full-iso -lh /home/lrzepecki/php/import-zalando.csv | cut -d ' ' -f 5,6,9`
TXT+='\n'
TXT+=`ls --time-style=full-iso -lh /home/lrzepecki/php/import-asos.csv | cut -d ' ' -f 5,6,9`
TXT+='\n'
TXT+=`ls --time-style=full-iso -lh /home/lrzepecki/php/import-answear.csv | cut -d ' ' -f 5,6,9`
TXT+='\n'
TXT+=`ls --time-style=full-iso -lh /home/lrzepecki/php/import-stylepit.csv | cut -d ' ' -f 5,6,9`
TXT+='\n'
TXT+=`ls --time-style=full-iso -lh /home/lrzepecki/php/import-badura.csv | cut -d ' ' -f 5,6,9`
TXT+='\n'
TXT+=`ls --time-style=full-iso -lh /home/lrzepecki/php/import-mivo.csv | cut -d ' ' -f 5,6,9`
TXT+='\n'
TXT+=`ls --time-style=full-iso -lh /home/lrzepecki/php/import-primamoda.csv | cut -d ' ' -f 5,6,9`
TXT+='\n'
TXT+=`ls --time-style=full-iso -lh /home/lrzepecki/php/import-stylebop.csv | cut -d ' ' -f 5,6,9`
TXT+='\n'
TXT+=`ls --time-style=full-iso -lh /home/lrzepecki/php/import-bonprix.xml | cut -d ' ' -f 5,6,9`
TXT+='\n'
TXT+=`ls --time-style=full-iso -lh /home/lrzepecki/php/import-osho.xml | cut -d ' ' -f 5,6,9`
TXT+='\n'
TXT+=`ls --time-style=full-iso -lh /home/lrzepecki/php/import-deichmann.xml | cut -d ' ' -f 5,6,9`
TXT+='\n'
TXT+=`ls --time-style=full-iso -lh /home/lrzepecki/php/import-pullbear.xml | cut -d ' ' -f 5,6,9`

echo -e $TXT  | /sbin/sendmail lukasz@pasujemi.com kasia@pasujemi.com

# parsowanie pobranych plikow CSV do tabeli przejsciowej (x_products)
/usr/bin/php -f /home/lrzepecki/php/import-csv.php

# analiza bazy przejsciowej i import do bazy wlasciwej aplikacji
/usr/bin/php -f /home/lrzepecki/php/import-db.php

# pobranie glownych obrazkow ze stron sklepow dla product i temporary_product
/home/lrzepecki/php/getImages.sh

# po pobraniu obrazkow ponownie analiza i import (odkrycie produktow ktorym pobrano obrazki)
/usr/bin/php -f /home/lrzepecki/php/import-db.php

# pobranie sklwpowych urli produktow dla offer (uzywane do szukania produktow w adminie)
/home/lrzepecki/php/updateRealUrl.sh

# higienicznie
#chown -R apache /var/www/html/pasujemi/app/cache/ /var/www/html/pasujemi/app/logs/

/usr/sbin/apachectl restart
/bin/chown -R apache:apache /var/www/html

#/bin/systemctl restart varnish.service - nie uzywane!
#/bin/systemctl restart mariadb

echo -e "Subject: Koniec importu\nFrom: System PasujeMi.pl <no-reply@pasujemi.com>\n\nKoniec importu"  | /sbin/sendmail lukasz@pasujemi.com kasia@pasujemi.com

