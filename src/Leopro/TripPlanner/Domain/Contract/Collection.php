<?php

namespace Leopro\TripPlanner\Domain\Contract;

use Doctrine\Common\Collections\Collection as DoctrineCollection;

/**
 * I agree with:
 *
 * "The missing (SPL) Collection/Array/OrderedMap interface." (see Doctrine\Common\Collections\Collection)
 *
 * and with:
 *
 * "The Collection interface and ArrayCollection class, [...]
 * it is a plain PHP class that has no outside dependencies apart from dependencies on PHP itself (and the SPL).
 * Therefore using this class in your domain classes and elsewhere does not introduce a coupling to the persistence layer. [...]"
 *
 *
 * Anyway an explicit boundary keeps our domain code more decoupled.
 */
interface Collection extends DoctrineCollection {}