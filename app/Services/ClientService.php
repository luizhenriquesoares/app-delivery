<?php
/**
 * Created by PhpStorm.
 * User: Yoda
 * Date: 22/08/2016
 * Time: 23:56
 */

namespace CodeDelivery\Services;

use CodeDelivery\Repositories\ClientRepository;
use CodeDelivery\Repositories\UserRepository;

class ClientService
{
    /**
     * @var ClientRepository
     */
    private $clientRepository;

    /**
     * @var $userRepository
     */
    private $userRepository;

    /**
     * ClientService constructor.
     * @param ClientRepository $clientRepository
     * @param UserRepository $userRepository
     */
    public function __construct(ClientRepository $clientRepository, UserRepository $userRepository)
    {
        $this->clientRepository = $clientRepository;
        $this->userRepository = $userRepository;
    }

    /**
     * @param array $data
     * @param $id
     */
    public function update(array $data, $id)
    {
        $this->clientRepository->update($data, $id);

        $userId = $this->clientRepository->find($id, ['user_id'])->user_id;

        $this->userRepository->update($data['user'], $userId);
    }

    /**
     * @param array $data
     */
    public function create(array $data)
    {
        $data['user']['password'] = bcrypt(1233456);

        $user = $this->userRepository->create($data['user']);

        $data['user_id'] = $user->id;
        $this->clientRepository->create($data);
    }

}