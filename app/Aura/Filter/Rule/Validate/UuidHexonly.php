<?php
/**
 *
 * This file is part of Aura for PHP.
 *
 * @license http://opensource.org/licenses/bsd-license.php BSD
 *
 */
namespace App\Aura\Filter\Rule\Validate;

use App\Aura\Filter\Rule\AbstractUuid;

/**
 *
 * Validates that the value is a hex-only UUID.
 *
 * @package Aura.Filter
 *
 */
class UuidHexonly extends AbstractUuid
{
    /**
     *
     * Validates that the value is a hex-only UUID.
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
        return $this->isHexOnly($subject->$field);
    }
}
