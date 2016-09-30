<?php

namespace CodeDelivery\Http\Controllers\Api\Client;

use CodeDelivery\Http\Controllers\Controller;
use CodeDelivery\Http\Requests\CreateRequestCheckout;
use CodeDelivery\Repositories\OrderRepository;
use CodeDelivery\Repositories\UserRepository;
use CodeDelivery\Services\OrderService;
use LucaDegasperi\OAuth2Server\Facades\Authorizer;

class ClientCheckoutController extends Controller
{
    /**
     * @var UserRepository
     */
    private $userRepository;

    /**
     * @var OrderRepository
     */
    private $orderRepository;
    /**
     * @var OrderService
     */
    private $orderService;


    public function __construct(OrderService $orderService,
                                UserRepository $userRepository,
                                OrderRepository $orderRepository)
   {
       $this->userRepository = $userRepository;
       $this->orderRepository = $orderRepository;
       $this->orderService = $orderService;
   }

   public function index()
   {
       $id = Authorizer::getResourceOwnerId();
       $clientId = $this->userRepository->find($id)->client->id;
       $orders = $this->orderRepository
           ->skipPresenter(false)
           ->scopeQuery(function($query) use ($clientId){
        return $query->where('client_id', '=',  $clientId);
     })->paginate();

       return $orders;
   }

   public function store(CreateRequestCheckout $request)
   {
       $data = $request->all();
       $id = Authorizer::getResourceOwnerId();
       $clientId = $this->userRepository->find($id)->client->id;
       $data['client_id'] = $clientId;
       $order = $this->orderService->create($data);

        return $this->orderRepository
           ->skipPresenter(false)
           ->find($order->id);
   }

   public function show($id)
   {
       $idClient = Authorizer::getResourceOwnerId();
       return $this->orderRepository->with(['items', 'cupom'])
              ->skipPresenter(false)
              ->getByIdAndClient($id, $idClient);
   }
}
