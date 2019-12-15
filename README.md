# ToDoList
Projet numéro 8 de la formation PHP/Symfony d'OpenClassrooms qui consiste à améliorer une application existante.

## Description du projet

Voici les principales fonctionnalités disponibles suivant les différents statuts utilisateur:

* Le visiteur:
      * Créer un utilisateur.
  * L'utilisateur:
      * **Prérequis:** avoir créer son utilisateur.
      * Modifier son profil.
      * Créer un nouvelle tâche.
      * Accéder à la liste des tâches.
      * Supprimer une tâche.
      * Marquer une tâche comme faite.
      * Modifier une tâche.
  * Administrateur:
      * **Prérequis:** avoir le status administrateur.
      * Accès aux mêmes fonctionnalités que le visiteur/utilisateur.
      * Modifier un utilisateur
      * Supprimer une tâche liée à un utilisateur 'anonyme'

## Contrôle du code

La qualité du code a été validé par [Code climate](https://codeclimate.com/) et l'intégration continue avec [Travis](https://travis-ci.com/):

[![Maintainability](https://api.codeclimate.com/v1/badges/d88eec762ea474f13478/maintainability)](https://codeclimate.com/github/sebAvenel/ToDoList/maintainability)
[![Build Status](https://travis-ci.com/sebAvenel/ToDoList.svg?branch=master)](https://travis-ci.com/sebAvenel/ToDoList)

## Prérequis

Php ainsi que Composer doivent être installés sur votre ordinateur afin de pouvoir correctement lancé le blog.

## Informations

Vous pouvez accéder aux informations de contribution en claquant [ici](https://github.com/sebAvenel/ToDoList/blob/master/contribution.md)

## Installation

  * Téléchargez et dézipper l'archive. Installer le contenu dans le répertoire de votre serveur:
      * Wamp : Répertoire 'www'.
      * Mamp : Répertoire 'htdocs'.

  * Ensuite placez-vous dans votre répertoire par le biais de votre console de commande (ou terminal) et renseignez la commande suivante:
  
      ```bash
      'composer install' pour windows
      ```
      
      ```bash
      'php composer.phar install' pour Mac OS.
      ```
      
  * Création de la base de données:
      ```bash
      php bin/console doctrine:database:create
      ```
      
      ```bash
      'php bin/console make:migration'
      ```
      
      ```bash
      'php bin/console doctrine:migrations:migrate'
      ```
      
  * Création de données fictives pour tester le site:
  
      ```bash
      'php bin/console doctrine:fixtures:load'
      ```
    
  * Démarrage du serveur de symfony:
  
      ```bash
      'php bin/console server:run'
      ```
      
  * Renseigner l'URL suivante dans le navigateur:
      * 'http://localhost:8000/'
      * Ou directement via votre serveur local:
          * Windows: http://localhost/todolist/public/
          * Mac: http://localhost:8888/todolist/public/
 
 ## Outils utilisés

  * [Symfony](https://symfony.com/)
  * [Composer](https://getcomposer.org/)
  * [Bootstrap](https://getbootstrap.com/)
  * [Twig](https://twig.symfony.com/)
  
## Auteur

  * Avenel Sébastien
