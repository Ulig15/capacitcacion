<?php

namespace AppBundle\Repository;

use Doctrine\ORM\EntityRepository;

class TeamRepository extends EntityRepository
{
	public function exist($team)
    {
    	return $this->createQueryBuilder('t')
            ->select('t')
            ->where('t.name LIKE :name')
            ->setParameter('name', $team->getName())
            ->setMaxResults(1)
            ->getQuery()
            ->getResult();
    }

    /**
     * DEVUELVE LOS DATOS PARA LA TABLA DE POSICIONES
    */
    public function calculateTeamPoints()
    {
        return $this->createQueryBuilder('t')
            ->select('t.name AS nombre,
                COUNT(m.id) as partidos_jugados,
                SUM(m.localgoals) as goles_a_favor,
                SUM(m.visitgoals) as goles_en_contra,
                SUM(CASE
                WHEN m.localteam = t AND m.localgoals > m.visitgoals THEN 3
                WHEN m.visitteam = t AND m.visitgoals > m.localgoals THEN 3
                WHEN m.localgoals = m.visitgoals THEN 1
                ELSE 0
            END) AS puntos')
            ->leftJoin('AppBundle\Entity\Matches', 'm', 'WITH', 'm.localteam = t OR m.visitteam = t')
            ->groupBy('t.name')
            ->orderBy('puntos', 'DESC')
            ->getQuery()
            ->getResult();
    }
}