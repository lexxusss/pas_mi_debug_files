#!/bin/bash

export LC_ALL=C
GRP=`date +"%b %d %H" -d "1 hour ago"`


#WYLACZONE!
#ERR=`grep "$GRP" /var/log/httpd/pasujemi-error_log | grep "Fatal"`
ERR=""

GRP=`date +"%Y-%m-%d %H" -d "1 hour ago"`

ERR2=`grep "$GRP" /var/www/html/pasujemi/app/logs/prod.log | grep "CRITICAL" | grep -v "Unknown stored enum key:"`

if [ -n "$ERR" -o "$ERR2" ]; then
  echo "${ERR}";
  echo "${ERR2}";
  echo -e "Subject: Bledy na produkcji\nFrom: System PasujeMi.pl <no-reply@pasujemi.com>\n\n$ERR\n$ERR2"  | /sbin/sendmail lukasz@pasujemi.com 
fi

GRP=`date +"%b %d %H" -d "1 hour ago"`
ERR=`grep "$GRP" /var/log/httpd/eventi-error_log | grep "Fatal"`

GRP=`date +"%Y-%m-%d %H" -d "1 hour ago"`
ERR2=`grep "$GRP" /var/www/html/eventi/app/logs/prod.log | grep "CRITICAL"`

if [ -n "$ERR" -o "$ERR2" ]; then
  echo "${ERR}";
  echo "${ERR2}";
  echo -e "Subject: Bledy na produkcji\nFrom: System Eventi.pl <no-reply@eventi.pl>\n\n$ERR\n$ERR2"  | /sbin/sendmail lukasz@eventi.pl 
fi

GRP=`date +"%y%m%d %k" -d "1 hour ago"`
ERR=`grep "$GRP" /var/log/mariadb/mariadb.log | grep "ERROR"`

if [ -n "$ERR" ]; then
  echo "${ERR}";
  echo -e "Subject: Bledy na produkcji\nFrom: System PHP <no-reply@pasujemi.pl>\n\n$ERR"  | /sbin/sendmail lukasz@rzepecki.net
fi

