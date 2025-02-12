# Diagramme de classe
    https://drawsql.app/teams/agiliteach/diagrams/miniamaker



# Les commendes utilises :
    
## Créer un nouveau projet:
    symfony console Miniamaker --webapp

## lancer le serveur
    symfony server:start

## arreter le serveur
    symfony server:stop

## Créer une entity
    symfony console make :entity NomEntity

## Créer un controller
    symfony console make:controller

## Créer formulaire d'inscription
    Symfony console make:registration-form
    
## Créer formulaire  de connexion
    symfony console make:security:form-login

## Créer formulaire:
    Symfony console make:form

## Start le serveur de messenger :
    symfony console messenger:consume async -vv

## installer Drapzone:
    composer require symfony/ux-dropzone

## Installer stripe :
    Composer require stripe/stripe-php

## Hash un mot de passe utilisateur:
    symfony console security:hash-password

## installer ux-twig
    composer require symfony/ux-twig-component

## Crée un composant Twig (ou Live)
    symfony console make:twig-component

## install liip/imagine => pour l'image ( apres 'y')
    composer require liip/imagine-bundle

## Crée une nouvelle extension Twig avec sa classe runtime
    symfony console make:twig-extension

## install orm fixtures
    composer require orm-fixtures --dev

## install faker php
    composer req fakerphp/faker --dev

## Ajouter des api a la base de donnée a partir de AppFixture:
    symfony console d:f:l

## installer les icons
    composer require symfony/ux-icons

## Exécute une migration vers une version spécifiée ou la dernière version disponible
    symfony console d:m:m

## Crée un authenticateur Guard de différents types
    symfony console make:auth

## Crée les opérations CRUD pour une classe d'entité Doctrine
    symfony console make:crud

## Crée une nouvelle migration basée sur les changements de la base de données
    symfony console make:migration

## Crée une nouvelle classe d'utilisateur de sécurité
    symfony console make:user

## Crée la base de données configurée
    symfony console d:d:c

## Changer la branche de git
    git checkout Nom_branche