<?php
/**
 * Created by PhpStorm.
 * User: louis
 * Date: 05/11/2017
 * Time: 21:17
 */

namespace App\Associations\Repository;

use App\Associations\Entity\UserAppleAssociation;
use Doctrine\DBAL\Connection;

class UserAppleAssociationRepository
{
    /**
     * @var \Doctrine\DBAL\Connection
     */
    protected $db;

    public function __construct(Connection $db)
    {
        $this->db = $db;
    }

    public function getAll()
    {
        $queryBuilder = $this->db->createQueryBuilder();
        $queryBuilder
            ->select('uha.*')
            ->from('user_has_apple', 'uha');

        $statement = $queryBuilder->execute();
        $userHasAppleList = $statement->fetchAll();
        $userHasAppleEntityList = array();
        foreach ($userHasAppleList as $userHasApple) {
            $userHasAppleEntityList[$userHasApple['id']] = new UserAppleAssociation($userHasApple['id'], $userHasApple['user_id'], $userHasApple['apple_id']);
        }

        return $userHasAppleEntityList;
    }
    
    public function getAllForUser($userId)
    {
        $queryBuilder = $this->db->createQueryBuilder();
        $queryBuilder
            ->select('uha.*')
            ->from('user_has_apple', 'uha')
            ->where('user_id = ?')
            ->setParameter(0, $userId);
            
        $statement = $queryBuilder->execute();
        $userHasAppleList = $statement->fetchAll();
        $userHasAppleEntityList = array();
        foreach ($userHasAppleList as $userHasApple) {
            $userHasAppleEntityList[$userHasApple['id']] = new UserAppleAssociation($userHasApple['id'], $userHasApple['user_id'], $userHasApple['apple_id']);
        }

        return $userHasAppleEntityList;
    }
 
    public function getAllForApple($appleId)
    {
        $queryBuilder = $this->db->createQueryBuilder();
        $queryBuilder
            ->select('uha.*')
            ->from('user_has_apple', 'uha')
            ->where('apple_id = ?')
            ->setParameter(0, $appleId);
            
        $statement = $queryBuilder->execute();
        $userHasAppleList = $statement->fetchAll();
        $userHasAppleEntityList = array();
        foreach ($userHasAppleList as $userHasApple) {
            $userHasAppleEntityList[$userHasApple['id']] = new UserAppleAssociation($userHasApple['id'], $userHasApple['user_id'], $userHasApple['apple_id']);
        }

        return $userHasAppleEntityList;
    }

    public function getById($id)
    {
        $queryBuilder = $this->db->createQueryBuilder();
        $queryBuilder
            ->select('uha.*')
            ->from('user_has_apple', 'uha')
            ->where('id = ?')
            ->setParameter(0, $id);
        $statement = $queryBuilder->execute();
        $userData = $statement->fetchAll();

        return new User($userData[0]['id'], $userData[0]['user_id'], $userData[0]['apple_id']);
    }

    public function delete($id)
    {
        $queryBuilder = $this->db->createQueryBuilder();
        $queryBuilder
            ->delete('user_has_apple')
            ->where('id = :id')
            ->setParameter(':id', $id);

        $statement = $queryBuilder->execute();
    }

    public function update($parameters)
    {
        $queryBuilder = $this->db->createQueryBuilder();
        $queryBuilder
            ->update('user_has_apple')
            ->where('id = :id')
            ->setParameter(':id', $parameters['id']);

        if ($parameters['nom']) {
            $queryBuilder
                ->set('user_id', ':user_id')
                ->setParameter(':user_id', $parameters['user_id']);
        }

        if ($parameters['apple_id']) {
            $queryBuilder
                ->set('apple_id', ':apple_id')
                ->setParameter(':apple_id', $parameters['apple_id']);
        }

        $statement = $queryBuilder->execute();
    }

    public function insert($parameters)
    {

        $queryBuilder = $this->db->createQueryBuilder();
        $queryBuilder
            ->insert('user_has_apple')
            ->values(
                array(
                    'user_id' => ':user_id',
                    'apple_id' => ':apple_id',
                )
            )
            ->setParameter(':user_id', $parameters['user_id'])
            ->setParameter(':apple_id', $parameters['apple_id']);
        $statement = $queryBuilder->execute();
    }

}