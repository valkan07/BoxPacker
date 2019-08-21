<?php

declare(strict_types=1);

namespace DVDoug\BoxPacker;

/**
 * Box availability interface
 *
 * @author Valentin Kanyuk
 */
interface BoxAvailability
{
	/**
	 * Maximum amount of available items, null if is not limited
	 *
	 * @return int
	 */
    public function getAmount(): ?int;

	/**
	 * Decrease amount of available boxes
	 */
    public function decreaseAmount(): void;

}
