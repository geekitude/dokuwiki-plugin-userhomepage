<?php
/**
 * English settings file for Userhomepage plugin
 * Previous authors: James GuanFeng Lin, Mikhail I. Izmestev, Daniel Stonier
 * @author: Simon Delage <simon.geekitude@gmail.com>
 * @license: CC Attribution-Share Alike 3.0 Unported <http://creativecommons.org/licenses/by-sa/3.0/>
 */

    $lang['create_private_ns'] = 'Créer les espaces privés des utilisateurs (vérifier soigneusement toutes les options avant l\'activation)';
    $lang['use_name_string'] = 'Utiliser le nom complet de l\'utilisateurs au lieu du login pour son espace privé (activer cette option empêchera l\'utilisation du joker <code>%USER%</code> au niveau de l\'ACL qui sera plus complexe).';
    $lang['use_start_page'] = 'Utiliser le nom de page d\'accueil du wiki pour celle de chaque espace privé (sinon le nom de l\'espace privé sera utilisé).';
    $lang['users_namespace'] = 'Espace de nom sous lequel créer les espaces privés des utilisateurs (peut-être n\'importe quel espace à part <code>user</code> sans perturber le comportement par défaut de DokuWiki).';
    $lang['set_permissions'] = 'Configurer automatiquement les droits d\'accès à l\'espace choisit ci-dessus et donner tous les droits aux utilisateurs sur leur espace privé réspectif.';
    $lang['set_permissions_others'] = 'Si l\'option [set_permissions] est activée, quels droits donner aux autres (groupes <code>@ALL</code> et <code>@user</code>) ?';
    $lang['set_permissions_others_o_0'] = 'Aucun';
    $lang['set_permissions_others_o_1'] = 'Lecture';
    $lang['set_permissions_others_o_2'] = 'Écriture';
    $lang['set_permissions_others_o_4'] = 'Création';
    $lang['set_permissions_others_o_8'] = 'Envoyer';
    $lang['set_permissions_others_o_16'] = 'Effacer';
    $lang['group_by_name'] = 'Grouper les espaces privés des utilisateurs par la première lettre de leur nom ?';
    $lang['edit_before_create'] = 'Permettre aux utilisateurs d\'éditer la page d\'accueil de leur espace privé à sa création (fonctionnera uniquement si une page publique n\'est pas créée en même temps).';
    $lang['create_public_page'] = 'Créer une page publique pour chaque utilisateur (vérifier soigneusement toutes les options avant l\'activation)';
    $lang['public_pages_ns'] = 'Espace de nom sous lequel créer les pages publiques. Si une valeur autre que <code>user</code> est choisie, il faudra manuellement gérer les liens générés par l\'option  <code>showuseras</code> (dans les [Paramètres d\'affichage]).';
    $lang['set_permissions_public'] = 'Automatiquement configurer les droits d\'accès aux pages publiques (lecture seule pour <code>@ALL</code> et <code>@user</code> mais écriture pour chaque utilisateur sur sa propre page publique).';
    $lang['templates_path'] = 'Chemin où les modèles seront stockés (userhomepage_private.txt et userhomepage_public.txt). Examples: <code>data/pages/wiki</code> (qui permettra d\'éditer les modèles depuis le wiki) ou <code>lib/plugins/userhomepage</code> (utile pour centraliser les modèles dans une ferme de wikis).';
    $lang['templatepath'] = 'Chemin vers le modèle de la version 3.0.4 si elle était installée précédement. Cette option n\'est là que pour permettre la rétro-compatibilité. Si le fichier existe, il sera utilisé comme source pour le modèle des pages d\'accueil des espaces privés (videz le chemin si vous ne le voulez pas).';
