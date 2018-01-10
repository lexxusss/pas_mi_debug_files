#!/bin/bash
cd /var/www/html/pasujemi
/usr/bin/php app/console pasujemi:import:run

#pasujemi:import:prices  - codziennie, służy do aktualizacji cen z XMLa Zanoxa
#pasujemi:import:run - co kilka dni, wykonuje pełen import nowych produktów
#pasujemi:import:update - ta komenda służy do zaciągania zdjęć. Aktualizuje tylko 50 ostatnich produktów. Jest to jedyna komenda, która dociąga zdjęcia, dlatego trzeba ją uruchamiać po run
