### 1. Se créer un compte sur GitHub

Envoyez moi votre addresse mail que vous avez utilisé pour créer votre compte pour que je vous donne les droits sur le repo.

### 2. Ajouter le git à PHPStorm

 -Aller dans: File -> Settings
  
 -Dans les "Settings" dérouler "Version control" puis sélectionner "GitHub"
 
 -Saisir les informations suivantes : 
        Host : github.com             Auth Type: Password
        Login : votre_login_git
        Password : Votre_passwd
        
 -Tester la connetion en cliquant sur 'Test'
 
 -Décocher 'Clone git repositories using ssh'
 
 -Quitter settings et aller dans :  VCS -> Git -> Clone
 
 -Saisir les infos suivantes : 
   Git Repository URL: https://github.com/oiraMm/ProjetCarPark.git
   Parent Directory : /votre/chemin/PhpstormProjects
   Directory name : ProjetCarPark

### 3. Faire des modifications

 Quand vous faites des modifs elles ne sont pas directement appliqués au Repo, pour les appliqués il faut "pousser la modif".
 Pour ca il faut ouvrir un terminal dans phpstorm : View -> Tool Windows -> Terminal

 Ensuite il une fois dans le terminal faites:

    $ git add -A
    $ git commit -m "Message court expliquant les modifications"
    $ git push origin master


### 4. Remarques

 Pour être sur que vous êtes a jour avec le repo en ligne, il faut faire dans le terminal:

    $ git pull
    remote: Counting objects: 4, done.
    remote: Compressing objects: 100% (4/4), done.
    remote: Total 4 (delta 2), reused 0 (delta 0), pack-reused 0
    Dépaquetage des objets: 100% (4/4), fait.
    Depuis github.com:oiraMm/ProjetCarPark
      e9abde6..2f29927  master     -> origin/master
    Mise à jour e9abde6..2f29927
    Fast-forward
    Documents/Tuto-PHPStorm | 8 +++++++-
    1 file changed, 7 insertions(+), 1 deletion(-)
    
 Si jamais vous avez des problèmes de version e voulez revenir à la version du Git en ligne:
 
    $ git fetch --all
    $ git reset --hard origin/master


   
   
