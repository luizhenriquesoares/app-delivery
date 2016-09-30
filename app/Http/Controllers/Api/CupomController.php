<?php

namespace CodeDelivery\Http\Controllers\Api;

use CodeDelivery\Http\Controllers\Controller;
use CodeDelivery\Repositories\CupomRepository;

class CupomController extends Controller
{

    /**
     * @var CupomRepository
     */
    private $repository;

    /**
     * ClientProductController constructor.
     * @param CupomRepository $repository
     */
    public function __construct(CupomRepository $repository)
   {

       $this->repository = $repository;
   }


    /**
     * @return mixed
     */
    public function show($code)
    {
        return $this->repository->skipPresenter(false)->findByCode($code);
    }
}
