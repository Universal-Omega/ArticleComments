<?php
/**
 * Article Comments extension message file
 *
 * Also be aware that many oasis specific i18n messages for comments
 * reside in extensions/wikia/Oasis/Oasis.i18n.php
 */

$messages = array();
$messages['en'] = array(
	'article-comments-anonymous' => 'Anonymous user',
	'article-comments-comments' => 'Comments ($1)',
	'article-comments-post' => 'Post comment',
	'article-comments-cancel' => 'Cancel',
	'article-comments-delete' => 'delete',
	'article-comments-edit' => 'edit',
	'article-comments-history' => 'history',
	'article-comments-error' => 'Comment could not be saved',
	'article-comments-undeleted-comment' => 'Undeleted comment for blog page $1',
	'article-comments-rc-comment' => 'Article comment ([[$1]])',
	'article-comments-rc-comments' => 'Article comments ([[$1]])',
	'article-comments-fblogin' => 'Please <a href="$1" rel="nofollow">log in and connect with Facebook</a> to post a comment on this wiki!',
	'article-comments-fbconnect' => 'Please <a href="$1">connect this account with Facebook</a> to comment!',
	'article-comments-rc-blog-comment' => 'Blog comment ([[$1]])',
	'article-comments-rc-blog-comments' => 'Blog comments ([[$1]])',
	'article-comments-login' => 'Please <a href="$1">log in</a> to post a comment on this wiki.',
	'article-comments-toc-item' => 'Comments',
	'article-comments-comment-cannot-add' => 'You cannot add a comment to the article.',
	'article-comments-reply' => 'Reply',
	'article-comments-show-all' => 'Show all comments',
	'article-comments-prev-page' => 'Prev',
	'article-comments-next-page' => 'Next',
	'article-comments-page-spacer' => '&#160...&#160',
	'article-comments-delete-reason' => 'The parent article / parent comment has been deleted.',
	'article-comments-empty-comment' => "You can't post an empty comment. <a href='$1'>Delete it instead?</a>",
	'enotif_subject_article_comment' => '$PAGEEDITOR has commented on "$PAGETITLE" on {{SITENAME}}',
	'enotif_body_article_comment' => 'Dear $WATCHINGUSERNAME,

$PAGEEDITOR made a comment on "$PAGETITLE". 

To see the comment thread, follow the link below:
$PAGETITLE_URL 

Please visit and edit often...

Wikia',
	'enotif_body_article_comment-HTML' => '<p>Dear $WATCHINGUSERNAME,
<br /><br />
$PAGEEDITOR made a comment on "$PAGETITLE".
<br /><br />
To see the comment thread, follow this link: <a href="$PAGETITLE_URL">$PAGETITLE</a> 
<br /><br />
Please visit and edit often...
<br /><br />
Wikia
<br /><hr />
<ul>
<li>Want to control which emails you receive? <a href="{{fullurl:Special:Preferences}}">Update your Preferences<a>.</li>
</ul>
</p>',
);

/** Afrikaans (Afrikaans)
 * @author Naudefj
 */
$messages['af'] = array(
	'article-comments-anonymous' => 'Anonieme gebruiker',
	'article-comments-comments' => 'Opmerkings ($1)',
	'article-comments-post' => 'Pos kommentaar',
	'article-comments-delete' => 'skrap',
	'article-comments-edit' => 'wysig',
	'article-comments-history' => 'geskiedenis',
	'article-comments-reply' => 'Antwoord',
	'article-comments-show-all' => 'Wys alle kommentaar',
	'article-comments-prev-page' => 'Vorige',
	'article-comments-next-page' => 'Volgende',
	'article-comments-page-spacer' => '&#160...&#160',
);

/** Arabic (العربية)
 * @author OsamaK
 */
$messages['ar'] = array(
	'article-comments-anonymous' => 'مستخدم مجهول',
	'article-comments-comments' => 'التعليقات ($1)',
	'article-comments-post' => 'أرسل تعليقا',
	'article-comments-delete' => 'احذف',
	'article-comments-edit' => 'عدّل',
	'article-comments-history' => 'التاريخ',
	'article-comments-error' => 'تعذّر حفظ التعليق',
);

/** Azerbaijani (Azərbaycanca)
 * @author Cekli829
 */
$messages['az'] = array(
	'article-comments-delete' => 'sil',
	'article-comments-edit' => 'redaktə',
	'article-comments-history' => 'Tarix',
	'article-comments-next-page' => 'Növbəti',
);

/** Bulgarian (Български)
 * @author DCLXVI
 */
$messages['bg'] = array(
	'article-comments-anonymous' => 'Анонимен потребител',
	'article-comments-comments' => 'Коментари ($1)',
	'article-comments-delete' => 'изтриване',
	'article-comments-edit' => 'редактиране',
	'article-comments-history' => 'история',
	'article-comments-toc-item' => 'Коментари',
	'article-comments-reply' => 'Отговор',
	'article-comments-show-all' => 'Показване на всички коментари',
);

/** Breton (Brezhoneg)
 * @author Fulup
 */
$messages['br'] = array(
	'article-comments-anonymous' => 'Implijer dizanv',
	'article-comments-comments' => 'Evezhiadennoù - $1',
	'article-comments-post' => 'Lakaat un evezhiadenn',
	'article-comments-delete' => 'diverkañ',
	'article-comments-edit' => 'kemmañ',
	'article-comments-history' => 'istor',
	'article-comments-error' => "N'eus ket bet gellet enrollañ an evezhiadenn",
	'article-comments-undeleted-comment' => 'Diziverket eo bet an evezhiadenn evit pajenn ar blog $1',
	'article-comments-rc-comment' => 'Evezhiadenn war pajenn ([[$1]])',
	'article-comments-rc-comments' => 'Evezhiadennoù war pajenn ([[$1]])',
	'article-comments-fblogin' => '<a href="$1">Kevreañ dre Facebook ha bezañ liammet outañ</a> evit lakaat un evezhiadenn war ar wiki-mañ !',
	'article-comments-fbconnect' => '<a href="$1">Liammit ar gont-mañ ouzh Facebook</a> evit lakaat evezhiadennoù !',
	'article-comments-rc-blog-comment' => 'Evezhiadenn war ar blog ([[$1]])',
	'article-comments-rc-blog-comments' => 'Evezhiadennoù war ar blog ([[$1]])',
	'article-comments-login' => '<a href="$1">Ret eo kevreañ</a> evit lezel ur gemennadenn war ar wiki-mañ.',
	'article-comments-toc-item' => 'Evezhiadennoù',
	'article-comments-comment-cannot-add' => "N'hallit ket lakaat un evezhiadenn war ar pennad-mañ.",
	'article-comments-reply' => 'Respont',
	'article-comments-show-all' => 'Diskouez an holl evezhiadennoù',
	'article-comments-prev-page' => 'Kent',
	'article-comments-next-page' => "War-lerc'h",
	'article-comments-page-spacer' => '&#160...&#160',
	'article-comments-delete-reason' => 'Diverket eo bet ar bajenn kar / an evezhiadenn kar.',
	'article-comments-empty-comment' => "N'hallit ket degas un evezhiadenn c'houllo. <a href='$1'>Diverkañ anezhi ?</a>",
	'enotif_subject_article_comment' => 'Un evezhiadenn zo bet graet gant $PAGEEDITOR diwar-benn "$PAGETITLE" war {{SITENAME}}',
	'enotif_body_article_comment' => '$WATCHINGUSERNAME ker,

Graet ez eus bet un evezhiadenn gant $PAGEEDITOR war "$PAGETITLE". 

Evit sellet ouzh an neudennad, klikit war al liamm a-is :
$PAGETITLE_URL 

Trugarez da vont d\'ober un tro ha da gemer perzh ingal...

Wikia',
	'enotif_body_article_comment-HTML' => '<p>$WATCHINGUSERNAME ker,
<br /><br />
Graet ez eus bet un evezhiadenn gant $PAGEEDITOR war "$PAGETITLE".
<br /><br />
Evit sellet ouzh an neudennad, klikit war al liamm-mañ : <a href="$PAGETITLE_URL">$PAGETITLE</a> 
<br /><br />
Trugarez da vont d\'ober un tamm tro ha da gemer perzh ingal...
<br /><br />
Wikia
<br /><hr />
<ul>
<li>Ha c\'hoant hoc\'h eus da chom mestr war ar posteloù a resevit ? <a href="{{fullurl:Special:Preferences}}">Cheñchit ho penndibaboù<a>.</li>
</ul>
</p>',
);

/** Czech (Česky)
 * @author Jkjk
 * @author Mr. Richard Bolla
 */
$messages['cs'] = array(
	'article-comments-anonymous' => 'Anonymní uživatel',
	'article-comments-comments' => 'Komentáře ($1)',
	'article-comments-post' => 'Přidat komentář',
	'article-comments-delete' => 'smazat',
	'article-comments-edit' => 'upravit',
	'article-comments-history' => 'Historie',
	'article-comments-error' => 'Komentář nemohl být uložen',
	'article-comments-rc-comment' => 'Komentář k článku ([[$1]])',
	'article-comments-rc-comments' => 'Komentáře k článku ([[$1]])',
	'article-comments-fblogin' => 'Pro přidávání komentářů na této wiki se prosím <a href="$1">přihlašte a propojte s Facebookem</a>!',
	'article-comments-fbconnect' => 'Pro komentování připojte <a href="$1">váš Facebook účet</a>!',
	'article-comments-reply' => 'Odpovědět',
	'article-comments-show-all' => 'Zobrazit všechny komentáře',
);

/** German (Deutsch)
 * @author Claudia Hattitten
 * @author LWChris
 */
$messages['de'] = array(
	'article-comments-anonymous' => 'Unangemeldeter Benutzer',
	'article-comments-comments' => 'Kommentare ($1)',
	'article-comments-post' => 'Kommentieren',
	'article-comments-delete' => 'löschen',
	'article-comments-edit' => 'bearbeiten',
	'article-comments-history' => 'Versionen',
	'article-comments-error' => 'Kommentar konnte nicht gespeichert werden',
	'article-comments-undeleted-comment' => 'Kommentar zu Blog-Beitrag $1 wiederhergestellt.',
	'article-comments-rc-comment' => 'Artikel Kommentar ([[$1]])',
	'article-comments-rc-comments' => 'Artikel Kommentare ([[$1]])',
	'article-comments-fblogin' => 'Bitte <a href="$1" rel="nofollow">einloggen und mit Facebook verbinden</a>, um einen Kommentar in diesem Wiki zu schreiben!',
	'article-comments-fbconnect' => 'Bitte <a href="$1">dieses Konto mit Facebook verknüpfen</a>, um zu kommentieren!',
	'article-comments-rc-blog-comment' => 'Blog-Kommentar ([[$1]])',
	'article-comments-rc-blog-comments' => 'Blog-Kommentare ([[$1]])',
	'article-comments-login' => 'Zum Kommentieren <a href="$1">anmelden</a>.',
	'article-comments-toc-item' => 'Kommentare',
	'article-comments-comment-cannot-add' => 'Du kannst keinen Kommentar zum Artikel hinzufügen.',
	'article-comments-reply' => 'Antworten',
	'article-comments-show-all' => 'Alle Kommentare anzeigen',
	'article-comments-prev-page' => 'Vorherige',
	'article-comments-next-page' => 'Nächste',
	'article-comments-page-spacer' => '&#160...&#160',
	'article-comments-delete-reason' => 'Der übergeordnete Artikel / übergeordnete Kommentar wurde gelöscht.',
	'article-comments-empty-comment' => 'Ein leerer Kommentar ist nicht möglich. <a href="$1">Stattdessen löschen?</a>',
	'enotif_subject_article_comment' => '$PAGEEDITOR hat "$PAGETITLE" auf {{SITENAME}} kommentiert',
	'enotif_body_article_comment' => 'Hallo $WATCHINGUSERNAME,

$PAGEEDITOR hat einen Kommentar zu "$PAGETITLE" abgegeben.

Um den Kommentar-Thread anzusehen, folge dem unten stehenden Link:
$PAGETITLE_URL

Bitte komm vorbei und bearbeite viel...

Wikia',
	'enotif_body_article_comment-HTML' => '<p>Hallo $WATCHINGUSERNAME,
<br /><br />
$PAGEEDITOR hat einen Kommentar zu "$PAGETITLE" abgegeben.
<br /><br />
Um den Kommentar-Thread anzusehen, folge diesem Link: <a href="$PAGETITLE_URL">$PAGETITLE</a>
<br /><br />
Bitte komm vorbei und bearbeite viel...
<br /><br />
Wikia
<br /><hr />
<ul>
<li>Willst du kontrollieren, welche E-Mails du erhältst? <a href="{{fullurl:Special:Preferences}}">Pass deine Einstellungen an<a>.</li>
</ul>
</p>',
);

/** German (formal address) (‪Deutsch (Sie-Form)‬)
 * @author Claudia Hattitten
 */
$messages['de-formal'] = array(
	'article-comments-comment-cannot-add' => 'Sie können keinen Kommentar zum Artikel hinzufügen.',
	'enotif_body_article_comment' => 'Hallo $WATCHINGUSERNAME,

$PAGEEDITOR hat einen Kommentar zu "$PAGETITLE" abgegeben.

Um den Kommentar-Thread anzusehen, folgen Sie dem unten stehenden Link:
$PAGETITLE_URL

Bitte besuchen und bearbeiten Sie das Wiki bald wieder...

Wikia',
);

/** Greek (Ελληνικά)
 * @author Evropi
 */
$messages['el'] = array(
	'article-comments-comments' => 'Σχόλια ($1)',
	'article-comments-post' => 'Δημοσίευση σχολίου',
	'article-comments-delete' => 'διαγραφή',
	'article-comments-edit' => 'επεξεργασία',
	'article-comments-history' => 'ιστορικό',
	'article-comments-error' => 'Δεν ήταν δυνατή η αποθήκευση του σχολίου',
	'article-comments-rc-comment' => 'Σχόλιο άρθρου ([[$1]])',
	'article-comments-rc-comments' => 'Σχόλια άρθρου ([[$1]])',
	'article-comments-toc-item' => 'Σχόλια',
	'article-comments-comment-cannot-add' => 'Δεν μπορείτε να προσθέσετε σχόλιο για το άρθρο.',
	'article-comments-reply' => 'Απάντηση',
	'article-comments-show-all' => 'Εμφάνιση όλων των σχολίων',
	'article-comments-prev-page' => 'Προηγ',
	'article-comments-next-page' => 'Επόμενο',
	'article-comments-page-spacer' => '&#160...&#160',
	'article-comments-empty-comment' => "Δεν μπορείτε να δημοσιεύσετε ένα κενό σχόλιο. <a href='$1'>Θέλετε να το διαγράψτε αυτό αντ' αυτού;</a>",
);

/** Esperanto (Esperanto)
 * @author Tradukisto
 */
$messages['eo'] = array(
	'article-comments-edit' => 'redakti',
	'article-comments-toc-item' => 'Komentoj',
);

/** Spanish (Español)
 * @author VegaDark
 */
$messages['es'] = array(
	'article-comments-anonymous' => 'Usuario anónimo',
	'article-comments-comments' => 'Comentarios ($1)',
	'article-comments-post' => 'Dejar comentario',
	'article-comments-delete' => '(borrar)',
	'article-comments-edit' => '(editar)',
	'article-comments-history' => '(Historial)',
	'article-comments-error' => 'El comentario no pudo ser guardado',
	'article-comments-undeleted-comment' => 'Comentario no borrado para la página del blog $1',
	'article-comments-rc-comment' => 'Comentario de artículo ([[$1]])',
	'article-comments-rc-comments' => 'Comentarios de artículo ([[$1]])',
	'article-comments-fblogin' => 'Por favor, <a href="$1">identifícate y conéctate con Facebook</a> para dejar un comentario en este wiki.',
	'article-comments-fbconnect' => 'Por favor, <a href="$1">conecta esta cuenta con Facebook</a> para dejar un comentario.',
	'article-comments-rc-blog-comment' => 'Comentario de blog ([[$1]])',
	'article-comments-rc-blog-comments' => 'Comentarios de blog ([[$1]])',
	'article-comments-login' => '<a href="$1">Identifícate</a> para dejar un comentario',
	'article-comments-toc-item' => 'Comentarios',
	'article-comments-comment-cannot-add' => 'No puedes añadir comentarios aquí',
	'article-comments-reply' => 'Responder',
	'article-comments-show-all' => 'Mostrar todos los comentarios',
	'article-comments-prev-page' => 'Anterior',
	'article-comments-next-page' => 'Siguiente',
	'article-comments-page-spacer' => '&#160...&#160',
	'article-comments-delete-reason' => 'El artículo raíz / comentario raíz ha sido borrado.',
	'article-comments-empty-comment' => "No puedes dejar un comentario en blanco. <a href='$1'>¿Quieres borrarlo?</a>",
	'enotif_subject_article_comment' => '$PAGEEDITOR ha comentado en "$PAGETITLE" en {{SITENAME}}',
	'enotif_body_article_comment' => 'Estimado $WATCHINGUSERNAME,

$PAGEEDITOR realizó un comentario en "$PAGETITLE".

Para ver el comentario, sigue el enlace: $PAGETITLE_URL

Por favor visita y edita con frecuencia...

Wikia',
	'enotif_body_article_comment-HTML' => '<p>Estimado $WATCHINGUSERNAME,
<br /><br />
$PAGEEDITOR realizó un comentario en "$PAGETITLE".
<br /><br />
Para ver el comentario, sigue el enlace: <a href="$PAGETITLE_URL">$PAGETITLE</a> 
<br /><br />
Por favor, visita y edita con frecuencia...
<br /><br />
Wikia
<br /><hr />
<ul>
<li>¿Quieres controlar qué mensajes recibir? <a href="{{fullurl:Special:Preferences}}">Actualiza tus preferencias<a>.</li>
</ul>
</p>',
);

/** Basque (Euskara)
 * @author An13sa
 */
$messages['eu'] = array(
	'article-comments-anonymous' => 'Lankide anonimoa',
	'article-comments-comments' => 'Iruzkinak ($1)',
	'article-comments-post' => 'Iruzkina idatzi',
	'article-comments-delete' => 'ezabatu',
	'article-comments-edit' => 'aldatu',
	'article-comments-history' => 'historia',
	'article-comments-reply' => 'Erantzun',
	'article-comments-show-all' => 'Iruzkin guztiak erakutsi',
	'article-comments-prev-page' => 'Aurrekoa',
	'article-comments-next-page' => 'Hurrengoa',
	'article-comments-page-spacer' => '&#160...&#160',
);

/** Persian (فارسی)
 * @author BlueDevil
 * @author Wayiran
 */
$messages['fa'] = array(
	'article-comments-anonymous' => 'کاربر گمنام',
	'article-comments-comments' => '($1) نظرات',
	'article-comments-post' => 'ارسال نظر',
	'article-comments-delete' => 'حذف',
	'article-comments-edit' => 'ویرایش',
	'article-comments-history' => 'تاریخچه',
	'article-comments-error' => 'نشد که نظر ذخیره شود',
	'article-comments-undeleted-comment' => 'نظر برای صفحۀ وبلاگ $1 احیاء شد',
	'article-comments-rc-comment' => 'نظر مقاله ([[$1]])',
	'article-comments-rc-comments' => 'نظرات مقاله ([[$1]])',
	'article-comments-fblogin' => 'برای فرستادن نظر در این ویکی لطفاً <a href="$1">به فیس‌بوک وارد و متصل شوید</a>!',
	'article-comments-rc-blog-comment' => 'نظر وبلاگ ([[$1]])',
	'article-comments-rc-blog-comments' => 'نظرات وبلاگ ([[$1]])',
	'article-comments-login' => 'برای نظر دادن <a href="$1">وارد سامانه شوید</a>.',
	'article-comments-toc-item' => 'نظرات',
	'article-comments-comment-cannot-add' => 'شما نمی‌توانید به مقاله نظری را اضافه کنید.',
	'article-comments-reply' => 'پاسخ',
	'article-comments-show-all' => 'نمایش همهٔ نظرات',
	'article-comments-prev-page' => 'قبلی',
	'article-comments-next-page' => 'بعدی',
	'article-comments-page-spacer' => '&#160...&#160',
	'article-comments-delete-reason' => 'مقالهٔ مادر / نظر مادر حذف شده است.',
	'article-comments-empty-comment' => "شما نمی‌توانید یک نظر خالی بفرستید. <a href='$1'>به‌جایش حذف شود؟</a>",
);

/** Finnish (Suomi)
 * @author Tofu II
 */
$messages['fi'] = array(
	'article-comments-anonymous' => 'Anonyymi käyttäjä',
	'article-comments-comments' => 'Kommentit ($1)',
	'article-comments-post' => 'Lähetä kommentti',
	'article-comments-delete' => 'poista',
	'article-comments-history' => 'historiasta',
	'article-comments-undeleted-comment' => 'Kommenttia ei poistettu blogisivulta $1',
	'article-comments-rc-comment' => 'Artikkelin kommentti ([[$1]])',
	'article-comments-rc-comments' => 'Artikkelin kommentit ([[$1]])',
	'article-comments-rc-blog-comment' => 'Blogin kommentti ([[$1]])',
	'article-comments-rc-blog-comments' => 'Blogin kommentit ([[$1]])',
	'article-comments-login' => '<a href="$1">Kirjaudu sisään</a> kommetoidaksesi',
	'article-comments-comment-cannot-add' => 'Et voi lisätä kommenttia tähän artikkeliin.',
	'article-comments-show-all' => 'Näytä kaikki kommentit',
);

/** French (Français)
 * @author Wyz
 */
$messages['fr'] = array(
	'article-comments-anonymous' => 'Utilisateur anonyme',
	'article-comments-comments' => 'Commentaires ($1)',
	'article-comments-post' => 'Ajouter un commentaire',
	'article-comments-delete' => 'Supprimer',
	'article-comments-edit' => 'modifier',
	'article-comments-history' => 'historique',
	'article-comments-error' => 'Le commentaire n’a pas pu être enregistré',
	'article-comments-undeleted-comment' => "Commentaire de l'article de blog $1 restauré",
	'article-comments-rc-comment' => 'Commentaire de page ([[$1]])',
	'article-comments-rc-comments' => 'Commentaires de page ([[$1]])',
	'article-comments-fblogin' => 'Veuillez <a href="$1">vous connecter et lier avec Facebook</a> pour poster un commentaire sur ce wiki !',
	'article-comments-fbconnect' => 'Veuillez <a href="$1">lier ce compte avec Facebook</a> pour commenter !',
	'article-comments-rc-blog-comment' => 'Commentaire de blog ([[$1]])',
	'article-comments-rc-blog-comments' => 'Commentaires de blog ([[$1]])',
	'article-comments-login' => '<a href="$1">Indentifiez-vous</a> pour faire un commenaire',
	'article-comments-toc-item' => 'Commentaires',
	'article-comments-comment-cannot-add' => 'Vous ne pouvez pas ajouter un commentaire à cette page.',
	'article-comments-reply' => 'Répondre',
	'article-comments-show-all' => 'Afficher tous les commentaires',
	'article-comments-prev-page' => 'Préc',
	'article-comments-next-page' => 'Suiv',
	'article-comments-page-spacer' => '&#160...&#160',
	'article-comments-delete-reason' => 'La page ou le commentaire parent a été effacé.',
	'article-comments-empty-comment' => "Vous ne pouvez pas poster un commentaire vide. <a href='$1'>Le supprimer ?</a>",
	'enotif_subject_article_comment' => '$PAGEEDITOR a commenté « $PAGETITLE » sur {{SITENAME}}',
	'enotif_body_article_comment' => '$WATCHINGUSERNAME,

$PAGEEDITOR a laissé un commentaire sur « $PAGETITLE ». 

Pour voir le fil de commentaire, cliquez sur le lien ci-dessous :
$PAGETITLE_URL 

Merci de revenir et de contribuer régulièrement...

Wikia',
	'enotif_body_article_comment-HTML' => '<p>$WATCHINGUSERNAME,
<br /><br />
$PAGEEDITOR a laissé un commentaire sur « $PAGETITLE ». 
<br /><br />
Pour voir le fil de commentaire, cliquez sur le lien suivant : <a href="$PAGETITLE_URL">$PAGETITLE</a>  
<br /><br />
Merci de revenir et de contribuer régulièrement...
<br /><br />
Wikia
<hr />
<ul>
<li>Vous souhaitez définir les courriels que vous désirez recevoir ? <a href="{{fullurl:Special:Preferences}}">Mettez à jour vos préférences<a>.</li>
</ul>
</p>',
);

/** Hungarian (Magyar)
 * @author Dani
 */
$messages['hu'] = array(
	'article-comments-anonymous' => 'Névtelen felhasználó',
	'article-comments-comments' => 'Hozzászólások ($1)',
	'article-comments-post' => 'Hozzászólás elküldése',
	'article-comments-delete' => 'törlés',
	'article-comments-edit' => 'szerkesztés',
	'article-comments-history' => 'laptörténet',
	'article-comments-error' => 'A hozzászólást nem lehet elmenteni',
	'article-comments-undeleted-comment' => 'A(z) $1 bloglap hozzászólása vissza lett állítva',
	'article-comments-rc-comment' => 'Cikkhez tartozó hozzászólás ([[$1]])',
	'article-comments-rc-comments' => 'Cikkhez tartozó hozzászólások ([[$1]])',
	'article-comments-toc-item' => 'Hozzászólások',
	'article-comments-comment-cannot-add' => 'Nem írhatsz hozzászólást a szócikkhez.',
	'article-comments-reply' => 'Válasz',
	'article-comments-show-all' => 'Összes hozzászólás',
	'article-comments-prev-page' => 'Előző',
	'article-comments-next-page' => 'Következő',
	'article-comments-page-spacer' => '&#160...&#160',
);

/** Interlingua (Interlingua)
 * @author McDutchie
 */
$messages['ia'] = array(
	'article-comments-anonymous' => 'Usator anonyme',
	'article-comments-comments' => 'Commentos ($1)',
	'article-comments-post' => 'Adjunger commento',
	'article-comments-delete' => 'deler',
	'article-comments-edit' => 'modificar',
	'article-comments-history' => 'historia',
	'article-comments-error' => 'Le commento non poteva esser salveguardate',
	'article-comments-undeleted-comment' => 'Commento in pagina de blog $1 restaurate',
	'article-comments-rc-comment' => 'Commentario de articulo ([[$1]])',
	'article-comments-rc-comments' => 'Commentarios de articulo ([[$1]])',
	'article-comments-fblogin' => 'Per favor <a href="$1">aperi session e connecte con Facebook</a> pro publicar un commento in iste wiki!',
	'article-comments-fbconnect' => 'Per favor <a href="$1">connecte iste conto con Facebook</a> pro commentar!',
	'article-comments-rc-blog-comment' => 'Commento de blog ([[$1]])',
	'article-comments-rc-blog-comments' => 'Commentos de blog ([[$1]])',
	'article-comments-login' => 'Per favor <a href="$1">aperi session</a> pro publicar un commento in iste wiki.',
	'article-comments-toc-item' => 'Commentos',
	'article-comments-comment-cannot-add' => 'Tu non pote adjunger un commento a iste articulo.',
	'article-comments-reply' => 'Responder',
	'article-comments-show-all' => 'Monstrar tote le commentos',
	'article-comments-prev-page' => 'Previe',
	'article-comments-next-page' => 'Proxime',
	'article-comments-page-spacer' => '&#160...&#160',
	'article-comments-delete-reason' => 'Le commento/articulo genitor ha essite delite.',
	'article-comments-empty-comment' => "Non es possibile publicar un commento vacue. <a href='$1'>Deler lo?</a>",
	'enotif_subject_article_comment' => '$PAGEEDITOR ha commentate "$PAGETITLE" sur {{SITENAME}}',
	'enotif_body_article_comment' => 'Car $WATCHINGUSERNAME,

$PAGEEDITOR lassava un commento sur "$PAGETITLE". 

Pro vider le filo de commentos, seque le ligamine sequente:
$PAGETITLE_URL 

Per favor visita e modifica sovente...

Wikia',
	'enotif_body_article_comment-HTML' => '<p>Car $WATCHINGUSERNAME,
<br /><br />
$PAGEEDITOR lassava un commento in "$PAGETITLE".
<br /><br />
Pro vider le filo de commentos, seque iste ligamine: <a href="$PAGETITLE_URL">$PAGETITLE</a> 
<br /><br />
Per favor visita e modifica sovente...
<br /><br />
Wikia
<br /><hr />
<ul>
<li>Vole determinar qual emails tu recipe? <a href="{{fullurl:Special:Preferences}}">Actualisa tu preferentias<a>.</li>
</ul>
</p>',
);

/** Italian (Italiano) */
$messages['it'] = array(
	'article-comments-anonymous' => 'Utente anonimo',
	'article-comments-comments' => 'Commenti ($1)',
	'article-comments-post' => 'Lascia un commento',
	'article-comments-delete' => 'Cancella',
	'article-comments-undeleted-comment' => 'Commenti non cancellati della pagina $1',
	'article-comments-login' => '<a href="$1">Accedi per lasciare un commenti</a>',
);

/** Japanese (日本語)
 * @author Tommy6
 */
$messages['ja'] = array(
	'article-comments-anonymous' => '匿名利用者',
	'article-comments-comments' => 'コメント ($1)',
	'article-comments-post' => 'コメントを投稿',
	'article-comments-delete' => '削除',
	'article-comments-edit' => '編集',
	'article-comments-history' => '履歴',
	'article-comments-error' => 'コメントを保存できませんでした',
	'article-comments-undeleted-comment' => 'ブログの記事 $1 へのコメントを復帰',
	'article-comments-rc-comment' => '記事コメント（[[$1]]）',
	'article-comments-rc-comments' => '記事コメント（[[$1]]）',
	'article-comments-fblogin' => 'コメントするには<a href="$1" rel="nofollow">ログインしてアカウントを Facebook に接続してください</a>。',
	'article-comments-fbconnect' => 'コメントするには<a href="$1">アカウントを Facebook に接続してください</a>。',
	'article-comments-rc-blog-comment' => 'ブログコメント（[[$1]]）',
	'article-comments-rc-blog-comments' => 'ブログコメント（[[$1]]）',
	'article-comments-login' => 'コメントするには<a href="$1">ログイン</a>する必要があります',
	'article-comments-toc-item' => 'コメント',
	'article-comments-comment-cannot-add' => 'この記事にはコメントを追加できません。',
	'article-comments-reply' => '返信する',
	'article-comments-show-all' => '全てのコメントを表示',
	'article-comments-prev-page' => '前',
	'article-comments-next-page' => '次',
	'article-comments-page-spacer' => '&#160...&#160',
	'article-comments-delete-reason' => '親記事/親コメントが削除されました',
	'article-comments-empty-comment' => "空コメントを投稿することはできません。<a href='$1'>コメントを削除しますか？</a>",
	'enotif_subject_article_comment' => '{{SITENAME}} のページ「$PAGETITLE」に $PAGEEDITOR がコメントを投稿しました',
	'enotif_body_article_comment' => '$WATCHINGUSERNAMEさん、

$PAGETITLE に $PAGEEDITOR がコメントをつけました。

コメントを見るには次のURLにアクセスしてください:
$PAGETITLE_URL

Wikia',
	'enotif_body_article_comment-HTML' => '<p>$WATCHINGUSERNAMEさん、
<br /><br />
$PAGETITLE に $PAGEEDITOR がコメントをつけました。
<br /><br />
コメントを見るには次のURLにアクセスしてください:<br />
<a href="$PAGETITLE_URL">$PAGETITLE</a>
<br /><br />
Wikia
</p>',
);

/** Colognian (Ripoarisch)
 * @author Purodha
 */
$messages['ksh'] = array(
	'article-comments-anonymous' => 'Nameloose Metmaacher',
	'article-comments-comments' => 'Aanmärkonge ($1)',
	'article-comments-post' => 'Aanmärkong dobei donn',
	'article-comments-delete' => 'fottschmieße',
	'article-comments-edit' => 'ändere',
	'article-comments-history' => 'Ällder Versione',
	'article-comments-error' => 'Di Aanmärkong kunnte mer nit faßhallde.',
	'article-comments-rc-comment' => 'Aanmärkong zom Atikel ([[$1]])',
	'article-comments-rc-comments' => 'Aanmärkonge zom Atikel ([[$1]])',
	'article-comments-rc-blog-comment' => 'Aanmärkong zom <i lang="en">blog</i> ([[$1]])',
	'article-comments-rc-blog-comments' => 'Aanmärkonge zom <i lang="en">blog</i> ([[$1]])',
	'article-comments-toc-item' => 'Aanmärkunge',
	'article-comments-comment-cannot-add' => 'Do kanns kein Aanmärkong zom Atikel maache',
	'article-comments-reply' => 'Antwoote',
	'article-comments-show-all' => 'All de Aanmärkonge zeije',
	'article-comments-prev-page' => 'Vörije',
	'article-comments-next-page' => 'Nächsde',
	'article-comments-page-spacer' => '&#160...&#160',
	'enotif_subject_article_comment' => '$PAGEEDITOR hädd_en Aanmärkong zoh "$PAGETITLE" op {{SITENAME}} jemaat.',
);

/** Kurdish (Latin) (Kurdî (Latin))
 * @author George Animal
 */
$messages['ku-latn'] = array(
	'article-comments-delete' => 'jê bibe',
	'article-comments-edit' => 'biguherîne',
	'article-comments-history' => 'dîrok',
);

/** Luxembourgish (Lëtzebuergesch)
 * @author Robby
 */
$messages['lb'] = array(
	'article-comments-anonymous' => 'Anonyme Benotzer',
	'article-comments-comments' => 'Bemierkungen ($1)',
	'article-comments-post' => 'Bemierkung derbäisetzen',
	'article-comments-delete' => 'läschen',
	'article-comments-edit' => 'änneren',
	'article-comments-history' => 'Historique',
	'article-comments-error' => "D'Bemierkung konnt net gespäichert ginn",
	'article-comments-undeleted-comment' => "Restauréiert Bemierkung dir d'Blog-Säit $1",
	'article-comments-rc-comment' => 'Bemierkung vum Artikel ([[$1]])',
	'article-comments-rc-comments' => 'Bemierkunge vum Artikel ([[$1]])',
	'article-comments-fblogin' => '<a href="$1">Loggt Iech an a verbannt mat Facebook</a> fir eng Bemierkung op dëser Wiki ze schreiwen!',
	'article-comments-toc-item' => 'Bemierkungen',
	'article-comments-reply' => 'Äntwerten',
	'article-comments-show-all' => 'All Bemierkunge weisen',
	'article-comments-prev-page' => 'Vireg',
	'article-comments-next-page' => 'Nächst',
);

/** Macedonian (Македонски)
 * @author Bjankuloski06
 */
$messages['mk'] = array(
	'article-comments-anonymous' => 'Анонимен корисник',
	'article-comments-comments' => 'Коментари ($1)',
	'article-comments-post' => 'Објави коментар',
	'article-comments-delete' => 'избриши',
	'article-comments-edit' => 'уреди',
	'article-comments-history' => 'историја',
	'article-comments-error' => 'Коментарот не може да се зачува',
	'article-comments-undeleted-comment' => 'Вратен избришаниот коментар на блоговската страница $1',
	'article-comments-rc-comment' => 'Коментар на статија ([[$1]])',
	'article-comments-rc-comments' => 'Коментари на статија ([[$1]])',
	'article-comments-fblogin' => '<a href="$1">Најавете се и поврзете се со Facebook</a> за да коментирате на ова вики!',
	'article-comments-fbconnect' => '<a href="$1">Поврзете ја сметката со Facebook</a> за да коментирате!',
	'article-comments-rc-blog-comment' => 'Блоговски коментар ([[$1]])',
	'article-comments-rc-blog-comments' => 'Блоговски коментари ([[$1]])',
	'article-comments-login' => '<a href="$1">Најавете се</a> за да коментирате на ова вики.',
	'article-comments-toc-item' => 'Коментари',
	'article-comments-comment-cannot-add' => 'Не можете да додавате комнтари во статијата.',
	'article-comments-reply' => 'Одговори',
	'article-comments-show-all' => 'Сите коментари',
	'article-comments-prev-page' => 'Претходна',
	'article-comments-next-page' => 'Следна',
	'article-comments-page-spacer' => '&#160...&#160',
	'article-comments-delete-reason' => 'Матичната статија / матичниот коментар е избришан.',
	'article-comments-empty-comment' => "Не можете да објавите празен коментар. <a href='$1'>Да го избришам?</a>",
	'enotif_subject_article_comment' => '$PAGEEDITOR коментираше на „$PAGETITLE“ на {{SITENAME}}',
	'enotif_body_article_comment' => 'Почитуван/а $WATCHINGUSERNAME,

$PAGEEDITOR коментираше на „$PAGETITLE“. 

Коментарот можете да го проследите на следнава врска:
$PAGETITLE_URL 

Посетувајте нè и уредувајте често...

Викија',
	'enotif_body_article_comment-HTML' => '<p>Почитуван/а $WATCHINGUSERNAME,
<br /><br />
$PAGEEDITOR коментираше на „$PAGETITLE“.
<br /><br />
Коментарот може да го проследите на следнава врска: <a href="$PAGETITLE_URL">$PAGETITLE</a> 
<br /><br />
Посетувајте нè и уредувајте често...
<br /><br />
Викија
<br /><hr />
<ul>
<li>Сакате да определите кои пораки да ги добивате? <a href="{{fullurl:Special:Preferences}}">Изменете си ги нагодувањата<a>.</li>
</ul>
</p>',
);

/** Malayalam (മലയാളം)
 * @author Praveenp
 */
$messages['ml'] = array(
	'article-comments-anonymous' => 'അജ്ഞാത ഉപയോക്താവ്',
	'article-comments-comments' => 'അഭിപ്രായങ്ങൾ ($1)',
	'article-comments-post' => 'അഭിപ്രായം പ്രസിദ്ധീകരിക്കുക',
	'article-comments-delete' => 'മായ്ക്കുക',
	'article-comments-edit' => 'തിരുത്തുക',
	'article-comments-history' => 'നാൾവഴി',
	'article-comments-error' => 'അഭിപ്രായം സേവ് ചെയ്യാൻ കഴിഞ്ഞില്ല',
	'article-comments-rc-comment' => 'ലേഖനത്തെക്കുറിച്ചുള്ള അഭിപ്രായം ([[$1]])',
	'article-comments-rc-comments' => 'ലേഖനത്തെക്കുറിച്ചുള്ള അഭിപ്രായങ്ങൾ ([[$1]])',
	'article-comments-toc-item' => 'അഭിപ്രായങ്ങൾ',
	'article-comments-reply' => 'മറുപടി',
	'article-comments-show-all' => 'എല്ലാ അഭിപ്രായങ്ങളും പ്രദർശിപ്പിക്കുക',
	'article-comments-prev-page' => 'മുമ്പ്',
	'article-comments-next-page' => 'അടുത്തത്',
);

/** Malay (Bahasa Melayu)
 * @author Anakmalaysia
 */
$messages['ms'] = array(
	'article-comments-anonymous' => 'Pengguna tanpa nama',
	'article-comments-comments' => 'Ulasan ($1)',
	'article-comments-post' => 'Kirim ulasan',
	'article-comments-delete' => 'hapuskan',
	'article-comments-edit' => 'sunting',
	'article-comments-history' => 'sejarah',
	'article-comments-error' => 'Ulasan tidak dapat disimpan',
	'article-comments-undeleted-comment' => 'Ulasan yang dinyahhapuskan untuk laman blog $1',
	'article-comments-rc-comment' => 'Ulasan rencana ([[$1]])',
	'article-comments-rc-comments' => 'Ulasan rencana ([[$1]])',
	'article-comments-fblogin' => 'Sila <a href="$1">log masuk dan bersambung dengan Facebook</a> untuk mengirimkan ulasan di wiki ini!',
	'article-comments-fbconnect' => 'Sila <a href="$1">sambungkan akaun ini dengan Facebook</a> untuk mengulas!',
	'article-comments-rc-blog-comment' => 'Ulasan blog ([[$1]])',
	'article-comments-rc-blog-comments' => 'Ulasan blog ([[$1]])',
	'article-comments-login' => 'Sila <a href="$1">log masuk</a> untuk mengirim ulasan di wiki ini.',
	'article-comments-toc-item' => 'Ulasan',
	'article-comments-comment-cannot-add' => 'Anda tidak boleh mengirim ulasan kepada rencana ini.',
	'article-comments-reply' => 'Balas',
	'article-comments-show-all' => 'Tunjukkan semua ulasan',
	'article-comments-prev-page' => 'Sebelumnya',
	'article-comments-next-page' => 'Seterusnya',
	'article-comments-page-spacer' => '&#160...&#160',
	'article-comments-delete-reason' => 'Rencana induk / ulasan induk telah dihapuskan.',
	'article-comments-empty-comment' => "Anda tidak boleh mengirim ulasan kososng. <a href='$1'>Nak padamkan atau tak?</a>",
	'enotif_subject_article_comment' => '$PAGEEDITOR telah mengulas "$PAGETITLE" di {{SITENAME}}',
	'enotif_body_article_comment' => '$WATCHINGUSERNAME,

$PAGEEDITOR telah membuat ulasan di "$PAGETITLE". 

Untuk melihat tred ulasannya, sila ikuti pautan berikut:
$PAGETITLE_URL 

Sila datang lagi untuk menyunting...

Wikia',
	'enotif_body_article_comment-HTML' => '<p>$WATCHINGUSERNAME,
<br /><br />
$PAGEEDITOR membuat ulasan di "$PAGETITLE".
<br /><br />
Untuk melihat tred ulasannya, klik di sini: <a href="$PAGETITLE_URL">$PAGETITLE</a> 
<br /><br />
Sila lawati kami selalu untuk menyunting...
<br /><br />
Wikia
<br /><hr />
<ul>
<li>Nak kawal emel mana yang anda terima? <a href="{{fullurl:Special:Preferences}}">Kemaskini Keutamaan anda<a>.</li>
</ul>
</p>',
);

/** Mazanderani (مازِرونی)
 * @author محک
 */
$messages['mzn'] = array(
	'article-comments-edit' => 'دچی‌ین',
	'article-comments-history' => 'تاریخچه',
	'article-comments-undeleted-comment' => 'نظر صفحۀ وبلاگ $1 وسّه احیاء بیّه',
);

/** Dutch (Nederlands)
 * @author Siebrand
 */
$messages['nl'] = array(
	'article-comments-anonymous' => 'Anonieme gebruiker',
	'article-comments-comments' => 'Opmerkingen ($1)',
	'article-comments-post' => 'Opmerking plaatsen',
	'article-comments-delete' => 'verwijderen',
	'article-comments-edit' => 'bewerken',
	'article-comments-history' => 'geschiedenis',
	'article-comments-error' => 'De opmerking kon niet opgeslagen worden',
	'article-comments-undeleted-comment' => 'Heeft een opmerking op blogpagina $1 teruggeplaatst',
	'article-comments-rc-comment' => 'Opmerking bij pagina ([[$1]])',
	'article-comments-rc-comments' => 'Opmerkingen bij pagina ([[$1]])',
	'article-comments-fblogin' => '<a href="$1">Meld u aan en verbind met Facebook</a> om een opmerking in deze wiki te plaatsen.',
	'article-comments-fbconnect' => '<a href="$1">Verbind deze gebruiker met Facebook</a> om opmerkingen te plaatsen.',
	'article-comments-rc-blog-comment' => 'Opmerking bij blog ([[$1]])',
	'article-comments-rc-blog-comments' => 'Opmerkingen bij blog ([[$1]])',
	'article-comments-login' => '<a href="$1">Meld u aan</a> om een opmerking in deze wiki te kunnen plaatsen.',
	'article-comments-toc-item' => 'Opmerkingen',
	'article-comments-comment-cannot-add' => 'U kunt geen opmerkingen bij de pagina plaatsen.',
	'article-comments-reply' => 'Antwoorden',
	'article-comments-show-all' => 'Alle opmerkingen weergeven',
	'article-comments-prev-page' => 'Vorige',
	'article-comments-next-page' => 'Volgende',
	'article-comments-page-spacer' => '&#160...&#160',
	'article-comments-delete-reason' => 'De bovenliggende pagina is verwijderd.',
	'article-comments-empty-comment' => "U kunt geen opmerking zonder inhoud plaatsen. <a href='$1'>In plaats daarvan verwijderen?</a>",
	'enotif_subject_article_comment' => '$PAGEEDITOR heeft een opmerking geplaatst bij "$PAGETITLE" op {{SITENAME}}',
	'enotif_body_article_comment' => 'Beste $WATCHINGUSERNAME,

$ PAGEEDITOR heeft een opmerking geplaatst bij "$PAGETITLE".

U kunt de discussie bekijken via de volgende verwijzing:
$PAGETITLE_URL

Kom alstublieft vaak langs en bewerk veelvuldig...

Wikia',
	'enotif_body_article_comment-HTML' => '<p>Beste $WATCHINGUSERNAME,
<br /><br />
$ PAGEEDITOR heeft een opmerking geplaatst bij "$PAGETITLE".
<br /><br />
U kunt de discussie bekijken via de volgende verwijzing: <a href="$PAGETITLE_URL">$PAGETITLE</a> 
<br /><br />
Kom alstublieft vaak langs en bewerk veelvuldig...
<br /><br />
Wikia
<br /><hr />
<ul>
<li>Wilt u bepalen welke e-mails u ontvangt? <a href="{{fullurl:{{ns:special}}:Preferences}}">Pas dan uw Voorkeuren<a> aan.</li>
</ul>
</p>',
);

/** ‪Nederlands (informeel)‬ (‪Nederlands (informeel)‬)
 * @author Siebrand
 */
$messages['nl-informal'] = array(
	'article-comments-comment-cannot-add' => 'Je kunt geen opmerkingen bij de pagina plaatsen.',
	'article-comments-empty-comment' => "Je kunt geen opmerking zonder inhoud plaatsen. <a href='$1'>In plaats daarvan verwijderen?</a>",
	'enotif_body_article_comment-HTML' => '<p>Hoi $WATCHINGUSERNAME,
<br /><br />
$ PAGEEDITOR heeft een opmerking geplaatst bij "$PAGETITLE".
<br /><br />
Je kunt de discussie bekijken via de volgende verwijzing: <a href="$PAGETITLE_URL">$PAGETITLE</a> 
<br /><br />
Kom alsjeblieft vaak langs en bewerk veelvuldig...
<br /><br />
Wikia
<br /><hr />
<ul>
<li>Wilt je bepalen welke e-mails je ontvangt? <a href="{{fullurl:{{ns:special}}:Preferences}}">Pas dan je Voorkeuren<a> aan.</li>
</ul>
</p>',
);

/** Norwegian (bokmål)‬ (‪Norsk (bokmål)‬)
 * @author Audun
 */
$messages['no'] = array(
	'article-comments-anonymous' => 'Anonym bruker',
	'article-comments-comments' => 'Kommentarer ($1)',
	'article-comments-post' => 'Post kommentar',
	'article-comments-delete' => 'slett',
	'article-comments-edit' => 'rediger',
	'article-comments-history' => 'historikk',
	'article-comments-error' => 'Kommentaren kunne ikke lagres',
	'article-comments-undeleted-comment' => 'Angret slettning av kommetar for bloggsiden $1',
	'article-comments-rc-comment' => 'Artikkelkommentar ([[$1]])',
	'article-comments-rc-comments' => 'Artikkelkommentarer ([[$1]])',
	'article-comments-fblogin' => 'Vennligst <a href="$1">logg inn og koble deg til Facebook</a> for å poste en kommentar på denne wikien!',
	'article-comments-fbconnect' => 'Vennligst <a href="$1">koble denne kontoen til Facebook</a> for å kommentere!',
	'article-comments-rc-blog-comment' => 'Bloggkommentar ([[$1]])',
	'article-comments-rc-blog-comments' => 'Bloggkommentarer ([[$1]])',
	'article-comments-login' => 'Vennligst <a href="$1">logg inn</a> for å kommentere på denne wikien.',
	'article-comments-toc-item' => 'Kommentarer',
	'article-comments-comment-cannot-add' => 'Du kan ikke legge en kommentar til artikkelen.',
	'article-comments-reply' => 'Svar',
	'article-comments-show-all' => 'Vis alle kommentarer',
	'article-comments-prev-page' => 'Forrige',
	'article-comments-next-page' => 'Neste',
	'article-comments-page-spacer' => '&#160...&#160',
	'article-comments-delete-reason' => 'Overordnet artikkel/overordnet kommentar har blitt slettet.',
	'article-comments-empty-comment' => "Du kan ikke poste en tom kommentar. <a href='$1'>Slette den istedenfor?</a>",
	'enotif_subject_article_comment' => '$PAGEEDITOR har kommentert «$PAGETITLE» på {{SITENAME}}',
	'enotif_body_article_comment' => 'Kjære $WATCHINGUSERNAME,

$PAGEEDITOR har kommentert «$PAGETITLE». 

For å se kommentartråden, følg lenken under:
$PAGETITLE_URL 

Vennligst kom på besøk og rediger ofte...

Wikia',
	'enotif_body_article_comment-HTML' => '<p>Kjære $WATCHINGUSERNAME,
<br /><br />
$PAGEEDITOR har kommentert «$PAGETITLE». 
<br /><br />
For å se kommentartråden, følg denne lenken: <a href="$PAGETITLE_URL">$PAGETITLE</a>
<br /><br />
Vennligst kom på besøk og rediger ofte...
<br /><br />
Wikia
<br /><br />
<ul>
<li>Vil du kontrollere hva slags e-post du mottar? <a href="{{fullurl:Special:Preferences}}">Oppdater innstillingene dine<a>.</li>
</ul>
</p>',
);

/** Polish (Polski) */
$messages['pl'] = array(
	'article-comments-anonymous' => 'Anonimowy użytkownik',
	'article-comments-comments' => 'Komentarze ($1)',
	'article-comments-post' => 'Wyślij komentarz',
	'article-comments-delete' => 'usuń',
	'article-comments-edit' => 'edytuj',
	'article-comments-history' => 'historia',
	'article-comments-undeleted-comment' => 'Usunięcie komentarza na stronie $1 blogu.',
	'article-comments-login' => '<a href="$1">Zaloguj się</a>, aby komentować',
);

/** Pashto (پښتو)
 * @author Ahmed-Najib-Biabani-Ibrahimkhel
 */
$messages['ps'] = array(
	'article-comments-anonymous' => 'ورکنومی کارن',
	'article-comments-comments' => 'تبصرې ($1)',
	'article-comments-delete' => 'ړنګول',
	'article-comments-edit' => 'سمول',
	'article-comments-history' => 'پېښليک',
	'article-comments-reply' => 'ځوابول',
	'article-comments-show-all' => 'ټولې تبصرې ښکاره کول',
);

/** Portuguese (Português)
 * @author Hamilton Abreu
 * @author SandroHc
 * @author Waldir
 */
$messages['pt'] = array(
	'article-comments-anonymous' => 'Utilizador anónimo',
	'article-comments-comments' => 'Comentários ($1)',
	'article-comments-post' => 'Publicar comentário',
	'article-comments-delete' => 'eliminar',
	'article-comments-edit' => 'editar',
	'article-comments-history' => 'histórico',
	'article-comments-error' => 'Não foi possível gravar o comentário',
	'article-comments-undeleted-comment' => 'Comentário recuperado para a página de blogue $1',
	'article-comments-rc-comment' => 'Comentário de artigo ([[$1]])',
	'article-comments-rc-comments' => 'Comentários de artigo ([[$1]])',
	'article-comments-fblogin' => 'Por favor, <a href="$1">autentique-se e ligue-se ao Facebook</a> para publicar um comentário nesta wiki!',
	'article-comments-fbconnect' => 'Por favor <a href="$1">associe esta conta ao Facebook</a> para comentar!',
	'article-comments-rc-blog-comment' => 'Comentário de blog ([[$1]])',
	'article-comments-rc-blog-comments' => 'Comentários de blogue ([[$1]])',
	'article-comments-login' => 'Por favor, <a href="$1">autentique-se</a> para publicar um comentário nesta wiki.',
	'article-comments-toc-item' => 'Comentários',
	'article-comments-comment-cannot-add' => 'Não pode adicionar um comentário ao artigo.',
	'article-comments-reply' => 'Responder',
	'article-comments-show-all' => 'Mostrar todos os comentários',
	'article-comments-prev-page' => 'Anterior',
	'article-comments-next-page' => 'Próximo',
	'article-comments-page-spacer' => '&#160...&#160',
	'article-comments-delete-reason' => 'O artigo raiz / comentário raiz foi apagado.',
	'article-comments-empty-comment' => "Não pode publicar um comentário vazio. <a href='$1'>Quer apagá-lo?</a>",
	'enotif_subject_article_comment' => '$PAGEEDITOR comentou "$PAGETITLE" na {{SITENAME}}',
	'enotif_body_article_comment' => 'Caro $WATCHINGUSERNAME,

$PAGEEDITOR fez um comentário em "$PAGETITLE". 

Para ver o comentário, siga o link abaixo:
$PAGETITLE_URL 

Por favor, visite-nos e edite muito...

Wikia',
	'enotif_body_article_comment-HTML' => '<p>Caro $WATCHINGUSERNAME, 
<br /><br />
$PAGEEDITOR fez um comentário em "$PAGETITLE". 
<br /><br />
Para ver a lista de discussão do comentário, siga este link: <a href="$PAGETITLE_URL">$PAGETITLE</a> 
<br /><br />
Por favor, visite e edite muitas vezes... 
<br /><br />
Wikia 
<br /><hr />
<ul>
<li>Quer controlar os e-mails que recebe? <a href="{{fullurl:Special:Preferences}}">Actualize as suas preferências<a>.</li>
</ul>
</p>',
);

/** Brazilian Portuguese (Português do Brasil)
 * @author Aristóbulo
 */
$messages['pt-br'] = array(
	'article-comments-anonymous' => 'Usuário anônimo',
	'article-comments-comments' => 'Comentários ($1)',
	'article-comments-post' => 'Postar comentário',
	'article-comments-delete' => 'apagar',
	'article-comments-edit' => 'editar',
	'article-comments-history' => 'histórico',
	'article-comments-error' => 'O comentário não pôde ser salvo.',
	'article-comments-undeleted-comment' => 'Comentário não deletado para a página do blog $1',
	'article-comments-rc-comment' => 'Comentário do artigo ([[$1]])',
	'article-comments-rc-comments' => 'Comentário do artigo ([[$1]])',
	'article-comments-fblogin' => 'Por favor, <a href="$1">efetue o login e conecte-se com o Facebook</a> para postar um comentário sobre esta wiki!',
	'article-comments-fbconnect' => 'Por favor <a href="$1">ligue essa conta com o Facebook</a> para comentar!',
	'article-comments-rc-blog-comment' => 'Comentário de blog ([[$1]])',
	'article-comments-rc-blog-comments' => 'Comentário de blog ([[$1]])',
	'article-comments-login' => 'Por favor, <a href="$1">efetue o login</a> para postar um comentário sobre este wiki.',
	'article-comments-toc-item' => 'Comentários',
	'article-comments-comment-cannot-add' => 'Você não pode adicionar um comentário ao artigo.',
	'article-comments-reply' => 'Responder',
	'article-comments-show-all' => 'Mostrar todos os comentários',
	'article-comments-prev-page' => 'Anterior',
	'article-comments-next-page' => 'Próximo',
	'article-comments-page-spacer' => '& # 160... & # 160',
	'article-comments-delete-reason' => '',
	'article-comments-empty-comment' => 'Você não pode postar um comentário vazio. <a href="$1">Excluí-lo em vez disso?</a>',
	'enotif_subject_article_comment' => 'Comentou sobre "$ PAGETITLE" em {{SITENAME}} $PAGEEDITOR',
	'enotif_body_article_comment' => 'Caro $ WATCHINGUSERNAME, 

 $ PAGEEDITOR fez um comentário sobre "$ PAGETITLE". 

 Para ver a lista de discussão do comentário, clique no link abaixo: 
 $ PAGETITLE_URL 

 Visite e edite muitas vezes ... 

 Wikia',
	'enotif_body_article_comment-HTML' => '<p> Caro $ WATCHINGUSERNAME, 
<br /><br />
 $ PAGEEDITOR fez um comentário sobre "$ PAGETITLE". 
<br /><br />
 Para ver a lista de discussão do comentário, siga este link: <a href="$PAGETITLE_URL">$ PAGETITLE</a> 
<br /><br />
 Visite e edite muitas vezes ... 
<br /><br />
 Wikia 
<br /><hr />
<ul>
<li> Quer controlar os emails que você recebe? <a href="{{fullurl:Special:Preferences}}">atualize suas preferências</a> <a>.</a> </li>
</ul>
</p>',
);

/** Romanian (Română)
 * @author Stelistcristi
 */
$messages['ro'] = array(
	'article-comments-anonymous' => 'Utilizator anonim',
	'article-comments-comments' => 'Comentarii ($1)',
	'article-comments-post' => 'Postează comentariu',
	'article-comments-delete' => 'şterge',
	'article-comments-edit' => 'editează',
	'article-comments-history' => 'istoric',
	'article-comments-toc-item' => 'Comentarii',
	'article-comments-reply' => 'Răspunde',
	'article-comments-show-all' => 'Afişează toate comentariile',
	'article-comments-page-spacer' => '&#160...&#160',
	'article-comments-empty-comment' => "Nu poţi posta un comentariu gol. <a href='$1'>Îl ştergi, în schimb?</a>",
);

/** Tarandíne (Tarandíne)
 * @author Joetaras
 */
$messages['roa-tara'] = array(
	'article-comments-reply' => 'Respunne',
);

/** Swedish (Svenska)
 * @author WikiPhoenix
 */
$messages['sv'] = array(
	'article-comments-anonymous' => 'Anonym användare',
	'article-comments-comments' => 'Kommentarer ($1)',
	'article-comments-delete' => 'radera',
	'article-comments-edit' => 'redigera',
	'article-comments-history' => 'historik',
	'article-comments-error' => 'Kommentaren kunde inte sparas',
	'article-comments-rc-comment' => 'Artikelkommentar ([[$1]])',
	'article-comments-rc-comments' => 'Artikelkommentarer ([[$1]])',
	'article-comments-fblogin' => 'Var god <a href="$1">logga in och anslut dig till Facebook</a> för att posta en kommentar på den här wikin!',
	'article-comments-fbconnect' => 'Var god <a href="$1">anslut detta konto till Facebook</a> för att kommentera!',
	'article-comments-rc-blog-comment' => 'Bloggkommentar ([[$1]])',
	'article-comments-rc-blog-comments' => 'Bloggkommentarer ([[$1]])',
	'article-comments-login' => 'Var god <a href="$1">logga in</a> för att posta en kommentar på den här wikin.',
	'article-comments-toc-item' => 'Kommentarer',
	'article-comments-comment-cannot-add' => 'Du kan inte lägga till en kommentar till artikeln.',
	'article-comments-reply' => 'Svara',
	'article-comments-show-all' => 'Visa alla kommentarer',
	'article-comments-prev-page' => 'Föreg',
	'article-comments-next-page' => 'Nästa',
	'article-comments-page-spacer' => '&#160...&#160',
	'article-comments-empty-comment' => "Du kan inte skriva en tom kommentar. <a href='$1'>Ta bort det istället?</a>",
	'enotif_body_article_comment' => 'Kära $WATCHINGUSERNAME,

$PAGEEDITOR har lagt in en kommentar på "$PAGETITLE". 

För att se kommentartråden, följ länken nedan:
$PAGETITLE_URL 

Besök oss och redigera ofta...

Wikia',
);

/** Telugu (తెలుగు)
 * @author Veeven
 */
$messages['te'] = array(
	'article-comments-anonymous' => 'అజ్ఞాత వాడుకరి',
	'article-comments-comments' => 'వ్యాఖ్యలు ($1)',
	'article-comments-delete' => 'తొలగించు',
	'article-comments-history' => 'చరిత్ర',
	'article-comments-rc-blog-comments' => 'బ్లాగు వ్యాఖ్యలు ([[$1]])',
	'article-comments-toc-item' => 'వ్యాఖ్యలు',
	'article-comments-comment-cannot-add' => 'ఈ వ్యాసానికి మీరు వ్యాఖ్యని చేర్చలేరు.',
	'article-comments-page-spacer' => '&#160...&#160',
);

/** Tagalog (Tagalog)
 * @author AnakngAraw
 */
$messages['tl'] = array(
	'article-comments-anonymous' => 'Hindi nagpapakilalang tagagamit',
	'article-comments-comments' => 'Mga puna ($1)',
	'article-comments-post' => 'Magpaskil ng puna',
	'article-comments-delete' => 'burahin',
	'article-comments-edit' => 'baguhin',
	'article-comments-history' => 'kasaysayan',
	'article-comments-error' => 'Hindi masagip ang puna',
	'article-comments-undeleted-comment' => 'Hindi naburang puna para sa pahina ng blog na $1',
	'article-comments-rc-comment' => 'Puna sa artikulo ([[$1]])',
	'article-comments-rc-comments' => 'Mga puna sa artikulo ([[$1]])',
	'article-comments-fblogin' => 'Mangyaring <a href="$1">lumagda at umugnay sa Facebook</a> upang makapagpaskil ng isang puna sa wiking ito!',
	'article-comments-fbconnect' => 'Mangyaring <a href="$1">iugnay ang akawnt na ito sa Facebook</a> upang makapagbigay ng puna!',
	'article-comments-rc-blog-comment' => 'Puna sa blog ([[$1]])',
	'article-comments-rc-blog-comments' => 'Mga puna sa blog ([[$1]])',
	'article-comments-login' => 'Mangyaring <a href="$1">log in</a> upang makapagpaskil ng isang puna sa wiking ito.',
	'article-comments-toc-item' => 'Mga puna',
	'article-comments-comment-cannot-add' => 'Hindi ka makapagdaragdag ng isang puna sa artikulo.',
	'article-comments-reply' => 'Tumugon',
	'article-comments-show-all' => 'Ipakita ang lahat ng mga puna',
	'article-comments-prev-page' => 'Nakaraan',
	'article-comments-next-page' => 'Kasunod',
	'article-comments-page-spacer' => '&#160...&#160',
	'article-comments-delete-reason' => 'Nabura ang magulang ng artikulo / magulang ng puna.',
	'article-comments-empty-comment' => "Hindi ka makapagpapaskil ng puna na walang laman. <a href='$1'>Burahin na lang ito?</a>",
	'enotif_subject_article_comment' => 'Pumuna ang $PAGEEDITOR sa "$PAGETITLE" sa {{SITENAME}}',
	'enotif_body_article_comment' => 'Minamahal na $WATCHINGUSERNAME,

Nagbigay ng puna si $PAGEEDITOR sa "$PAGETITLE". 

Upang matingnan ang bagting ng puna, sundan ang kawing na nasa ibaba:
$PAGETITLE_URL 

Mangyaring dumalaw at mamatnugot ng madalas...

Wikia',
	'enotif_body_article_comment-HTML' => '<p>Minamahal na $WATCHINGUSERNAME,
<br /><br />
Nagbigay ng puna si $PAGEEDITOR sa "$PAGETITLE".
<br /><br />
Upang matanaw ang sinulid ng puna, sundan ang kawing na ito: <a href="$PAGETITLE_URL">$PAGETITLE</a> 
<br /><br />
Mangyaring dumalaw at mamatnugot ng madalas...
<br /><br />
Wikia
<br /><hr />
<ul>
<li>Nais mo bang tabanan kung anong mga e-liham ang tatanggapin? <a href="{{fullurl:Special:Preferences}}">Isapanahon ang mga Nais mo<a>.</li>
</ul>
</p>',
);

/** Vietnamese (Tiếng Việt)
 * @author XiaoQiaoGrace
 */
$messages['vi'] = array(
	'article-comments-anonymous' => 'Người dùng chưa đăng kí',
	'article-comments-comments' => 'Ý kiến ($1)',
	'article-comments-post' => 'Đăng lên ý kiến',
	'article-comments-delete' => 'xóa',
	'article-comments-edit' => 'chỉnh sửa',
	'article-comments-history' => 'lịch sử',
	'article-comments-rc-comment' => 'Trang bình luận ([[$1]])',
	'article-comments-reply' => 'Đáp lại',
	'article-comments-prev-page' => 'Kế trước',
	'article-comments-next-page' => 'Tiếp theo',
);

/** Simplified Chinese (‪中文(简体)‬)
 * @author Hydra
 */
$messages['zh-hans'] = array(
	'article-comments-anonymous' => '匿名用户',
	'article-comments-comments' => '评论（$1）',
	'article-comments-post' => '发表评论',
	'article-comments-delete' => '删除',
	'article-comments-edit' => '编辑',
	'article-comments-history' => '历史',
	'article-comments-error' => '无法保存注释',
	'article-comments-toc-item' => '评论',
	'article-comments-comment-cannot-add' => '不能将注释添加到文章中。',
	'article-comments-reply' => '答复',
	'article-comments-show-all' => '显示所有注释',
	'article-comments-prev-page' => '上一页',
	'article-comments-next-page' => '下一页',
);

