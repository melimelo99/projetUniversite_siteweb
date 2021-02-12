# tomatons
pour le projet web kara razafitrimo

Lien sur le fonctionnement de GitHub https://guides.github.com/activities/hello-world/

En résumé :

- le dossier ou "repository" Master sera la version finale ou la version consolidée de nos deux codes
- j'ai créé des branches différentes pour qu'on puisse travailler chacun de son côté sur le code une fois qu'on aura réparti les tâches : les modifications effectuées sur les branches n'affectent pas le code du Master
- Une fois qu'on commit de notre côté, il faut effectuer un "pull request" qui permet de comparer les versions de notre branche à celle de Master afin de comparer notamment les différences.
- A terme on se retrouvera avec un code propre sur lequel on aura travaillé tous les deux

- Fin du projet meilleur binôme de tous les temps



Partie code pour espace admin 


Etape 1) Tu fait un dossier /admin/

Etape 2) un fichier index.php dedans et tu vérifies d'entrée que l'user est bien admin et a une session PHP en cours  (et valide, que c'est bien la sienne, que c'est bien un admin, ...)

Etape 3) Tu crées ensuite un formulaire dans ce fichier index.php avec un input type text pour le titre, un input type text pour l'url-slug et un input type area pour le contenu de cette page

Etape 4) Lors de l'envoie des données vers la bdd, tu traites les espaces du textarea avec nl2br (pour faire simple) et comme il n'y a que toi (admin) tu te contenteras d'enlever les balises html avec strip_tags + filtre à ce que tu t'autorises (comme <br> par exemple), sinon si la création de pages est openbar à tous les utilisateurs faudra voir du côté de l'extension PHP DOMDocument et loader côté serveur et filtrer toutes les balises script. Si tu te sents d'inclure un éditeur wysiwyg à ton projet, t'en trouveras open source, le + connu étant http://www.tinymce.com/

Etape 5) Tu crées ta boucle pour le frontend qui va récupérer ce contenu suivant le bon slug et plus rapide encore en récupèrant l'id et tu urlrewrite via ton htaccess.

Etape 6) Tu crée côté admin tjrs un fichier, par exemple manage.php (là aussi tester la session, si c'est bien un admin, etc...), et dedans tu crée une boucle qui récupère toute la table "pages" et tu afffiches le tout dans une table html en prenant soin d'ajouter un bouton "supprimer" et un bouton "modifier" à placer par exemple dans une colonne html nommée "action", "supprimer" supprimera la page de ta BDD et te redirigera vers cette liste, "modifier" pointera vers /admin/index et chargera le bon contenu dans les bon input de ton formulaire (données récupérées en bdd grâce à l'id que tu vas passer en paramètre). Accessoirement, pas trop besoins de créer une pagination puisqu'on a jamais bcp de pages sur un site web (comparé aux articles par exemple).

Etape 7) Tu as lu jusqu'au bout mais t'as l'impression que c'est du chinois ? Commence par le début http://fr.openclassrooms.com/informatique/cours/concevez-votre-site-web-avec-php-et-mysql