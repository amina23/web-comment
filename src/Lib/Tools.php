<?php

namespace App\Lib;

class Tools
{
    /**
     * @template T
     *
     * @param iterable<T> $iterable
     *
     * @return array<T>
     */
    public static function iterable_to_array(iterable $iterable): array
    {
        if (is_array($iterable)) {
            return $iterable;
        }

        return iterator_to_array($iterable);
    }
}
