<?php namespace App\Http\Controllers\Api;

use App\Http\Requests;
use Mitul\Generator\Utils\ResponseManager;
use App\Models\Order;
use Illuminate\Http\Request;
use App\Libraries\Repositories\OrderRepository;
use Response;

class OrderAPIController extends AppApiBaseController
{

	/** @var  OrderRepository */
	private $orderRepository;

	function __construct(OrderRepository $orderRepo)
	{
		$this->orderRepository = $orderRepo;
	}

	/**
	 * Display a listing of the Order.
	 *
	 * @param Request $request
	 *
	 * @return Response
	 */
	public function index(Request $request)
	{
	    $input = $request->all();

		$result = $this->orderRepository->search($input);

		
		$orders = !empty($input["no_pagination"])?$result[0]->get():$result[0]->paginate();

		return Response::json(ResponseManager::makeResult($orders->toArray(), "Orders retrieved successfully."));
	}

	/**
	 * Show the form for creating a new Order.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created Order in storage.
	 *
	 * @param Request $request
	 *
	 * @return Response
	 */
	public function store(Request $request)
	{
		if(sizeof(Order::$rules) > 0)
            $this->validateRequest($request, Order::$rules);

        $input = $request->all();

		$order = $this->orderRepository->store($input);

		return Response::json(ResponseManager::makeResult($order->toArray(), "Order saved successfully."));
	}

	/**
	 * Display the specified Order.
	 *
	 * @param  int $id
	 *
	 * @return Response
	 */
	public function show($id)
	{
		$order = $this->orderRepository->findOrderById($id);

		if(empty($order))
			$this->throwRecordNotFoundException("Order not found", ERROR_CODE_RECORD_NOT_FOUND);

		return Response::json(ResponseManager::makeResult($order->toArray(), "Order retrieved successfully."));
	}

	/**
	 * Show the form for editing the specified Order.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified Order in storage.
	 *
	 * @param  int    $id
	 * @param Request $request
	 *
	 * @return Response
	 */
	public function update($id, Request $request)
	{
		$order = $this->orderRepository->findOrderById($id);

		if(empty($order))
			$this->throwRecordNotFoundException("Order not found", ERROR_CODE_RECORD_NOT_FOUND);

		$input = $request->all();

		$order = $this->orderRepository->update($order, $input);

		return Response::json(ResponseManager::makeResult($order->toArray(), "Order updated successfully."));
	}

	/**
	 * Remove the specified Order from storage.
	 *
	 * @param  int $id
	 *
	 * @return Response
	 */
	public function destroy($id)
	{
		$order = $this->orderRepository->findOrderById($id);

		if(empty($order))
			$this->throwRecordNotFoundException("Order not found", ERROR_CODE_RECORD_NOT_FOUND);

		$order->delete();

		return Response::json(ResponseManager::makeResult($id, "Order deleted successfully."));
	}
}
