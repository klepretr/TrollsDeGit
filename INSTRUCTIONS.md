## Prérequis

Vous devez impérativement installer les composants suivants pour pouvoir utiliser la VM de développement :

* [VirtualBox](https://www.virtualbox.org/wiki/Downloads) à installer en premier
* [Vagrant](https://www.vagrantup.com/downloads.html) ensuite

Pensez à bien redémarrer votre machine avant de continuer.

## Installation

Tout d'abord, il faut télécharger les fichiers de la box homestead.  
Attention, en focntion de votre réseau, cette commande peut prendre un certain temps...

```
vagrant box add laravel/homestead
```

Ensuite, créer un dossier dédié à la VM et éxécuter les commandes suivantes
```
git clone https://github.com/laravel/homestead.git
```
Se placer dans le dossier créé
```
cd homestead
```
Puis initialiser les fichiers de configuration
```
Linux :
bash init.sh

Windows :
init.bat
```
Vous devrez vérifier que le fichier Homestead.yaml a bien été créé avant depasser à la suite.

## Configuration

Pour pouvoir éditer le code depuis la machine hôte et l'éxécuter sur la VM, il va falloir mettre en place un dossier partagé. Pour cela, il faut éditer la fichier Homestead.yaml et remplir le champ folders comme ceci :
```
Linux :
folders:
    - map: /home/username/shared_folder     <-- machine hôte
      to: /home/vagrant/shared_folder       <-- VM

Windows :
folders:
    - map: C:/Users/Username/Desktop/shared_folder      <-- machine hôte
      to: /home/vagrant/shared_folder                   <-- VM
```
Evidemment, vous pouvez nommer et placer ces dossiers comme vous voulez.

Pour l'instant, c'est le seul paramètre qu'il est nécessaire de changer. Avant de lancer la VM, il va donc falloir commenter les autres lignes du fichier Homestead.yaml de manière à ne garder que les paramètres suivants :
* ip
* memory
* cpus
* provider
* authorize
* keys
* folders

## Lancement et connexion

A partir de là, il suffit d'éxécuter la commande suivante pour lancer la VM :
```
vagrant up
```
Si tout s'est bien passé, il ne reste plus qu'a éxécuter cette commande pour s'y connecter :
```
vagrant ssh
```
Vérifier que le dossier partagé mis en place précédemment est bien présent, et si c'est le cas :bravo, tu es prêt pour la Nuit De l'Info !

On n'oubliera pas de correctement étéindre la VM si la machine hôte doit être éteinte/redémarrée. Pour cela il suffit de faire cette commande :
```
vagrant destroy
```
