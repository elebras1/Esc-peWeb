[![Langage](https://img.shields.io/badge/Langage-PHP-blue.svg)](https://www.php.net/)
[![Framework](https://img.shields.io/badge/Framework-CodeIgniter4-orange.svg)](https://codeigniter.com/user_guide/intro/index.html)
[![Langage](https://img.shields.io/badge/Langage-HTML-orange.svg)](https://developer.mozilla.org/en-US/docs/Web/HTML)
[![Libraries](https://img.shields.io/badge/Library-Bootstrap-blueviolet.svg)](https://getbootstrap.com/)
[![Langage](https://img.shields.io/badge/Langage-SQL/PSM-white.svg)](https://sql.sh/)

# EscapeWeb

Ce projet CodeIgniter est une application web de jeux sérieux. L'objectif est qu'un utilisateur non connecté puisse participer à tous les scénarios créés par les organisateurs. Chaque scénario est composé d'étapes ; une étape comprend une question et des indices, en fonction de la difficulté choisie. L'administrateur est chargé de la gestion des comptes.

![escapeweb_demo](escapeweb_demo.gif)

# Sommaire

- [Installation](#install)
- [Fonctionnalités](#core_features)
- [Licence](#licence)

## Installation
<a id="install" class="anchor"></a>

1. Clonez le projet dans votre espace de stockage.
2. Assurez-vous d'avoir une plateforme de développement web installée sur votre système, comme Laragon, XAMPP ou WAMP.
3. Importez le fichier `db_final.sql` dans votre base de données.
4. Éditez le fichier `./ci/app/Config/Database.php` pour configurer l'accès à votre base de données.
5. Modifiez la variable `$baseURL` dans le fichier `./app/Config/App.php`.
6. Selon vos besoins, éditez le fichier `./ci/env` et modifiez la variable `CI_ENVIRONMENT`. Renommez le fichier `env` en `.env` en conséquence.

## Fonctionnalités
<a id="core_features" class="anchor"></a>

- Affichage des actualités sur la page d'accueil.
- La liste de tous les scénarios et le choix de la difficulté sont disponibles pour tous les utilisateurs.
- La participation à un scénario est possible pour tout utilisateur, et une fois terminé, l'utilisateur peut renseigner son identité.
- Un utilisateur connecté peut visualiser et modifier les informations de son profil.
- Un organisateur peut voir les détails de tous les scénarios, créer un nouveau scénario et supprimer ses scénarios.
- Un administrateur peut accéder au récapitulatif de tous les utilisateurs, créer de nouveaux utilisateurs et les déclarer "actifs" ou non.

## Licence

Ce projet est sous licence [MIT](https://img.shields.io/badge/Licence-MIT-blue.svg).

Pour plus de détails, veuillez consulter le fichier [LICENSE](public/licence.md).

<a id="licence" class="anchor"></a>
