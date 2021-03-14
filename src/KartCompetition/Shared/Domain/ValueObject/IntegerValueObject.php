<?php

declare(strict_types=1);

namespace DevAway\KartCompetition\Shared\Domain\ValueObject;

abstract class IntegerValueObject
{
    /**
     * @var int
     */
    protected $value;

    /**
     * IntegerValueObject constructor.
     * @param int $value
     */
    protected function __construct(int $value)
    {
        $this->value = $value;
    }

    /**
     * @param int|null $value
     * @return static|null
     */
    public static function fromInt(?int $value): ?self
    {
        if (is_null($value)) {
            return null;
        }

        return new static($value);
    }

    /**
     * @return int
     */
    public function value(): int
    {
        return $this->value;
    }
}
