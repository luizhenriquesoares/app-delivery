<?php
/**
 * Created by PhpStorm.
 * User: Luiz Henrique Soares
 * Date: 23/08/2016
 * Time: 13:53
 */

namespace CodeDelivery\Http\Controllers;


use CodeDelivery\Http\Requests\CreateRequestOrder;
use CodeDelivery\Http\Requests\Request;
use CodeDelivery\Repositories\OrderRepository;
use CodeDelivery\Repositories\UserRepository;

class OrdersController extends Controller
{

    /**
     * @var OrderRepository
     */
    private $orderRepository;

    public function __construct(OrderRepository $orderRepository)
    {

        $this->orderRepository = $orderRepository;
    }

    /**
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $orders = $this->orderRepository->paginate();

        return view('admin.orders.index', compact('orders'));
    }

    /**
     * @param $id
     * @param UserRepository $userRepository
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id, UserRepository $userRepository)
    {
        $list_status = [0 => 'Pendente', 1 => 'A caminho', 2 => 'Entregue', 3 => 'Cancelado'];

        $orders = $this->orderRepository->find($id);

        $deliveryman = $userRepository->getDeliverymen();

        return view('admin.orders.edit', compact('orders', 'list_status', 'deliveryman'));
    }


    public function update(CreateRequestOrder $request, $id)
    {
        $all = $request->all();

        $this->orderRepository->update($all, $id);

        return redirect()->route('admin.orders.index');
    }
}