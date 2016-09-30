<?php

namespace CodeDelivery\Http\Controllers;


use CodeDelivery\Http\Requests\CreateRequestCheckout;
use CodeDelivery\Repositories\OrderRepository;
use CodeDelivery\Repositories\ProductRepository;
use CodeDelivery\Repositories\UserRepository;
use CodeDelivery\Services\OrderService;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    /**
     * @var UserRepository
     */
    private $userRepository;
    /**
     * @var ProductRepository
     */
    private $productRepository;
    /**
     * @var OrderRepository
     */
    private $orderRepository;
    /**
     * @var OrderService
     */
    private $orderService;

    public function __construct(OrderService $orderService, UserRepository $userRepository, ProductRepository $productRepository, OrderRepository $orderRepository)
   {
       $this->userRepository = $userRepository;
       $this->productRepository = $productRepository;
       $this->orderRepository = $orderRepository;
       $this->orderService = $orderService;
   }

   public function index()
   {
       $clientId = $this->userRepository->find(Auth::user()->id)->client->id;
       $orders = $this->orderRepository->scopeQuery(function($query) use ($clientId){
        return $query->where('client_id', '=',  $clientId);
     })->paginate();

       return view('costumer.order.index', compact('orders'));
   }
   public function create()
   {
       $products = $this->productRepository->listar();

        return view('costumer.order.create', compact('products'));
   }

   public function store(CreateRequestCheckout $createRequestCheckout)
   {
       $data = $createRequestCheckout->all();
       $clientId = $this->userRepository->find(Auth::user()->id)->client->id;
       $data['client_id'] = $clientId;
       $this->orderService->create($data);

       return redirect()->route('costumer.order.index');

   }
}
