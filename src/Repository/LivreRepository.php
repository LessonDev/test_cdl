<?php

namespace App\Repository;

use App\Entity\Livre;
use App\Data\SearchData;
use Doctrine\Persistence\ManagerRegistry;
use Knp\Component\Pager\PaginatorInterface;
use Knp\Bundle\PaginatorBundle\Pagination\SlidingPagination;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

/**
 * @method Livre|null find($id, $lockMode = null, $lockVersion = null)
 * @method Livre|null findOneBy(array $criteria, array $orderBy = null)
 * @method Livre[]    findAll()
 * @method Livre[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class LivreRepository extends ServiceEntityRepository
{
    public function __construct(
        ManagerRegistry $registry,
        PaginatorInterface $paginator
    ) {
        parent::__construct($registry, Livre::class);
        $this->paginator = $paginator;
    }

    /**
     *  Récupère les livres avec une recherche
     *  @return SlidingPagination
     */
    public function findSearch(SearchData $search): SlidingPagination
    {
        $query = $this->createQueryBuilder('l')
            ->select('a', 'l', 'c')
            ->leftjoin('l.auteur', 'a')
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
                ->andWhere(
                    "DATE_FORMAT(l.datePublication,'%Y') <= :datePublicationMax"
                )
                ->setParameter(
                    'datePublicationMax',
                    $search->datePublicationMax
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

        //return $query->getQuery()->getResult();
        $query = $query->getQuery();
        return $this->paginator->paginate($query, $search->page, 6);
    }
}
