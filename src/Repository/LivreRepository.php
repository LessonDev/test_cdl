<?php

namespace App\Repository;

use App\Entity\Livre;
use App\Data\SearchData;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

/**
 * @method Livre|null find($id, $lockMode = null, $lockVersion = null)
 * @method Livre|null findOneBy(array $criteria, array $orderBy = null)
 * @method Livre[]    findAll()
 * @method Livre[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class LivreRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Livre::class);
    }

    /**
     *  Récupère les livres avec une recherche
     *  @return Livres
     */
    public function findSearch(SearchData $search): array
    {
        $query = $this->createQueryBuilder('l')
            ->select('a', 'l', 'c')
            ->join('l.auteur', 'a')
            ->join('l.categorie', 'c')
            ->orderBy('l.id', 'ASC');

        if (!empty($search->q)) {
            $query = $query
                ->andWhere('l.title LIKE :q')
                ->setParameter('q', "%{$search->q}%");
        }

        if (!empty($search->datePublicationMin)) {
            $query = $query
                ->andWhere('l.datePublication >= :datePublicationMin')
                ->setParameter(
                    'datePublicationMin',
                    $search->datePublicationMin
                );
        }

        if (!empty($search->datePublicationMax)) {
            $query = $query
                ->andWhere('l.datePublication <= :datePublicationMax')
                ->setParameter(
                    'datePublicationMax',
                    $search->datePublicationMax->modify('+1 year')->format('Y')
                );
        }

        if (!empty($search->auteur)) {
            $query = $query
                ->andWhere('a.id IN (:auteur)')
                ->setParameter('auteur', $search->auteur);
        }

        if (!empty($search->categorie)) {
            $query = $query
                ->andWhere('c.id IN (:categorie)')
                ->setParameter('categorie', $search->categorie);
        }

        return $query->getQuery()->getResult();
    }
}
