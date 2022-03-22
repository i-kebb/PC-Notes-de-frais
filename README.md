#Projet claqué de Baguette : Notes de Frais (NDF)
##WARNING
Attention, vous vous apprêtez à lire du code tout claqué, faites attention à votre santé mentale !
## Kékecé ?
Le but de ce mini-projet est de réaliser une plateforme où les membres du GInfo peuvent entrer les dépenses qu’ils ont 
réalisé pour le GInfo. A l’heure actuelle, ceci est réalisé via un formulaire à remplir ce qui peut être assez long à 
faire dans certains cas. 


## Kékonfé Baguette pour tout bien installer ?
**Dépendances pour l'installation**

NPM >= 6

PHP >= 7.2

COMPOSER

**Installation**

Vous devez installer npm sur votre machine pour gérer les packets qui relèvent de l'ordre du front-end.
À la première installation, vous devez installer les dépendances back-end et front-end.

Installez les dépendances PHP (back-end) :

> ``composer install``

Puis les dépendances JS (front-end) :

> ``npm install``

Vous pouvez ensuite compiler les fichiers front-end et lancer le watch pour continuer à les compiler même quand vous les éditez :

> ``npm run watch``

Avant d'initialiser la DB, il faut ajouter le contenus de `.env.dist` au fichier `.env`.

Initialisez la DB (il faut avoir laragon / WAMP / MAMP ouvert) :

> ``php bin/console doctrine:database:create``

> ``php bin/console doctrine:migrations:migrate``

> ``php bin/console doctrine:fixtures:load``

Puis lancez le serveur en local :

> ``php -S localhost:8000 -t public/``

Vous pouvez maintenant vous rendre sur l'application : ``http://localhost:8000``

Pour se mettre admin :

> ``php bin/console fos:user:promote nomdutilisateur ROLE_ADMIN``

PS. Oui j'ai bien pompé le readme de My. Oups.
