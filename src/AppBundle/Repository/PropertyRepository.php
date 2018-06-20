<?php
    namespace AppBundle\Repository;

    use Doctrine\ORM\EntityRepository;
    class PropertyRepository extends EntityRepository
    {
        public function searchPropertyByText($keywords)
        {
            $stmt = $this->getEntityManager()
                ->getConnection()->prepare("SELECT p.name, p.locality, p.city, p.state, p.country FROM property p WHERE p.status = :active_status AND p.name REGEXP :keywords OR p.city REGEXP :keywords OR p.locality REGEXP :keywords OR p.state REGEXP :keywords OR p.country REGEXP :keywords LIMIT 5");
            $stmt->execute([
                'active_status' => 'active',
                'keywords' => $keywords
            ]);
            return $stmt->fetchAll();
        }
    }