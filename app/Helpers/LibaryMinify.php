<?php
namespace App\Helpers;

class Minify
{
    const MINIFY_STRING         = '"(?:[^"\\\]|\\\.)*"|\'(?:[^\'\\\]|\\\.)*\'';
    const MINIFY_COMMENT_CSS    = '/\*[\s\S]*?\*/';
    const MINIFY_COMMENT_HTML   = '<!\-{2}[\s\S]*?\-{2}>';
    const MINIFY_COMMENT_JS     = '//[^\n]*';
    const MINIFY_PATTERN_JS     = '/[^\n]+?/[gimuy]*';
    const MINIFY_HTML           = '<[!/]?[a-zA-Z\d:.-]+[\s\S]*?>';
    const MINIFY_HTML_ENT       = '&(?:[a-zA-Z\d]+|\#\d+|\#x[a-fA-F\d]+);';
    const MINIFY_HTML_KEEP      = '<pre(?:\s[^<>]*?)?>[\s\S]*?</pre>|<code(?:\s[^<>]*?)?>[\s\S]*?</code>|<script(?:\s[^<>]*?)?>[\s\S]*?</script>|<style(?:\s[^<>]*?)?>[\s\S]*?</style>|<textarea(?:\s[^<>]*?)?>[\s\S]*?</textarea>';
    
    const X = "\x1A";

    public static function remove_n($s) {
        return str_replace(["\r\n", "\r"], "\n", $s);
    }
    public static function t($a, $b) {
        if ($a && strpos($a, $b) === 0 && substr($a, -strlen($b)) === $b) {
            return substr(substr($a, strlen($b)), 0, -strlen($b));
        }
        return $a;
    }
    public static function fn_minify($pattern, $input) {
        return preg_split('#(' . implode('|', $pattern) . ')#', $input, -1, PREG_SPLIT_NO_EMPTY | PREG_SPLIT_DELIM_CAPTURE);
    }
    public static function fn_minify_css($input, $comment = 2, $quote = 2) {
        if (!is_string($input) || !$input = Minify::remove_n(trim($input))) return $input;
        $output = $prev = "";
        foreach (Minify::fn_minify([MINIFY_COMMENT_CSS, MINIFY_STRING], $input) as $part) {
            if (trim($part) === "") continue;
            if ($comment !== 1 && strpos($part, '/*') === 0 && substr($part, -2) === '*/') {
                if (
                    $comment === 2 && (
                        strpos('*!', $part[2]) !== false ||
                        stripos($part, '@licence') !== false ||
                        stripos($part, '@license') !== false ||
                        stripos($part, '@preserve') !== false
                    )
                ) {
                    $output .= $part;
                }
                continue;
            }
            if ($part[0] === '"' && substr($part, -1) === '"' || $part[0] === "'" && substr($part, -1) === "'") {
                $q = $part[0];
                if (
                    $quote !== 1 && (
                        substr($prev, -4) === 'url(' && preg_match('#\burl\($#', $prev) ||
                        substr($prev, -1) === '=' && preg_match('#^' . $q . '[a-zA-Z_][\w-]*?' . $q . '$#', $part)
                    )
                ) {
                    $part = Minify::t($part, $q);
                }
                $output .= $part;
            } else {
                $output .= Minify::fn_minify_css_union($part);
            }
            $prev = $part;
        }
        return trim($output);
    }
   public static function fn_minify_css_union($input) {
        if (stripos($input, 'calc(') !== false) {
            $input = preg_replace_callback('#\b(calc\()\s*(.*?)\s*\)#i', function($m) {
                return $m[1] . preg_replace('#\s+#', Minify::X, $m[2]) . ')';
            }, $input);
        }
        $input = preg_replace([
            '#(?<=[\w])\s+(\*|\[|:[\w-]+)#',
            '#([*\]\)])\s+(?=[\w\#.])#', '#\b\s+\(#', '#\)\s+\b#',
            '#\#([a-f\d])\1([a-f\d])\2([a-f\d])\3\b#i',
            '#\s*([~!@*\(\)+=\{\}\[\]:;,>\/])\s*#',
            '#\b(?:0\.)?0([a-z]+\b)#i',
            '#\b0+\.(\d+)#',
            '#:(0\s+){0,3}0(?=[!,;\)\}]|$)#',
            '#\b(background(?:-position)?):(?:0|none)([;,\}])#i',
            '#\b(border(?:-radius)?|outline):none\b#i',
            '#(^|[\{\}])(?:[^\{\}]+)\{\}#',
            '#;+([;\}])#',
            '#\s+#'
        ], [
            Minify::X . '$1',
            '$1' . Minify::X, Minify::X . '(', ')' . Minify::X,
            '#$1$2$3',
            '$1',
            '0',
            '.$1',
            ':0',
            '$1:0 0$2',
            '$1:0',
            '$1',
            '$1',
            ' '
        ], $input);
        return trim(str_replace(Minify::X, ' ', $input));
    }
    public static function fn_minify_html($input, $comment = 2, $quote = 1) {
        if (!is_string($input) || !$input = Minify::remove_n(trim($input))) return $input;
        $output = $prev = "";
        foreach (Minify::fn_minify([MINIFY_COMMENT_HTML, MINIFY_HTML_KEEP, MINIFY_HTML, MINIFY_HTML_ENT], $input) as $part) {
            if ($part === "\n") continue;
            if ($part !== ' ' && trim($part) === "" || $comment !== 1 && strpos($part, '<!--') === 0) {

                if ($comment === 2 && substr($part, -12) === '<![endif]-->') {
                    $output .= $part;
                }
                continue;
            }
            if ($part[0] === '<' && substr($part, -1) === '>') {
                $output .= Minify::fn_minify_html_union($part, $quote);
            } else if ($part[0] === '&' && substr($part, -1) === ';' && $part !== '&lt;' && $part !== '&gt;' && $part !== '&amp;') {
                $output .= html_entity_decode($part);
            } else {
                $output .= preg_replace('#\s+#', ' ', $part);
            }
            $prev = $part;
        }
        $output = str_replace(' </', '</', $output);
        return str_ireplace(['&#x0020;', '&#x20;', '&#x000A;', '&#xA;'], [' ', ' ', "\n", "\n"], trim($output));
    }
    public static function fn_minify_html_union($input, $quote) {
        if (
            strpos($input, ' ') === false &&
            strpos($input, "\n") === false &&
            strpos($input, "\t") === false
        ) return $input;
        global $url;
        return preg_replace_callback('#<\s*([^\/\s]+)\s*(?:>|(\s[^<>]+?)\s*>)#', function($m) use($quote, $url) {
            if (isset($m[2])) {
                if (stripos($m[2], ' style=') !== false) {
                    $m[2] = preg_replace_callback('#( style=)([\'"]?)(.*?)\2#i', function($m) {
                        return $m[1] . $m[2] . Minify::fn_minify_css($m[3]) . $m[2];
                    }, $m[2]);
                }
                if (strpos($m[2], '://') !== false) {
                    $m[2] = str_replace([
                        $url . '/',
                        $url . '?',
                        $url . '&',
                        $url . '#',
                        $url . '"',
                        $url . "'"
                    ], [
                        '/',
                        '?',
                        '&',
                        '#',
                        '/"',
                        "/'"
                    ], $m[2]);
                }
                $a = 'a(sync|uto(focus|play))|c(hecked|ontrols)|d(efer|isabled)|hidden|ismap|loop|multiple|open|re(adonly|quired)|s((cop|elect)ed|pellcheck)';
                $a = '<' . $m[1] . preg_replace([
                    '#\s(' . $a . ')(?:=([\'"]?)(?:true|\1)?\2)#i',
                    '#\s*([^\s=]+?)(=(?:\S+|([\'"]?).*?\3)|$)#',
                    '#\s+\/$#'
                ], [
                    ' $1',
                    ' $1$2',
                    '/'
                ], str_replace("\n", ' ', $m[2])) . '>';
                return $quote !== 1 ? Minify::fn_minify_html_union_attr($a) : $a;
            }
            return '<' . $m[1] . '>';
        }, $input);
    }
    public static function fn_minify_html_union_attr($input) {
        if (strpos($input, '=') === false) return $input;
        return preg_replace_callback('#=(' . MINIFY_STRING . ')#', function($m) {
            $q = $m[1][0];
            if (strpos($m[1], ' ') === false && preg_match('#^' . $q . '[a-zA-Z_][\w-]*?' . $q . '$#', $m[1])) {
                return '=' . t($m[1], $q);
            }
            return $m[0];
        }, $input);
    }
    public static function fn_minify_js($input, $comment = 2, $quote = 2) {
        if (!is_string($input) || !$input = Minify::remove_n(trim($input))) return $input;
        $output = $prev = "";
        foreach (Minify::fn_minify([MINIFY_COMMENT_CSS, MINIFY_STRING, MINIFY_COMMENT_JS, MINIFY_PATTERN_JS], $input) as $part) {
            if (trim($part) === "") continue;
            if ($comment !== 1 && (
                strpos($part, '//') === 0 ||
                strpos($part, '/*') === 0 && substr($part, -2) === '*/'
            )) {
                if (
                    $comment === 2 && (
                        strpos('*!', $part[2]) !== false ||
                        stripos($part, '@licence') !== false || // noun
                        stripos($part, '@license') !== false || // verb
                        stripos($part, '@preserve') !== false
                    )
                ) {
                    $output .= $part;
                }
                continue;
            }
            if ($part[0] === '/' && (substr($part, -1) === '/' || preg_match('#\/[gimuy]*$#', $part))) {
            } else if ($part[0] === '"' && substr($part, -1) === '"' || $part[0] === "'" && substr($part, -1) === "'") {
                $output .= $part;
            } else {
                $output .= Minify::fn_minify_js_union($part);
            }
            $prev = $part;
        }
        return $output;
    }
    public static function fn_minify_js_union($input) {
        return preg_replace([
            '#\s*([!%&*\(\)\-=+\[\]\{\}|;:,.<>?\/])\s*#',
            '#[;,]([\]\}])#',
            '#\btrue\b#', '#\bfalse\b#', '#\b(return\s?)\s*\b#',
            '#\b(?:new\s+)?Array\((.*?)\)#', '#\b(?:new\s+)?Object\((.*?)\)#'
        ], [
            '$1',
            '$1',
            '!0', '!1', '$1',
            '[$1]', '{$1}'
        ], $input);
    }
    public static function minify_css($lot) {
        return Minify::fn_minify_css($lot);
    }
    public static function minify_html($lot) {
        return Minify::fn_minify_html($lot);
    }
    public static function minify_js($lot) {
        return Minify::fn_minify_js($lot);
    }
}
?>