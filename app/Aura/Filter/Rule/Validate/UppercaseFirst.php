<?php
/**
 *
 * This file is part of Aura for PHP.
 *
 * @license http://opensource.org/licenses/bsd-license.php BSD
 *
 */
namespace App\Aura\Filter\Rule\Validate;

use App\Aura\Filter\Rule\AbstractCharCase;

/**
 *
 * Validates that the string begins with uppercase.
 *
 * @package Aura.Filter
 *
 */
class UppercaseFirst extends AbstractCharCase
{
    /**
     *
     * Validates that the string begins with lowercase.
     *
     * @param object $subject The subject to be filtered.
     *
     * @param string $field The subject field name.
     *
     * @return bool True if valid, false if not.
     *
     */
    public function __invoke($subject, $field)
    {
        $value = $subject->$field;
        if (! is_scalar($value)) {
            return false;
        }

        return $this->ucfirst($value) == $value;
    }
}
