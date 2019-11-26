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
define('_MI_XMCONTACT_MENU_CATEGORY', 'Catégories');
define('_MI_XMCONTACT_MENU_CATEGORY_DESC', 'Liste des catégories');
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
define('_MI_XMCONTACT_PREF_COLUMNCAT', 'Nombre de colonnes pour l\'affichage des catégories');
define('_MI_XMCONTACT_PREF_COLUMNCAT_DESC', 'Les catégories peuvent êre affichées en : 1, 2 ou 3 colonnes');
define('_MI_XMCONTACT_PREF_HEADER', 'Haut de page sur l\'index du module');
define('_MI_XMCONTACT_PREF_HEADER_DESC', 'Utiliser du code HTML pour la mise en page');
define('_MI_XMCONTACT_PREF_FOOTER', 'Pied de page du formulaire de contact');
define('_MI_XMCONTACT_PREF_FOOTER_DESC', 'Utiliser du code HTML pour la mise en page');
define('_MI_XMCONTACT_PREF_ADDRESSE', 'Adresse vers l\'index du module');
define('_MI_XMCONTACT_PREF_ADDRESSE_DESC', 'Utiliser du code HTML pour la mise en page');
define('_MI_XMCONTACT_PREF_GOOGLEMAPS', 'Utiliser une carte Google map');
define('_MI_XMCONTACT_PREF_GOOGLEMAPS_DESC', "Intégrer l'iframe Google map <br />changez l'iframe avec width à '100%'");
define('_MI_XMCONTACT_PREF_NOTIFICATION', 'Activer la notification par courriel');
define('_MI_XMCONTACT_PREF_NOTIFICATION_DESC', 'À chaque demande de contact, un courriel informe le responsable de la catégorie concernée qu\'il a reçu une demande de contact');
define('_MI_XMCONTACT_PREF_HEAD_ADMIN', "<span style='font-weight: bold;'>Administration</span>");
define('_MI_XMCONTACT_PREF_EDITOR', 'Éditeur de texte');
define('_MI_XMCONTACT_PREF_ITEMPERPAGE', 'Nombre d\'entrées affichées sur les pages de l\'administration');

//new version 1.0
define('_MI_XMCONTACT_PREF_HEAD_SIMPLECONTACT', 'Options valides si le module est utilisé sans catégories de contact (un seul formulaire de contact)');
define('_MI_XMCONTACT_PREF_SP_DESC', 'Valable uniquement si le module est utilisé sans catégorie de contact (Un seul formulaire de contact)');
define('_MI_XMCONTACT_PREF_DOCIVILITY', 'Voir la civilité');
define('_MI_XMCONTACT_PREF_RECIVILITY', 'Civilité obligatoire');
define('_MI_XMCONTACT_PREF_DONAME', 'Voir nom');
define('_MI_XMCONTACT_PREF_RENAME', 'Nom obligatoire');
define('_MI_XMCONTACT_PREF_DOPHONE', 'Voir le numéro de téléphone');
define('_MI_XMCONTACT_PREF_REPHONE', 'Numéro de téléphone obligatoire');
define('_MI_XMCONTACT_PREF_DOSUBJECT', 'Voir le suject');
define('_MI_XMCONTACT_PREF_RESUBJECT', 'Suject obligatoire');
define('_MI_XMCONTACT_PREF_DOADDRESS', 'Voir l\'adresse');
define('_MI_XMCONTACT_PREF_READDRESS', 'Adresse obligatoire');
define('_MI_XMCONTACT_PREF_DOURL', 'Voir l\'url');
define('_MI_XMCONTACT_PREF_REURL', 'Url obligatoire');