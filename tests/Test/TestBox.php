<?php
/**
 * Box packing (3D bin packing, knapsack problem).
 *
 * @author Doug Wright
 */
declare(strict_types=1);

namespace DVDoug\BoxPacker\Test;

use DVDoug\BoxPacker\Box;
use DVDoug\BoxPacker\BoxAvailability;
use JsonSerializable;

class TestBox implements Box, JsonSerializable, BoxAvailability
{
    /**
     * @var string
     */
    private $reference;

    /**
     * @var int
     */
    private $outerWidth;

    /**
     * @var int
     */
    private $outerLength;

    /**
     * @var int
     */
    private $outerDepth;

    /**
     * @var int
     */
    private $emptyWeight;

    /**
     * @var int
     */
    private $innerWidth;

    /**
     * @var int
     */
    private $innerLength;

    /**
     * @var int
     */
    private $innerDepth;

    /**
     * @var int
     */
    private $maxWeight;

	/**
	 * @var int|null
	 */
    private $amount;

    /**
     * TestBox constructor.
     *
     * @param string $reference
     * @param int    $outerWidth
     * @param int    $outerLength
     * @param int    $outerDepth
     * @param int    $emptyWeight
     * @param int    $innerWidth
     * @param int    $innerLength
     * @param int    $innerDepth
     * @param int    $maxWeight
     * @param int|null    $amount
     */
    public function __construct(
        string $reference,
        int $outerWidth,
        int $outerLength,
        int $outerDepth,
        int $emptyWeight,
        int $innerWidth,
        int $innerLength,
        int $innerDepth,
        int $maxWeight,
		int $amount = null
    ) {
        $this->reference = $reference;
        $this->outerWidth = $outerWidth;
        $this->outerLength = $outerLength;
        $this->outerDepth = $outerDepth;
        $this->emptyWeight = $emptyWeight;
        $this->innerWidth = $innerWidth;
        $this->innerLength = $innerLength;
        $this->innerDepth = $innerDepth;
        $this->maxWeight = $maxWeight;
        $this->amount = $amount;
    }

    /**
     * @return string
     */
    public function getReference(): string
    {
        return $this->reference;
    }

    /**
     * @return int
     */
    public function getOuterWidth(): int
    {
        return $this->outerWidth;
    }

    /**
     * @return int
     */
    public function getOuterLength(): int
    {
        return $this->outerLength;
    }

    /**
     * @return int
     */
    public function getOuterDepth(): int
    {
        return $this->outerDepth;
    }

    /**
     * @return int
     */
    public function getEmptyWeight(): int
    {
        return $this->emptyWeight;
    }

    /**
     * @return int
     */
    public function getInnerWidth(): int
    {
        return $this->innerWidth;
    }

    /**
     * @return int
     */
    public function getInnerLength(): int
    {
        return $this->innerLength;
    }

    /**
     * @return int
     */
    public function getInnerDepth(): int
    {
        return $this->innerDepth;
    }

    /**
     * @return int
     */
    public function getMaxWeight(): int
    {
        return $this->maxWeight;
    }

	/**
	 * @return int|null
	 */
	public function getAmount(): ?int
	{
		return $this->amount;
	}

	/**
	 */
	public function decreaseAmount(): void
	{
		if ($this->amount !== null)
			$this->amount--;
	}

	/**
     * {@inheritdoc}
     */
    public function jsonSerialize()
    {
        return [
            'reference' => $this->reference,
            'innerWidth' => $this->innerWidth,
            'innerLength' => $this->innerLength,
            'innerDepth' => $this->innerDepth,
            'emptyWeight' => $this->emptyWeight,
            'maxWeight' => $this->maxWeight,
            'amount' => $this->amount,
        ];
    }
}
