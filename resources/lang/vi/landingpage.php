<?php
$content_lang = (array)json_decode(file_get_contents(App::langPath().'/_file/frontend/landingpage.json'));
return (array)$content_lang['vi'];
