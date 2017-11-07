<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Customers\Customer;
use App\Models\Customers\Client;

class CustomerController extends Controller
{
    public function index(Request $request)
    {
        return view('customers.customers', ['breadcrumb' => $request->path()]);
    }

    public function all()
    {
        return Customer::with('client')->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string',
        ]);

        $customer = Customer::create([
            'name' => $request->name,
        ])->load('client');

        return $customer;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $q = Customer::find($id);

        if ($q->name != $request->name) {
            $q->name = $request->name;
        }

        $q->save();

        return $q->load('client');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return Customer::destroy($id);
    }

    public function listClients($id)
    {
        return Client::where('customer_id', $id)->get();
    }

    public function storeClient(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string',
            'customer' => 'required',
        ]);

        $client = Client::create([
            'name' => $request->name,
            'email' => $request->email,
            'telephone' => $request->phone,
            'customer_id' => $request->customer,
        ]);

        return $request;
    }
}
