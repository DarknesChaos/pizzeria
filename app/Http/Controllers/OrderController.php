<?php

namespace App\Http\Controllers;

use App\Order;
use App\Pizza;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;

class OrderController extends Controller
{
    /**
     * OrderController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function home()
    {
        return view('vueApp');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return Order::select('orders.id', 'orders.date', 'orders.total', 'users.name as employee')
            ->join('users', 'users.id', '=', 'orders.employee_id')->get();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'pizza_id' => 'required',
            'size' => 'required',
            'quantity' => 'required',
            'date' => 'required|date|date_format:Y/m/d',
        ]);

        $data = Input::all();
        $data['total'] = str_replace(",", "", $data['total']);
        $data['date'] = Carbon::parse($data['date'])->format('Y-m-d');

        $quantity = $data['quantity'];
        $pizza_id = $data['pizza_id'];
        $data['employee_id'] = Auth::user()->id;

        $order = Order::create($data);

        $order->products()->attach($pizza_id, [
            'quantity' => $quantity
        ]);

        return response()->json(['success'=>'Done!']);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function getPizzas()
    {
        $pizzas = Pizza::all();
        return $pizzas;
    }

    public function checkUserAuth()
    {
        return Auth::user()->role;
    }

    public function getPrice($id)
    {
        $pizza = Pizza::find($id)->price;
        return $pizza;
    }

    public function getSize($id)
    {
        $pizza = Pizza::where('id', $id)->get();
        return $pizza;
    }
}
