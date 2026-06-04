<?php

/**
 * @license    GPL 2 (https://www.gnu.org/licenses/gpl.html)
 *
 * @author Wizzard <wizzardsk@gmail.com>
 */
$lang['create_private_ns']     = 'Vytvárať súkromný menný priestor používateľa (pred zapnutím dôkladne skontrolujte všetky voľby)?';
$lang['use_name_string']       = 'Použiť celé meno používateľa namiesto loginu pre jeho súkromný menný priestor.';
$lang['use_start_page']        = 'Použiť názov štartovacej stránky wiki pre štartovaciu stránku každého súkromného menného priestoru (inak sa použije názov súkromného menného priestoru).';
$lang['users_namespace']       = 'Menný priestor, pod ktorým sa vytvárajú menné priestory používateľov.';
$lang['group_by_name']         = 'Zoskupovať menné priestory používateľov podľa prvého znaku používateľského mena?';
$lang['edit_before_create']    = 'Povoliť používateľom upraviť štartovaciu stránku ich súkromného menného priestoru pri vytvorení (funguje iba ak sa zároveň negeneruje verejná stránka).';
$lang['acl_all_private']       = 'Oprávnenia skupiny @ALL na súkromné menné priestory';
$lang['acl_all_private_o_0']   = 'Žiadne (predvolené)';
$lang['acl_all_private_o_1']   = 'Čítanie';
$lang['acl_all_private_o_2']   = 'Úprava';
$lang['acl_all_private_o_4']   = 'Vytváranie';
$lang['acl_all_private_o_8']   = 'Nahrávanie';
$lang['acl_all_private_o_16']  = 'Odstraňovanie';
$lang['acl_all_private_o_noacl'] = 'Žiadne automatické ACL';
$lang['acl_user_private']      = 'Oprávnenia skupiny @user na súkromné menné priestory';
$lang['acl_user_private_o_0']  = 'Žiadne (predvolené)';
$lang['acl_user_private_o_1']  = 'Čítanie';
$lang['acl_user_private_o_2']  = 'Úprava';
$lang['acl_user_private_o_4']  = 'Vytváranie';
$lang['acl_user_private_o_8']  = 'Nahrávanie';
$lang['acl_user_private_o_16'] = 'Odstraňovanie';
$lang['acl_user_private_o_noacl'] = 'Žiadne automatické ACL';
$lang['groups_private']        = 'Čiarkami oddelený zoznam skupín používateľov, ktorých sa týka vytváranie súkromného menného priestoru (prázdne = vyššie uvedené nastavenia platia pre všetkých).';
$lang['create_public_page']    = 'Vytvárať verejnú stránku používateľa?';
$lang['public_pages_ns']       = 'Menný priestor, pod ktorým sa vytvárajú verejné stránky.';
$lang['acl_all_public']        = 'Oprávnenia skupiny @ALL na verejné stránky';
$lang['acl_all_public_o_0']    = 'Žiadne';
$lang['acl_all_public_o_1']    = 'Čítanie (predvolené)';
$lang['acl_all_public_o_2']    = 'Úprava';
$lang['acl_all_public_o_noacl'] = 'Žiadne automatické ACL';
$lang['acl_user_public']       = 'Oprávnenia skupiny @user na verejné stránky';
$lang['acl_user_public_o_0']   = 'Žiadne';
$lang['acl_user_public_o_1']   = 'Čítanie (predvolené)';
$lang['acl_user_public_o_2']   = 'Úprava';
$lang['acl_user_public_o_noacl'] = 'Žiadne automatické ACL';
$lang['groups_public']         = 'Čiarkami oddelený zoznam skupín používateľov, ktorých sa týka vytváranie verejnej stránky (prázdne = vyššie uvedené nastavenia platia pre všetkých).';
$lang['templates_path']        = 'Relatívna cesta od [<code>savedir</code>], kde budú uložené šablóny (userhomepage_private.txt a userhomepage_public.txt). Príklady: <code>./pages/user</code> alebo <code>../lib/plugins/userhomepage</code>.';
$lang['templatepath']          = 'Cesta šablóny od verzie 3.0.4. Ak tento súbor existuje, použije sa ako predvolený zdroj šablóny štartovacej stránky nového súkromného menného priestoru (ak to nechcete, cestu vymažte).';
$lang['acl_all_templates']     = 'Oprávnenia skupiny @ALL na šablóny (ak sú uložené v <code>data/pages...</code>)';
$lang['acl_all_templates_o_0'] = 'Žiadne';
$lang['acl_all_templates_o_1'] = 'Čítanie (predvolené)';
$lang['acl_all_templates_o_2'] = 'Úprava';
$lang['acl_all_templates_o_noacl'] = 'Žiadne automatické ACL';
$lang['acl_user_templates']    = 'Oprávnenia skupiny @user na šablóny (ak sú uložené v <code>data/pages...</code>)';
$lang['acl_user_templates_o_0'] = 'Žiadne';
$lang['acl_user_templates_o_1'] = 'Čítanie (predvolené)';
$lang['acl_user_templates_o_2'] = 'Úprava';
$lang['acl_user_templates_o_noacl'] = 'Žiadne automatické ACL';
$lang['no_acl']                = 'Žiadne automatické nastavovanie ACL, ale doteraz vytvorené budete musieť odstrániť manuálne. Nezabudnite nastaviť ACL na šablóny.';
$lang['redirection']           = 'Povoliť presmerovanie (aj keď je vypnuté, pri vytváraní stránok k nemu stále dôjde).';
$lang['action']                = 'Akcia pri prvom presmerovaní na verejnú stránku po jej vytvorení (alebo na štartovaciu stránku súkromného menného priestoru).';
$lang['action_o_edit']         = 'Upraviť (predvolené)';
$lang['action_o_show']         = 'Zobraziť';
$lang['userlink_replace']      = 'Povoliť nahradenie interwiki odkazu [<code>Prihlásený ako</code>] podľa stránok vytvorených pluginom Userhomepage (funguje iba ak je voľba <code>showuseras</code> nastavená na interwiki odkaz).';
$lang['userlink_classes']      = 'Medzerami oddelený zoznam CSS tried aplikovaných na interwiki odkazy [<code>Prihlásený ako</code>] (predvolené: <code>interwiki iw_user</code>).';
$lang['userlink_icons']        = 'Použiť staré png alebo moderné svg obrázky ako ikony interwiki odkazov (predvolené: <code>png</code>).';
$lang['userlink_fa']           = 'Použiť Fontawesome ikony namiesto obrázkov (Fontawesome musí byť nainštalované šablónou alebo pluginom)?';
