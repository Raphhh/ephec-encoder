# Moodle to e-perso

Convertit les exports de points depuis Moodle vers les templates e-perso de l'EPHEC.

Version en test!

## Installation

 1. Télécharger le dépôt.
 2. Installer les dépendances: `$ php composer.phar install`


## Utilisation

 1. Exporter les points des tests depuis Moodle. Les fichiers doivent être exportés en format CSV.
 2. Placer les exports dans le répertoire local `data/moodle`.
 3. Exporter les templates du cours depuis e-perso. Les fichiers doivent être exportés en format Excel.
 4. Placer les templates dans le répertoire local `data/templates`.
 5. Lancer la commande `$ php bin/convert`.
 6. Les points se trouvant dans les exports ont été insérés dans les templates.
