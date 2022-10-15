<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class CustomerController extends Controller
{
    public function register(){
        return view('customer.register');
    }

    public function create(Request $request)
    {   $validator = Validator::make($request->all(),[
        'userName'=>'required',
        'userEmail'=>'required',
        'userAddress'=>'required',
        'userGender'=>'required',
        'dateOfBirth'=>'required',
        'userPhoneNumber'=>'required',
    ],['name.required' => "Please Enter Name....."]);// can fill desired noti

    if ($validator->fails()){
        return redirect()->route('customer#register')
        ->withErrors($validator)
        ->withInput();
    }
        $data = $this->getCustomerData($request);
        //insert data to database by Model View Controller MVC
        //create
        Customer::create($data);//model call and data must be array format
        return back()->with(['insertSuccess'=>'User Information Recorded....']);
    }
    public function list(){
        $data = Customer::paginate(10);// result is obj type
        /*foreach($data as $item){ // all data in db get in $data
            dd($item->name);
        }*/

        return view('customer.list') -> with(['customer' => $data]);
    }


    function seemore($id){

      $data = Customer::where('customer_id',$id)->get();//return obj and first() does not need [0]
      //dd($data->toArray());
      return view('customer.seemore') ->with(['customer'=> $data]);

      /*
      //we can use this form
      $data = Customer::where('customer_id',$id)->get()->toArray();//return array and first() does not need [0]
      return view('customer.seemore') ->with(['customer'=> $data]);
      //seemore.blade.php
    <label>ID</label>:<label>{{ $customer['customer_id'] }}</label>
    <a href="{{ url('customer/seemore/'.$item->customer_id) }}
      */
    }
    public function delete($id){
        Customer::where('customer_id',$id)->delete();
        return back()->with(['deleteSuccess'=>'Customer Data Deleted']);
    }
    public function edit($id){
       $data = Customer::where('customer_id',$id)->first();
       return view('customer.edit') -> with(['customer' => $data]);
       //return veiw('customer.edit')->with(['customer'=>$data]);

    }
    public function update($id,Request $request){
        $validator = Validator::make($request->all(),[
            'userName'=>'required',
            'userEmail'=>'required',
            'userAddress'=>'required',
            'userGender'=>'required',
            'dateOfBirth'=>'required',
            'userPhoneNumber'=>'required',
        ]);

        if ($validator->fails()){
            return back()
            ->withErrors($validator)
            ->withInput();
        }
        $updateData = $this->getCustomerData($request);
        //Customer::where('customer_id',$id)->update($updateData);
        //return back()->with(['updateSuccess' => 'Customer Data Updated!..']);
        $updateData['id'] =$id;
        Session::put('CUSTOMER_DATA',$updateData);//array
        return redirect()->route('customer#confirm');
    }

    public function confirm(){
        $data=Session::get('CUSTOMER_DATA');
        return view('customer.confirm')->with(['customer'=>$data]);
    }

    public function realUpdate(){
        $data=Session::get('CUSTOMER_DATA');
        $id=$data['id'];
        unset($data['id']);//remove id in data arrray
        Session::forget('CUSTOMER_DATA');//delete session
        Customer::where('customer_id',$id)->update($data);
        return redirect()->route('customer#list')->with(['updateSuccess'=>'Customer Updated!']);
    }


        private function getCustomerData($request){
            return[
                'name'=>$request->userName,
                'email'=>$request->userEmail,
                'address'=>$request->userAddress,
                'gender'=>$request->userGender,
                'date_of_birth'=>$request->dateOfBirth,
                'phone'=>$request->userPhoneNumber,

            ];
    }

}
