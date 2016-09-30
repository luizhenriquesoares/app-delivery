<?php

namespace CodeDelivery\Repositories;

use CodeDelivery\Presenters\OrderPresenter;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use CodeDelivery\Models\Order;
use CodeDelivery\Validators\OrderValidator;

/**
 * Class OrderRepositoryEloquent
 * @package namespace CodeDelivery\Repositories;
 */
class OrderRepositoryEloquent extends BaseRepository implements OrderRepository
{
    protected $skipPresenter = true;

    public function getByIdAndClient($id, $idClient)
    {
        $result = $this->model
            ->where('id', $id)
            ->where('client_id', $idClient)
            ->first();

        if($result){
            return $this->parserResult($result);

        }

        throw (new ModelNotFoundException())->setModel($this->model());
    }

    public function getByIdDeliveryMan($id, $idDeliveryman)
    {

        $result = $this->model
            ->where('id', $id)
            ->where('user_deliveryman_id', $idDeliveryman)
            ->first();

        if($result){
           return $this->parserResult($result);

        }

        throw (new ModelNotFoundException())->setModel($this->model());
    }

    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Order::class;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    public function presenter()
    {
         return OrderPresenter::class;
    }
}
