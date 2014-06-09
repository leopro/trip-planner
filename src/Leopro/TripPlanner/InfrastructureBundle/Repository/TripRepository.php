<?php

namespace Leopro\TripPlanner\InfrastructureBundle\Repository;

use Doctrine\ORM\EntityManager;
use Leopro\TripPlanner\Domain\Contract\TripRepository as TripRepositoryInterface;
use Leopro\TripPlanner\Domain\Entity\Trip;
use Leopro\TripPlanner\Domain\ValueObject\TripIdentity;

class TripRepository implements TripRepositoryInterface
{
    private $em;

    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

    /**
     * @param TripIdentity $identity
     * @return \Leopro\TripPlanner\Domain\Entity\Trip
     */
    public function get(TripIdentity $identity)
    {
        $qb = $this->em->createQueryBuilder()
            ->select('t')
            ->from("TripPlannerDomain:Trip", 't')
            ->where('t.identity.id = :identity');

        $qb->setParameter('identity', $identity);

        return $qb->getQuery()->getOneOrNullResult();
    }

    /**
     * @param Trip $trip
     * @return void
     */
    public function add(Trip $trip)
    {
        $this->em->persist($trip);
        $this->em->flush();
    }
} 