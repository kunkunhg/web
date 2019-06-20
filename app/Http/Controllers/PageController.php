<?php

namespace App\Http\Controllers;
use App\Slide;
use App\Product;
use App\ProductType;
use Illuminate\Http\Request;
use App\Cart;
use Session;
use App\Customer;
use App\Bill;
use App\BillDetail;
use App\User;
use Hash;
use Auth;
class PageController extends Controller
{
    public function getIndex()
    {
    	$slide = Slide::all();
    	$new_product = Product::where('new',1)->paginate(4,['*'],'pag');
    	$sanpham_khuyenmai = Product::where('promotion_price','<>',0)->paginate(8);
    	//return view('page.trangchu',['slide'=>$slide]);
    	return view('page.trangchu',compact('slide','new_product','sanpham_khuyenmai'));
    }

    public function getLoaiSP($type)
    {
        $sp_theoloai = Product::where('id_type',$type)->get();
        $sp_khac = Product::where('id_type','<>',$type)->paginate(3,['*'],'pag');
        $loaisp = ProductType::all();
        $loai_sp = ProductType::where('id',$type)->first();
    	return view('page.loai_sanpham',compact('sp_theoloai','sp_khac','loaisp','loai_sp'));
    }

    public function getChiTiet(Request $req)
    {
        $sanpham = Product::where('id',$req->id)->first();
        $sanpham_tuongtu = Product::where('id_type',$sanpham->id_type)->paginate(6,['*'],'pag');
    	return view('page.chitiet_sanpham',compact('sanpham','sanpham_tuongtu'));
    }
    public function getLienHe()
    {
    	return view('page.lienhe');
    }
    public function getGioiThieu()
    {
    	return view('page.gioithieu');
    }

    public function getAddToCart(Request $req,$id)
    {
        $product = Product::find($id);
        $oldCart = Session('cart')?Session::get('cart'):null;
        $cart = new Cart($oldCart);
        $cart->add($product, $id);
        $req->session()->put('cart',$cart);
        return redirect()->back();
    }

    public function getDelItemCart($id)
    {
        $oldCart = Session::has('cart')?Session::get('cart'):null;
        $cart = new Cart($oldCart);
        $cart->removeItem($id);
        if(count($cart->items) == 0){
            Session::put('cart',$cart);
        }else{
            Session::forget('cart');
        }

       
        return redirect()->back();
    }

    public function getCheckOut()
    {
        return view ('page.dathang');
    }
    public function postCheckOut(Request $req)
    {
        $cart = Session::get('cart');
     
        $customer = new Customer;
        $customer->name = $req->name;
        $customer->gender = $req->gender;
        $customer->email = $req->email;
        $customer->address = $req->address;
        $customer->phone_number = $req->phone;
        $customer->note = $req->notes;
        $customer->save();

        $bill = new Bill;
        $bill->id_customer = $customer->id;
        $bill->date_order = date('y-m-d');
        $bill->total = $cart->totalPrice;
        $bill->payment = $req->payment_method;
        $bill->note = $req->notes;
        $bill->save();


        foreach ($cart->items as $key => $value) {
            $bill_detail = new BillDetail;
            $bill_detail->id_bill = $bill->id;
            $bill_detail->id_product = $key;
            $bill_detail->quantity = $value['qty'];
            $bill_detail->unit_price = ($value['price']/$value['qty']);
            $bill_detail->save();
        }
        Session::forget('cart');
        return redirect()->back()->with('thongbao','Đặt hàng thành công');
       
    }

    public function getDangNhap()
    {
        return view('page.dangnhap');
    }

    public function getDangky()
    {
        return view('page.dangky');
    }

    public function postDangky(Request $req)
    {
        $this->validate($req,
            [
                'email'=>'required|email|unique:users,email',
                'password'=>'required|min:4|max:15',
                'fullname'=>'required',
                're_password'=>'required|same:password'
            ],
            [
                'email.required'=>'vui lòng nhập email',
                'email.email'=>'vui lòng nhập đúng định dạng email (vd: xxx@gmail.com)',
                'email.unique'=>'email này đã được sử dụng',
                'password.required'=>'vui lòng nhập password',
                'password.min'=>'vui lòng nhập password nhiều hơn 4 và ít hơn 15 ký tự',
                'password.max'=>'vui lòng nhập password nhiều hơn 4 và ít hơn 15 ký tự', 
                're_password.same'=>'mật khẩu không giống nhau',
                'fullname.required'=>'vui lòng nhập tên đăng nhập'
            ]);
        $user = new User();
        $user->full_name = $req->fullname;
        $user->email = $req->email;
        $user->password = Hash::make($req->password);
        $user->phone = $req->phone;
        $user->address = $req->address;
        $user->save();
        return redirect()->back()->with('thanhcong','Tạo tài khoản thành công');
    }

    public function postDangNhap(Request $req)
    {
        $this->validate($req,
            [
                'email'=>'required|email',
                'password'=>'required|min:3|max:20'
            ],
            [
                'email.required'=>'vui lòng nhập email',
                'email.email'=>'email không đúng định dạng',
                'password.required'=>'vui lòng nhập password',
                'password.min'=>'password phải nhiều hơn 3 ký tự và ít hơn 20 ký tự',
                'password.max'=>'password phải nhiều hơn 3 ký tự và ít hơn 20 ký tự'
            ]
        );
        $cuslogin = array('email'=>$req->email,'password'=>$req->password);
        if(Auth::attempt($cuslogin)){
            return redirect()->back()->with(['flag'=>'success','message'=>'đăng nhập thành công']);
        } else{
            return redirect()->back()->with(['flag'=>'danger','message'=>'email hoặc mật khẩu không chính xác']);
        }
    }

    public function getDangXuat()
    {
        Auth::logout();
        return redirect()->route('trang-chu');
    }

    public function getSearch(Request $req)
    {
        $product = Product::where('name','like','%'.$req->key.'%')
                            ->orWhere('unit_price',$req->key)
                            ->get();
        return view('page.search',compact('product'));
    }
}