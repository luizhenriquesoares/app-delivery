<?php

namespace CodeDelivery\Http\Controllers\Api;

use CodeDelivery\Http\Controllers\Controller;
use CodeDelivery\Repositories\UserRepository;
use LucaDegasperi\OAuth2Server\Facades\Authorizer;

class UserController extends Controller
{

    /**
     * @var UserRepository
     */
    private $repository;

    /**
     * ClientProductController constructor.
     * @param UserRepository $repository
     */
    public function __construct(UserRepository $repository)
   {

       $this->repository = $repository;
   }

    /**
     * @return mixed
     */
    public function authenticated()
    {
        $id = Authorizer::getResourceOwnerId();
        return $this->repository->skipPresenter(false)->find($id);
    }
}
