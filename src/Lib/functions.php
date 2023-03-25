<?php

declare(strict_types=1);

namespace App\Lib;

use function is_array;

/**
 * @template T
 *
 * @param iterable<T> $iterable
 *
 * @return array<T>
 */
function iterable_to_array(iterable $iterable): array
{
    if (is_array($iterable)) {
        return $iterable;
    }

    return iterator_to_array($iterable);
}
