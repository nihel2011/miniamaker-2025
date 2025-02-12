### Les commendes utilises :
    
# Créer un nouveau projet:
    symfony console Miniamaker --webapp

# lancer le serveur
    symfony server:start

# arreter le serveur
    symfony server:stop

# Créer une entity
    symfony console make :entity NomEntity

# Créer un controller
    symfony console make:controller

# Créer formulaire d'inscription
    Symfony console make:registration-form
    
# Créer formulaire  de connexion
    symfony console make:security:form-login

# Créer formulaire:
    Symfony console make:form

# Start le serveur de messenger :
    symfony console messenger:consume async -vv

# installer Drapzone:
    composer require symfony/ux-dropzone

# Installer stripe :
    Composer require stripe/stripe-php

# Security hach password:
    symfony console security:hash-password

# installer ux-twig
    composer require symfony/ux-twig-component

# creer twig component
    symfony console make:twig-component

# install liip/imagine => pour l'image ( apres 'y')
    composer require liip/imagine-bundle

# creer twig extension
    symfony console make:twig-extension

# install orm fixtures
    composer require orm-fixtures --dev

# install faker php
    composer req fakerphp/faker --dev

#