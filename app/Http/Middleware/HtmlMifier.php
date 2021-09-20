<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;



class HtmlMifier
{
    public function handle($request, Closure $next)
    {
  
        $response = $next($request);

        $contentType = $response->headers->get('Content-Type');
        if (strpos($contentType, 'text/html') !== false) {
            $response->setContent($this->minify($response->getContent()));
        }

        return $response;

    }

    public function minify($input)
    {

        $replace = [
            '/\>[^\S ]+/s'   => '>', //remove tabs before and after HTML tags
            '/[^\S ]+\</s'   => '<', //
            '/([\t ])+/s'  => ' ', //shorten multiple whitespace sequences; keep new-line characters because they matter in JS!!!
            '/^([\t ])+/m' => '', //remove leading and trailing spaces
            '/([\t ])+$/m' => '', //
            //'~//[a-zA-Z0-9 ]+$~m' => '', // remove JS line comments (simple only); do NOT remove lines containing URL (e.g. 'src="http://server.com/"')!!!
            '/[\r\n]+([\t ]?[\r\n]+)+/s'  => "\n", //remove empty lines (sequence of line-end and white-space characters) 
            '/\>[\r\n\t ]+\</s'    => '><', //remove empty lines (between HTML tags); cannot remove just any line-end characters because in inline JS they can matter!
            '/}[\r\n\t ]+/s'  => '}', //remove "empty" lines containing only JS's block end character; join with next line (e.g. "}\n}\n</script>" --> "}}</script>"
            '/}[\r\n\t ]+,[\r\n\t ]+/s'  => '},', //
            '/\)[\r\n\t ]?{[\r\n\t ]+/s'  => '){', //remove new-line after JS's function or condition start; join with next line
            '/,[\r\n\t ]?{[\r\n\t ]+/s'  => ',{', //
            '/\),[\r\n\t ]+/s'  => '),', //remove new-line after JS's line end (only most obvious and safe cases)
            //'~([\r\n\t ])?([a-zA-Z0-9]+)="([a-zA-Z0-9_/\\-]+)"([\r\n\t ])?~s' => '$1$2=$3$4', //remove quotes from HTML attributes that does not contain spaces; keep quotes around URLs!
            //$1 and $4 insert first white-space character found before/after attribute
            //'/\s*([{}])\s+/'  => ' $1',
            //'/;+\}/'  => '}', // remove unnecessary semicolons
            //'/([\!\{\}\:;\>\+\(\[\~\=,])\s+/S' => '$1', // Remove the spaces after the things that should not have spaces after them.
            //'/<style[^>]*>([\s\S]*?)<\/style>/' => '$2'
        ];
        //return preg_replace(array_keys($replace), array_values($replace), $input);
        $html = preg_replace(array_keys($replace), array_values($replace), $input);
        return $html;

    }
}

/*
class HtmlMifier
{
    public function handle($request, Closure $next)
    {
  
        $response = $next($request);

        $contentType = $response->headers->get('Content-Type');
        if (strpos($contentType, 'text/html') !== false) {
            $response->setContent($this->minify_html($response->getContent()));
        }

        return $response;

    }
    
    // HTML Minifier
    public function minify_html($input) {
        if(trim($input) === "") return $input;
        // Remove extra white-space(s) between HTML attribute(s)
        $input = preg_replace_callback('#<([^\/\s<>!]+)(?:\s+([^<>]*?)\s*|\s*)(\/?)>#s', function($matches) {
            return '<' . $matches[1] . preg_replace('#([^\s=]+)(\=([\'"]?)(.*?)\3)?(\s+|$)#s', ' $1$2', $matches[2]) . $matches[3] . '>';
        }, str_replace("\r", "", $input));
        // Minify inline CSS declaration(s)
        if(strpos($input, ' style=') !== false) {
            $input = preg_replace_callback('#<([^<]+?)\s+style=([\'"])(.*?)\2(?=[\/\s>])#s', function($matches) {
                return '<' . $matches[1] . ' style=' . $matches[2] . minify_css($matches[3]) . $matches[2];
            }, $input);
        }
        if(strpos($input, '</style>') !== false) {
        $input = preg_replace_callback('#<style(.*?)>(.*?)</style>#is', function($matches) {
            return '<style' . $matches[1] .'>'. minify_css($matches[2]) . '</style>';
        }, $input);
        }
        if(strpos($input, '</script>') !== false) {
        $input = preg_replace_callback('#<script(.*?)>(.*?)</script>#is', function($matches) {
            return '<script' . $matches[1] .'>'. minify_js($matches[2]) . '</script>';
        }, $input);
        }

        return preg_replace(
            array(
                // t = text
                // o = tag open
                // c = tag close
                // Keep important white-space(s) after self-closing HTML tag(s)
                '#<(img|input)(>| .*?>)#s',
                // Remove a line break and two or more white-space(s) between tag(s)
                '#(<!--.*?-->)|(>)(?:\n*|\s{2,})(<)|^\s*|\s*$#s',
                '#(<!--.*?-->)|(?<!\>)\s+(<\/.*?>)|(<[^\/]*?>)\s+(?!\<)#s', // t+c || o+t
                '#(<!--.*?-->)|(<[^\/]*?>)\s+(<[^\/]*?>)|(<\/.*?>)\s+(<\/.*?>)#s', // o+o || c+c
                '#(<!--.*?-->)|(<\/.*?>)\s+(\s)(?!\<)|(?<!\>)\s+(\s)(<[^\/]*?\/?>)|(<[^\/]*?\/?>)\s+(\s)(?!\<)#s', // c+t || t+o || o+t -- separated by long white-space(s)
                '#(<!--.*?-->)|(<[^\/]*?>)\s+(<\/.*?>)#s', // empty tag
                '#<(img|input)(>| .*?>)<\/\1>#s', // reset previous fix
                '#(&nbsp;)&nbsp;(?![<\s])#', // clean up ...
                '#(?<=\>)(&nbsp;)(?=\<)#', // --ibid
                // Remove HTML comment(s) except IE comment(s)
                '#\s*<!--(?!\[if\s).*?-->\s*|(?<!\>)\n+(?=\<[^!])#s'
            ),
            array(
                '<$1$2</$1>',
                '$1$2$3',
                '$1$2$3',
                '$1$2$3$4$5',
                '$1$2$3$4$5$6$7',
                '$1$2$3',
                '<$1$2',
                '$1 ',
                '$1',
                ""
            ),
        $input);
    }

    // CSS Minifier => http://ideone.com/Q5USEF + improvement(s)
    public function minify_css($input) {
        if(trim($input) === "") return $input;
        return preg_replace(
            array(
                // Remove comment(s)
                '#("(?:[^"\\\]++|\\\.)*+"|\'(?:[^\'\\\\]++|\\\.)*+\')|\/\*(?!\!)(?>.*?\*\/)|^\s*|\s*$#s',
                // Remove unused white-space(s)
                '#("(?:[^"\\\]++|\\\.)*+"|\'(?:[^\'\\\\]++|\\\.)*+\'|\/\*(?>.*?\*\/))|\s*+;\s*+(})\s*+|\s*+([*$~^|]?+=|[{};,>~]|\s(?![0-9\.])|!important\b)\s*+|([[(:])\s++|\s++([])])|\s++(:)\s*+(?!(?>[^{}"\']++|"(?:[^"\\\]++|\\\.)*+"|\'(?:[^\'\\\\]++|\\\.)*+\')*+{)|^\s++|\s++\z|(\s)\s+#si',
                // Replace `0(cm|em|ex|in|mm|pc|pt|px|vh|vw|%)` with `0`
                '#(?<=[\s:])(0)(cm|em|ex|in|mm|pc|pt|px|vh|vw|%)#si',
                // Replace `:0 0 0 0` with `:0`
                '#:(0\s+0|0\s+0\s+0\s+0)(?=[;\}]|\!important)#i',
                // Replace `background-position:0` with `background-position:0 0`
                '#(background-position):0(?=[;\}])#si',
                // Replace `0.6` with `.6`, but only when preceded by `:`, `,`, `-` or a white-space
                '#(?<=[\s:,\-])0+\.(\d+)#s',
                // Minify string value
                '#(\/\*(?>.*?\*\/))|(?<!content\:)([\'"])([a-z_][a-z0-9\-_]*?)\2(?=[\s\{\}\];,])#si',
                '#(\/\*(?>.*?\*\/))|(\burl\()([\'"])([^\s]+?)\3(\))#si',
                // Minify HEX color code
                '#(?<=[\s:,\-]\#)([a-f0-6]+)\1([a-f0-6]+)\2([a-f0-6]+)\3#i',
                // Replace `(border|outline):none` with `(border|outline):0`
                '#(?<=[\{;])(border|outline):none(?=[;\}\!])#',
                // Remove empty selector(s)
                '#(\/\*(?>.*?\*\/))|(^|[\{\}])(?:[^\s\{\}]+)\{\}#s'
            ),
            array(
                '$1',
                '$1$2$3$4$5$6$7',
                '$1',
                ':0',
                '$1:0 0',
                '.$1',
                '$1$3',
                '$1$2$4$5',
                '$1$2$3',
                '$1:0',
                '$1$2'
            ),
        $input);
    }

    // JavaScript Minifier
    public function minify_js($input) {
        if(trim($input) === "") return $input;
        return preg_replace(
            array(
                // Remove comment(s)
                '#\s*("(?:[^"\\\]++|\\\.)*+"|\'(?:[^\'\\\\]++|\\\.)*+\')\s*|\s*\/\*(?!\!|@cc_on)(?>[\s\S]*?\*\/)\s*|\s*(?<![\:\=])\/\/.*(?=[\n\r]|$)|^\s*|\s*$#',
                // Remove white-space(s) outside the string and regex
                '#("(?:[^"\\\]++|\\\.)*+"|\'(?:[^\'\\\\]++|\\\.)*+\'|\/\*(?>.*?\*\/)|\/(?!\/)[^\n\r]*?\/(?=[\s.,;]|[gimuy]|$))|\s*([!%&*\(\)\-=+\[\]\{\}|;:,.<>?\/])\s*#s',
                // Remove the last semicolon
                '#;+\}#',
                // Minify object attribute(s) except JSON attribute(s). From `{'foo':'bar'}` to `{foo:'bar'}`
                '#([\{,])([\'])(\d+|[a-z_][a-z0-9_]*)\2(?=\:)#i',
                // --ibid. From `foo['bar']` to `foo.bar`
                '#([a-z0-9_\)\]])\[([\'"])([a-z_][a-z0-9_]*)\2\]#i'
            ),
            array(
                '$1',
                '$1$2',
                '}',
                '$1$3',
                '$1.$3'
            ),
        $input);
    }


}
*/