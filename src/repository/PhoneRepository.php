<?php
/**
 * PhoneRepository.php
 *
 * @author      Pereskokov Yurii
 * @copyright   2020 Pereskokov Yurii
 * @license     The MIT License (MIT) http://opensource.org/licenses/mit-license.php
 * @link        https://github.com/pers1307/phone-book
 */

namespace pers1307\phoneBook\repository;

use pers1307\phoneBook\db\MySqlConnection;
use pers1307\phoneBook\entity\Phone;

class PhoneRepository
{
    /**
     * @param Phone $phone
     *
     * @return Phone
     */
    public function insert($phone)
    {
        $connection = (new MySqlConnection())->getConnection();

        $stmt = $connection->prepare(
            'INSERT INTO phones(`name`, `surname`, `phone`, `email`, `path_image`, `userId`)
            VALUES (:name, :surname, :phone, :email, :path_image, :userId)'
        );

        $stmt->execute([
            'name'       => $phone->getName(),
            'surname'    => $phone->getSurname(),
            'phone'      => $phone->getPhone(),
            'email'      => $phone->getEmail(),
            'path_image' => $phone->getPathImage(),
            'userId'     => $phone->getUserId()
        ]);

        $phone
            ->setId($connection->lastInsertId());

        return $phone;
    }

    /**
     * @param int $id
     *
     * @return Phone
     */
    public function findById($id)
    {
        $forConnect = new MySqlConnection();
        $connection = $forConnect->getConnection();

        $stmt = $connection->prepare('SELECT * FROM phones WHERE id = :id');
        $stmt->bindParam('id', $id, \PDO::PARAM_INT);
        $stmt->execute();
        $found = $stmt->fetch();

        if (!$found) {
            return null;
        }

        $resultArticle = $this->inflate($found);

        return $resultArticle;
    }

    /**
     * @param $userId
     *
     * @return array
     */
    public function findAllByUserId($userId)
    {
        $connection = (new MySqlConnection())->getConnection();

        $stmt = $connection->prepare('SELECT * FROM phones WHERE userId = :userId');
        $stmt->bindParam('userId', $userId, \PDO::PARAM_INT);
        $stmt->execute();

        $allPhones = $stmt->fetchAll();
        $resultArray = [];

        foreach ($allPhones as $row) {
            $resultArray[] = $this->inflate($row);
        }

        return $resultArray;
    }

    /**
     * @param $id
     */
    public function removeById($id)
    {
        $ForConnect = new MySqlConnection();
        $connection = $ForConnect->getConnection();

        $stmt = $connection->prepare(
            'DELETE FROM phones WHERE id = :id'
        );

        $stmt->execute([
            'id' => $id
        ]);
    }

    /**
     * @param Phone $phone
     */
    public function update($phone)
    {
        $ForConnect = new MySqlConnection();
        $connection = $ForConnect->getConnection();

        if (is_null($phone->getPathImage())) {
            $stmt = $connection->prepare(
                'UPDATE phones
            SET 
            name = :name,
            surname = :surname,
            phone = :phone,
            email = :email
            WHERE
            id = :id'
            );

            $stmt->execute([
                'name'       => $phone->getName(),
                'surname'    => $phone->getSurname(),
                'phone'      => $phone->getPhone(),
                'email'      => $phone->getEmail(),
                'id'         => $phone->getId()
            ]);

            return;
        }

        $stmt = $connection->prepare(
            'UPDATE phones
            SET 
            name = :name,
            surname = :surname,
            phone = :phone,
            email = :email,
            path_image = :path_image
            WHERE
            id = :id'
        );

        $stmt->execute([
            'name'       => $phone->getName(),
            'surname'    => $phone->getSurname(),
            'phone'      => $phone->getPhone(),
            'email'      => $phone->getEmail(),
            'path_image' => $phone->getPathImage(),
            'id'         => $phone->getId()
        ]);
    }

    /**
     * @param array $phoneRow
     *
     * @return Phone
     */
    protected function inflate($phoneRow)
    {
        return (new Phone())
            ->setId($phoneRow['id'])
            ->setName($phoneRow['name'])
            ->setSurname($phoneRow['surname'])
            ->setPhone($phoneRow['phone'])
            ->setEmail($phoneRow['email'])
            ->setPathImage($phoneRow['path_image']);
    }
}