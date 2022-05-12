<?php

class Tableheper {

    const SORT_KEY = 'sort';
    const DIR_KEY = 'dir';

    public static function sort(string $sortkey,  string $label, array $data): string 
    {
        $sort = $data[self::SORT_KEY] ?? null;
        $direction = $data[self::DIR_KEY] ?? null;
        return <<<HTML
        <a href="?sort=$sortkey&dir">$label</a>
HTML;
    }
}