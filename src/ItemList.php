<?php
/**
 * Box packing (3D bin packing, knapsack problem).
 *
 * @author Doug Wright
 */
declare(strict_types=1);

namespace DVDoug\BoxPacker;

use ArrayIterator;
use Countable;
use IteratorAggregate;
use Traversable;
use function array_pop;
use function array_reverse;
use function array_slice;
use function count;
use function end;
use function usort;

/**
 * List of items to be packed, ordered by volume.
 *
 * @author Doug Wright
 */
class ItemList implements Countable, IteratorAggregate
{
    /**
     * List containing items.
     *
     * @var Item[]
     */
    private $list = [];

    /**
     * Has this list already been sorted?
     *
     * @var bool
     */
    private $isSorted = false;

    /**
     * @param Item $item
     */
    public function insert(Item $item): void
    {
        $this->list[] = $item;
    }

    /**
     * Do a bulk insert.
     *
     * @internal
     *
     * @param Item[] $items
     */
    public function insertFromArray(array $items): void
    {
        foreach ($items as $item) {
            $this->insert($item);
        }
    }

    /**
     * Remove item from list.
     *
     * @param Item $item
     */
    public function remove(Item $item): void
    {
        foreach ($this->list as $key => $itemToCheck) {
            if ($itemToCheck === $item) {
                unset($this->list[$key]);
                break;
            }
        }
    }

    /**
     * @internal
     *
     * @return Item
     */
    public function extract(): Item
    {
        if (!$this->isSorted) {
            usort($this->list, [$this, 'compare']);
            $this->isSorted = true;
        }

        return array_pop($this->list);
    }

    /**
     * @internal
     *
     * @return Item
     */
    public function top(): Item
    {
        if (!$this->isSorted) {
            usort($this->list, [$this, 'compare']);
            $this->isSorted = true;
        }
        $temp = $this->list;

        return end($temp);
    }

    /**
     * @internal
     *
     * @param  int      $n
     * @return ItemList
     */
    public function topN(int $n): self
    {
        if (!$this->isSorted) {
            usort($this->list, [$this, 'compare']);
            $this->isSorted = true;
        }

        $topNList = new self();
        $topNList->insertFromArray(array_slice($this->list, -$n, $n));

        return $topNList;
    }

    /**
     * @return Traversable
     */
    public function getIterator(): Traversable
    {
        if (!$this->isSorted) {
            usort($this->list, [$this, 'compare']);
            $this->isSorted = true;
        }

        return new ArrayIterator(array_reverse($this->list));
    }

    /**
     * Number of items in list.
     *
     * @return int
     */
    public function count(): int
    {
        return count($this->list);
    }

    /**
     * @param Item $itemA
     * @param Item $itemB
     *
     * @return int
     */
	/**
	 * @param Item $itemA
	 * @param Item $itemB
	 *
	 * @return int
	 */
	private function compare(Item $itemA, Item $itemB): int
	{
		$volumeDecider = max($itemA->getLength(),$itemA->getWeight(),$itemA->getDepth()) <=> max($itemB->getLength(),$itemB->getWeight(),$itemB->getDepth());

		if ($volumeDecider !== 0){
			return $volumeDecider;
		}
		$weightDecider = $itemA->getWeight() - $itemB->getWeight();

		if ($weightDecider !== 0) {
			return $weightDecider;
		}

		return $itemB->getDescription() <=> $itemA->getDescription();
	}
}
