#!/bin/bash

TXT='Subject: Pobranie plikow z Zanox\nFrom: System PasujeMi.pl <no-reply@pasujemi.com>\n\n'
TXT+='Pobrano pliki z Zanox (rozmiar, data, nazwa):\n'
TXT+=`ls --time-style=full-iso -lh /home/lrzepecki/php/csv/import-zalando.csv | cut -d ' ' -f 5,6,9`
TXT+='\n'
TXT+=`ls --time-style=full-iso -lh /home/lrzepecki/php/csv/import-asos.csv | cut -d ' ' -f 5,6,9`
TXT+='\n'
TXT+=`ls --time-style=full-iso -lh /home/lrzepecki/php/csv/import-answear.csv | cut -d ' ' -f 5,6,9`
TXT+='\n'
TXT+=`ls --time-style=full-iso -lh /home/lrzepecki/php/csv/import-stradiv.csv | cut -d ' ' -f 5,6,9`

echo -e $TXT  | sendmail lukasz@pasujemi.com kasia@pasujemi.com

