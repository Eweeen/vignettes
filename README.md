# Vignettes

# Description du Projet

## Contexte
Au sein de votre école, il est fréquent de réaliser des projets graphiques ou visuels. 
Souhaitant promouvoir les travaux ainsi réalisés par vos proches, votre formateur vous demande de réaliser un site web. 
L'idée est de réaliser un site avec une rapide ressemblance à Pinterest. C'est à dire, une application où sont affichées de nombreux médias filtrables par catégories. Les noms des élèves ne seront pas affichés, mais uniquement un mystérieux chiffre dont le détenteur est le créateur de l'oeuvre.

L'objectif de l'application sera d'être modulable et responsive, afin qu'il soit possible d'utiliser ce site pour de nombreuses thématiques. L'admin s'occupera d'activer et désactiver des catégories. 

## Description de l'application
Cette application de type SPA contiendra un grand dashboard, dans lequel, les utilisateurs connectés pourront rajouter du contenu. 
 
Les contenus seront représentés sous forme de blocs, affichant une vignette d'un média. Chaque bloc sera modifiable par l'admin en largeur et longueur afin de pouvoir personnaliser la page du dashboard.
  
La pluspart des utilisateurs ne seront pas connectés. Ces derniers n'auront aucun moyen d'uploader des données ni de modifier le dashboard.

Si un utilisateur connecté ou non connecté clique sur un bloc, celui-ci s'agrandit afin de prendre toute la taille de la page et afficher le média. Le titre et la description ainsi que le numéro de créateur seront également affichés. Il sera possible de cliquer sur le numéro du créateur ou de la catégorie pour retourner sur le dashboard avec des données filtrées.

Attention, si un son ou une vidéo est incorporée dans le bloc, le media devra se lancer automatiquement lors de l'ouverture du bloc. Une interface de contrôles du média sera affichée.

## Utilisateur connecté ayant le rôle USER

Une connection utilisateur sera requise pour accéder à l'interface d'admin.
Un utilisateur normal se connectera avec un email et un mot de passe et pourra uploader du contenu. Son numéro unique lui sera affiché.

Au sein d'un bloc, il sera possible de rajouter :

* une image
* et/ou un son
* ou une vidéo
* Un titre (obligatoire)
* Une courte description
* Une catégorie (obligatoire)

## Utilisateur connecté ayant le rôle ADMIN
Un super utilisateur pourra :
	- ajouter/modifier/désactiver/supprimer des catégories
	- ajouter/modifier/désactiver un compte utilisateur
	- modérer le contenu des utilisateurs (Désactiver certains contenus). 

Cette application sera livrée au client avec un compte super utilisateur déjà présent dans la base de données.  Ce dernier sera le seul membre autorisé à créer des utilisateurs.

Un super utilisateur aura également la possibilité de configurer:
 - Au moins 3 thèmes : Fond Noir, Fond Blanc, Fond avec une image de son choix
 - Reglage de l'opacité du fond
 - Format des blocs possibles (en fonction du device)

