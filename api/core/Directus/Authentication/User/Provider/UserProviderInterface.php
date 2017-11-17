<?php

namespace Directus\Authentication\User\Provider;

use Directus\Authentication\User\User;
use Directus\Authentication\User\UserInterface;
use Directus\Database\TableGateway\DirectusUsersTableGateway;

interface UserProviderInterface
{
    /**
     * TODO: This will move to provider repository
     *
     * @var int
     */
    const STATUS_ACTIVE = DirectusUsersTableGateway::STATUS_ACTIVE;

    /**

     * @param array $conditions
     *
     * @return User
     */
    public function findWhere(array $conditions);

    /**
     * Finds a user by with the given email
     *
     * @param string $email
     *
     * @return User
     */
    public function findByEmail($email);

    /**
     * Finds a user by with the given id
     *
     * @param int $id
     *
     * @return User
     */
    public function find($id);

    /**
     * Updates the token, salt and last login attribute
     *
     * @param UserInterface $user
     * @return bool
     */
    public function update($user);
}
