<?php
$content_lang = (array)json_decode(file_get_contents(App::langPath().'/_file/frontend/common.json'));
return isset($content_lang['vi'])?(array)$content_lang['vi']:array();
