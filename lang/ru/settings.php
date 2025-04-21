<?php

/**
 * @license    GPL 2 (https://www.gnu.org/licenses/gpl.html)
 *
 * @author Impeck <impeck@ya.ru>
 */
$lang['create_private_ns']     = 'Создать приватный namespace пользователя (проверьте все настройки перед включением)?';
$lang['use_name_string']       = 'Использовать полное имя пользователя вместо логина для приватного namespace.';
$lang['use_start_page']        = 'Использовать имя стартовой страницы вики для стартовой страницы каждого приватного namespace (иначе будет использовано имя приватного namespace).';
$lang['users_namespace']       = 'Namespace, под которым создаются пользовательские namespace.';
$lang['group_by_name']         = 'Группировать namespace пользователей по первой букве имени?';
$lang['edit_before_create']    = 'Разрешить пользователям редактировать стартовую страницу их приватного namespace при создании (работает, только если публичная страница не создается одновременно).';
$lang['acl_all_private']       = 'Права для группы @ALL в приватных namespace';
$lang['acl_all_private_o_0']   = 'Нет (по умолчанию)';
$lang['acl_all_private_o_1']   = 'Чтение';
$lang['acl_all_private_o_2']   = 'Редактирование';
$lang['acl_all_private_o_4']   = 'Создание';
$lang['acl_all_private_o_8']   = 'Загрузка';
$lang['acl_all_private_o_16']  = 'Удаление';
$lang['acl_all_private_o_noacl'] = 'Без авто ACL';
$lang['acl_user_private']      = 'Права для группы @user в приватных namespace';
$lang['acl_user_private_o_0']  = 'Нет (по умолчанию)';
$lang['acl_user_private_o_1']  = 'Чтение';
$lang['acl_user_private_o_2']  = 'Редактирование';
$lang['acl_user_private_o_4']  = 'Создание';
$lang['acl_user_private_o_8']  = 'Загрузка';
$lang['acl_user_private_o_16'] = 'Удаление';
$lang['acl_user_private_o_noacl'] = 'Без автоматических ACL';
$lang['groups_private']        = 'Список групп пользователей, разделённых запятыми, для которых создаётся личное пространство имён (оставьте пустым, чтобы применить настройки ко всем пользователям).';
$lang['create_public_page']    = 'Создавать публичную страницу пользователя?';
$lang['public_pages_ns']       = 'Пространство имён, в котором создаются публичные страницы.';
$lang['acl_all_public']        = 'Права для группы @ALL на публичных страницах';
$lang['acl_all_public_o_0']    = 'Нет';
$lang['acl_all_public_o_1']    = 'Чтение (по умолчанию)';
$lang['acl_all_public_o_2']    = 'Редактирование';
$lang['acl_all_public_o_noacl'] = 'Без авто настройки ACL';
$lang['acl_user_public']       = 'Права для группы @user на публичных страницах:';
$lang['acl_user_public_o_0']   = 'Нет';
$lang['acl_user_public_o_1']   = 'Чтение (по умолчанию)';
$lang['acl_user_public_o_2']   = 'Редактирование';
$lang['acl_user_public_o_noacl'] = 'Без авто настройки ACL';
$lang['groups_public']         = 'Список групп пользователей, разделённых запятыми, для которых создаются публичные страницы (оставьте пустым, чтобы применить настройки ко всем пользователям).';
$lang['templates_path']        = 'Относительный путь от [<code>savedir</code>] для хранения шаблонов (userhomepage_private.txt и userhomepage_public.txt). Примеры: <code>./pages/user</code> или <code>../lib/plugins/userhomepage</code>.';
$lang['templatepath']          = 'Путь к шаблону с версии 3.0.4. Если файл существует, он будет использован как источник для стартовой страницы личного пространства имён (очистите путь, если не хотите использовать).';
$lang['acl_all_templates']     = 'Права для группы @ALL на шаблоны (если они хранятся в <code>data/pages...</code>):';
$lang['acl_all_templates_o_0'] = 'Нет';
$lang['acl_all_templates_o_1'] = 'Чтение (по умолчанию)';
$lang['acl_all_templates_o_2'] = 'Редактирование';
$lang['acl_all_templates_o_noacl'] = 'Без авто настройки ACL';
$lang['acl_user_templates']    = 'Права для группы @user на шаблоны (если они хранятся в <code>data/pages...</code>):';
$lang['acl_user_templates_o_0'] = 'Нет';
$lang['acl_user_templates_o_1'] = 'Чтение';
$lang['acl_user_templates_o_2'] = 'Редактирование';
$lang['acl_user_templates_o_noacl'] = 'Без авто настройки ACL';
$lang['no_acl']                = 'Отключить авто настройку ACL, но созданные ранее нужно удалить вручную. Не забудьте настроить ACL для шаблонов.';
$lang['redirection']           = 'Включить перенаправление (даже если отключено, оно всё равно произойдёт при создании страниц).';
$lang['action']                = 'Действие при первом перенаправлении на публичную страницу после её создания (или на стартовую страницу личного пространства имён).';
$lang['action_o_edit']         = 'Редактирование (по умолчанию)';
$lang['action_o_show']         = 'Показать';
$lang['userlink_replace']      = 'Включить замену интервики-ссылки [<code>Вошёл как</code>] в зависимости от страниц, созданных Userhomepage (работает только если параметр <code>showuseras</code> установлен как интервики-ссылка).';
$lang['userlink_classes']      = 'Разделённый пробелами список CSS-классов, применяемых к интервики-ссылкам [<code>Вошёл как</code>] (по умолчанию: <code>interwiki iw_user</code>).';
$lang['userlink_icons']        = 'Использовать устаревшие иконки в формате PNG или современные в формате SVG в интервики-ссылках (по умолчанию: <code>png</code>).';
