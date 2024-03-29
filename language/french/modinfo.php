<?php
/*
 You may not change or alter any portion of this comment or credits
 of supporting developers from this source code or any supporting source code
 which is considered copyrighted (c) material of the original comment or credit authors.

 This program is distributed in the hope that it will be useful,
 but WITHOUT ANY WARRANTY; without even the implied warranty of
 MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
*/

/**
 * xmcontact module
 *
 * @copyright       XOOPS Project (https://xoops.org)
 * @license         GNU GPL 2 (http://www.gnu.org/licenses/old-licenses/gpl-2.0.html)
 * @author          Mage Gregory (AKA Mage)
 */
// The name of this module
define('_MI_XMCONTACT_NAME', 'Nous contacter');
define('_MI_XMCONTACT_DESC', 'Module de contact');

// Admin menu
define('_MI_XMCONTACT_MENU_HOME', 'Accueil');
define('_MI_XMCONTACT_MENU_HOME_DESC', 'Retour à la page d\'accueil');
define('_MI_XMCONTACT_MENU_CATEGORY', 'Formulaires');
define('_MI_XMCONTACT_MENU_CATEGORY_DESC', 'Liste des formulaires');
define('_MI_XMCONTACT_MENU_REQUEST', 'Demandes');
define('_MI_XMCONTACT_MENU_REQUEST_DESC', 'Liste de demandes');
define('_MI_XMCONTACT_MENU_ABOUT', 'À propos');
define('_MI_XMCONTACT_MENU_ABOUT_DESC', 'À propos de ce module"');
define('_MI_XMCONTACT_MENU_HELP', 'Aide');
define('_MI_XMCONTACT_MENU_HELP_DESC', 'Aide du module');
// Blocks
define('_MI_XMCONTACT_BLOCK_CONTACT', 'Contact');
define('_MI_XMCONTACT_BLOCK_CONTACT_DESC', 'Block de contact');
// Pref.
define('_MI_XMCONTACT_PREF_HEAD_INFORMATION', "<span style='font-weight: bold;'>Informations</span>");
define('_MI_XMCONTACT_PREF_CAPTCHA', 'Utiliser Captcha ?');
define('_MI_XMCONTACT_PREF_CAPTCHA_DESC', 'Sélectionnez Oui pour utiliser Captcha dans le formulaire de contact');
define('_MI_XMCONTACT_PREF_COLUMNCAT', 'Nombre de colonnes pour l\'affichage des formulaires');
define('_MI_XMCONTACT_PREF_COLUMNCAT_DESC', 'Les formulaires peuvent êre affichées en : 1, 2 ou 3 colonnes');
define('_MI_XMCONTACT_PREF_HEADER', 'Haut de page sur l\'index du module');
define('_MI_XMCONTACT_PREF_HEADER_DESC', 'Utilisez du code HTML pour la mise en page');
define('_MI_XMCONTACT_PREF_FOOTER', 'Pied de page du formulaire de contact');
define('_MI_XMCONTACT_PREF_FOOTER_DESC', 'Utilisez du code HTML pour la mise en page');
define('_MI_XMCONTACT_PREF_ADDRESSE', 'Adresse vers l\'index du module');
define('_MI_XMCONTACT_PREF_ADDRESSE_DESC', 'Utilisez du code HTML pour la mise en page');
define('_MI_XMCONTACT_PREF_GOOGLEMAPS', 'Utiliser une carte Google map');
define('_MI_XMCONTACT_PREF_GOOGLEMAPS_DESC', "Intégrez l'iframe Google map <br />Changez l'iframe avec width à '100%'");
define('_MI_XMCONTACT_PREF_NOTIFICATION', 'Activer la notification par courriel');
define('_MI_XMCONTACT_PREF_NOTIFICATION_DESC', 'À chaque demande de contact, un courriel informe le responsable du formulaire concerné qu\'il a reçu une demande de contact');
define('_MI_XMCONTACT_PREF_HEAD_ADMIN', "<span style='font-weight: bold;'>Administration</span>");
define('_MI_XMCONTACT_PREF_EDITOR', 'Éditeur de texte');
define('_MI_XMCONTACT_PREF_ITEMPERPAGE', 'Nombre d\'entrées affichées sur les pages de l\'administration');

//new version 1.0
define('_MI_XMCONTACT_PREF_HEAD_SIMPLECONTACT', 'Options valides si le module est utilisé avec un formulaire unique');
define('_MI_XMCONTACT_PREF_SP_DESC', 'Valable seulement si le module est utilisé avec un formulaire unique');
define('_MI_XMCONTACT_PREF_DOCIVILITY', 'Afficher la civilité');
define('_MI_XMCONTACT_PREF_RECIVILITY', 'Civilité obligatoire');
define('_MI_XMCONTACT_PREF_DONAME', 'Afficher le nom');
define('_MI_XMCONTACT_PREF_RENAME', 'Nom obligatoire');
define('_MI_XMCONTACT_PREF_DOPHONE', 'Afficher le numéro de téléphone');
define('_MI_XMCONTACT_PREF_REPHONE', 'Numéro de téléphone obligatoire');
define('_MI_XMCONTACT_PREF_DOSUBJECT', 'Afficher le sujet');
define('_MI_XMCONTACT_PREF_RESUBJECT', 'Sujet obligatoire');
define('_MI_XMCONTACT_PREF_DOADDRESS', 'Afficher l\'adresse');
define('_MI_XMCONTACT_PREF_READDRESS', 'Adresse obligatoire');
define('_MI_XMCONTACT_PREF_DOURL', 'Afficher le lien');
define('_MI_XMCONTACT_PREF_REURL', 'Lien obligatoire');

//new version 2.0
define('_MI_XMCONTACT_PREF_ANSWER', 'Utiliser le gestionnaire de réponses enregistrées');
define('_MI_XMCONTACT_PREF_ANSWER_DESC', 'Ce gestionnaire permet d\'enregistrer des modèles de réponses et de les utiliser');
define('_MI_XMCONTACT_PREF_CONFIRM', 'Utiliser la page de confirmation d\'envoi?');
define('_MI_XMCONTACT_PREF_CONFIRM_DESC', 'Cette page donne des informations sur l\'envoi du message');
define('_MI_XMCONTACT_PREF_SIGNATURE', 'Signature');
define('_MI_XMCONTACT_PREF_SIGNATURE_DESC', 'Cette signature sera utilisée pour les formulaire simple et par défaut pour les multiples formulaires');
define('_MI_XMCONTACT_PREF_SIMPLECONTACT', 'Utilisez uniquement un simple formulaire de contact');
define('_MI_XMCONTACT_PREF_SIMPLECONTACT_DESC', 'Si vous désirez utiliser plusieurs formulaires, il est nécessaire de mettre cette option sur "non"');
define('_MI_XMCONTACT_BLOCK_CONTACTFORM', 'Formulaire de contact');
define('_MI_XMCONTACT_BLOCK_CONTACTFORM_DESC', 'Block avec formulaire de contact');
define('_AM_XMCONTACT_CATEGORY_SIGNATURE', 'Signature');
define('_MI_XMCONTACT_MENU_ANSWER', 'Réponses types');
define('_MI_XMCONTACT_MENU_ANSWER_DESC', 'Liste des réponses types');
