<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Utilities\VNPay;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class CheckOutController extends Controller
{
    private $cart;
    private $order;
    private $orderDetail;
    public function __construct(Cart $cart, Order $order, OrderDetail $orderDetail)
    {
        $this->cart = $cart;
        $this->order = $order;
        $this->orderDetail = $orderDetail;
    }
    public function index()
    {
        $cart = $this->cart->all();
        $subTotal = 0;
        foreach ($cart as $item) {
            $item->total = ($item->price * $item->qty);
            $subTotal += ($item->price * $item->qty);
        }
        return view('front.checkout.checkout', compact('cart', 'subTotal'));
    }
    public function addOrder(Request $request)
    {
        //thêm order
        $order = $this->order->create($request->all());

        //thêm order detail
        $cart = $this->cart->all();
        $subTotal = 0;
        foreach ($cart as $item) {
            $item->total = ($item->price * $item->qty);
            $subTotal += ($item->price * $item->qty);
        }
        foreach ($cart as $item) {
            $data = [
                'order_id' => $order->id,
                'product_id' => $item->product_id,
                'qty' =>  $item->qty,
                'amount' => $item->price,
                'total' => $item->price * $item->qty,
            ];
            $this->orderDetail->create($data);
        };


        if ($request->payment_type == 'pay_later') {
            $this->sendEmail($order, $cart, $subTotal);
            $this->cart->getQuery()->delete();
            return redirect('checkout/result')->with('notification', 'Success! you will pay on delivery. Please check your mail.');
        }
        if ($request->payment_type == 'pay_online') {
            $data_url = VNPay::vnpay_create_payment([
                'vnp_TxnRef' => $order->id,
                'vnp_OrderInfo' => 'Đơn hàng của bạn gồm ....',
                'vnp_Amount' => $subTotal * 23000,
            ]);
            return redirect()->to($data_url);
        }

        //trả về kết quả thông báo 
    }
    public  function result()
    {
        $cart = $this->cart->all();
        $subTotal = 0;
        foreach ($cart as $item) {
            $item->total = ($item->price * $item->qty);
            $subTotal += ($item->price * $item->qty);
        }
        $notification = session('notification');
        return view('front.checkout.result', compact('notification', 'cart', 'subTotal'));
    }

    public function vnPayCheck(Request $request)
    {
        $vnp_ResponseCode = $request->get('vnp_ResponseCode');
        $vnp_TxnRef = $request->get('vnp_TxnRef');
        $vnp_Amount = $request->get('vnp_Amount');
        if ($vnp_ResponseCode != null) {
            if ($vnp_ResponseCode == 00) {
                $order = $this->order->find($vnp_TxnRef);
                // $cart = $this->cart->all();
                // $subTotal = 0;
                // foreach ($cart as $item) {
                //     $item->total = ($item->price * $item->qty);
                //     $subTotal += ($item->price * $item->qty);
                // }
                // $this->sendEmail($order, $cart, $subTotal);
                $this->cart->getQuery()->delete();
                return redirect('checkout/result')->with('notification', 'Success! Has paid online. Please check your mail.');
            } else {
                $this->order->delete($vnp_TxnRef);
                return redirect('checkout/result')->with('notification', 'Error! Payment failed or canceled.');
            }
        }
    }
    public function sendEmail($order, $cart, $subTotal)
    {
        $email_to = $order->email;
        Mail::send('front.checkout.email', compact('order', 'cart', 'subTotal'), function ($message) use ($email_to) {
            $message->from('nmk16032002@gmail.com', 'Kha Nguyen');
            $message->to($email_to, $email_to);
            $message->subject('Order Notification');
        });
    }
}
