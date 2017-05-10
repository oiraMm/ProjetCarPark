### 1. Créer une clé SSH

    $ ssh-keygen
    Generating public/private rsa key pair.
    Enter file in which to save the key (/home/NomUtilisateur/.ssh/id_rsa): (Appuyer sur entrée)
    Enter passphrase (empty for no passphrase): (Appuyer sur entrée)
    Enter same passphrase again: (Appuyer sur entrée)

Il n'y a pas besoin de passphrase pour cette clé.

### 2. Ajouter la clé SSH à Github

    $ cat ~/.ssh/id_rsa.pub
    ssh-rsa AAAAB3NzaC1yc2EAAAADAQABAAACAQDJJN3Ry9t0/W2xOazjJ0CZfqThP3sJRXas9iUL3zZMdDULhBzCahSc+ySuyWARsA6SqjHvVlVHPUxfn5/ME+CyYIRFq8nlU0mODqzMsQSnn1ytIUeHBslgFq5iAoETQVZ1XdTapYSvf3dYuspCJt6OFPXpTqEZB4EerCkD5QPzDxom4CSnkAuo/+BhtxTGbB/Oh1YfBhBvVQh5ZkdWkKeoVr0ZTHhiWK92sAJuC4doe+nFKuVIzmQOBmmAXgRKvlL04g/MMim/LH/irf72RsLLfe4f6f0ONVcFrn1s6HRLeCbUtVuNuxxE96fDi5fBo5OzcQ48P3SMj3WM1DBQbwkOGQZSeLStEr4QWZsDryxge9+K4aTuME9AGZGKsxYFJ18yDuD+oBhPsjUzaAVgFsgAlut8rvJ5z+mJZqFWuZ/LUmP9BG59PFy/hyWJOOeJfhdUGTl6UAFCVUl8vDQjzlhSaJOzk2+c/waMQk37Qe+rQh3ddrl8OGgD7JsmA2L1DLo5Tr4pEEG7LxjuTTRAL0WFOmolgXSlUhKyQ8y6KLEpZpW6vSg/05hGtiV7FAkcbu86RVT8GMz1WO0xXIzqTxfrSzpfo7IL2jIYZg1AjpMDdgTu83wSLSwBRboAdZV/wrxKcLABc9MkrN4fgP12NydD+Sj08uEuU0I2J3vOxcZ05w== NomUtilisateur@NomHote
    
Copier cette clé publique et l'ajouter comme nouvelle clé sur la page suivante: https://github.com/settings/ssh

### 3. Cloner le depôt Git

    $ mkdir ~/Git
    $ cd ~/Git
    $ git clone git clone git@github.com:oiraMm/ProjetCarPark.git 
    $ cd Code

### 4. Faire ses modifications dans le dossier `~/Git/ProjetCarPark`

### 5. Ajouter les modification au depôt Git

    $ cd ~/Git/ProjetCarPark
    $ git add -A
    
    $ git commit -m "Message court expliquant les modifications"
    [master 654ff6d] Message court expliquant les modifications
    1 file changed, 115 deletions(-)
    delete mode 100644 test.sh

    $ git push origin master 
    Décompte des objets: 4, fait.
    Écriture des objets: 100% (4/4), 278 bytes | 0 bytes/s, fait.
    Total 4 (delta 0), reused 0 (delta 0)
    To git@github.com:oiraMm/ProjetCarPark.git
    * [new branch]      master -> master


