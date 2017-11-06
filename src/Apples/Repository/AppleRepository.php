<?php

namespace App\Apples\Repository;

use App\Apples\Entity\Apple;
use Doctrine\DBAL\Connection;

/**
 * Apple repository.
 */
class AppleRepository
{
    /**
     * @var \Doctrine\DBAL\Connection
     */
    protected $db;

    public function __construct(Connection $db)
    {
        $this->db = $db;
    }

   /**
    * Returns a collection of apples.
    *
    * @param int $limit
    *   The number of apples to return.
    * @param int $offset
    *   The number of apples to skip.
    * @param array $orderBy
    *   Optionally, the order by info, in the $column => $direction format.
    *
    * @return array A collection of apples, keyed by apple id.
    */
   public function getAll()
   {
       $queryBuilder = $this->db->createQueryBuilder();
       $queryBuilder
           ->select('a.*')
           ->from('apples', 'a');

       $statement = $queryBuilder->execute();
       $applesData = $statement->fetchAll();
       $appleEntityList = array();
       foreach ($applesData as $appleData) {
           $appleEntityList[$appleData['id']] = new Apple($appleData['id'], $appleData['variety'], $appleData['price']);
       }

       return $appleEntityList;
   }

   /**
    * Returns an Apple object.
    *
    * @param $id
    *   The id of the apple to return.
    *
    * @return array A collection of apples, keyed by apple id.
    */
   public function getById($id)
   {
       $queryBuilder = $this->db->createQueryBuilder();
       $queryBuilder
           ->select('a.*')
           ->from('apples', 'a')
           ->where('id = ?')
           ->setParameter(0, $id);
       $statement = $queryBuilder->execute();
       $appleData = $statement->fetchAll();

       if (!empty($appleData)) {
           return new Apple($appleData[0]['id'], $appleData[0]['variety'], $appleData[0]['price']);
       }

       return null;

   }

    public function delete($id)
    {
        $queryBuilder = $this->db->createQueryBuilder();
        $queryBuilder
          ->delete('apples')
          ->where('id = :id')
          ->setParameter(':id', $id);

        $statement = $queryBuilder->execute();
    }

    public function update($parameters)
    {
        $queryBuilder = $this->db->createQueryBuilder();
        $queryBuilder
          ->update('apples')
          ->where('id = :id')
          ->setParameter(':id', $parameters['id']);

        if ($parameters['price']) {
            $queryBuilder
              ->set('price', ':price')
              ->setParameter(':price', $parameters['price']);
        }

        if ($parameters['variety']) {
            $queryBuilder
            ->set('variety', ':variety')
            ->setParameter(':variety', $parameters['variety']);
        }

        $statement = $queryBuilder->execute();
    }

    public function insert($parameters)
    {
        $queryBuilder = $this->db->createQueryBuilder();
        $queryBuilder
          ->insert('apples')
          ->values(
              array(
                'price' => ':price',
                'variety' => ':variety',
              )
          )
          ->setParameter(':price', $parameters['price'])
          ->setParameter(':variety', $parameters['variety']);
        $statement = $queryBuilder->execute();
    }
}
