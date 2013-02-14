<?php

class Paginator extends Laravel\Paginator
{
    public static function page($total, $per_page)
    {
        $page = (preg_match('/\/pagina-([0-9]+)/', $_SERVER['REQUEST_URI'], $m)) ? $m[1] : 1;

        if (is_numeric($page) and $page > $last = ceil($total / $per_page))
        {
            return ($last > 0) ? $last : 1;
        }

        return (static::valid($page)) ? $page : 1;
    }

    protected function link($page, $text, $class)
    {
        $current = preg_replace('/\/pagina-([0-9]+)/', '', URI::current());
        $query = '/pagina-'.$page.'/'.$this->appendage($this->appends);

        return HTML::link($current.$query, $text, compact('class'), Request::secure());
    }
}