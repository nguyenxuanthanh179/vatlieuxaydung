<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Banner;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Contact;
use App\Models\Customer;
use App\Models\Product;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class ShopController extends GeneralController
{
    // =============== trang chủ ==================
    public function index()
    {
        $article = Article::where('is_active', 1)
            ->orderBy('id', 'DESC')
            ->limit(3)
            ->get();

        $project = Project::where('is_active', 1)
            ->limit(4)
            ->get();

        $banners = Banner::where('is_active', 1)
            ->orderBy('id', 'DESC')->get();

        // sản phẩm bán chạy
        $products = Product::where(['is_active' => 1, 'is_hot' => 1])
            ->limit(8)
            ->orderBy('pro_pay', 'desc')
            ->get();

        // step 1 - lấy toàn bộ danh mục cha
        $categories = Category::where([
            'is_active' => 1,
            'parent_id' => 0// danh mục cha

        ])->limit(2)->orderBy('id', 'desc')->get();

        $arr = [];

        // step 2 lấy tất cả danh mục con theo danh mục cha
        foreach ($categories as $key => $category) {

            $arr[$key]['category'] = $category;

            $ids = [$category->id]; // [1]

            $childCategories = Category::where([
                'is_active' => 1,
                'parent_id' => $category->id // danh mục cha
            ])->get();

            foreach ($childCategories as $child) {
                $ids[] = $child->id; // thêm các phần tử vào mảng
            } // $ids = 7,8,9,11..

            // ids = 1,7,8,9,11,... : toàn bộ id của dạnh mục cha + con
            $product = Product::where(['is_active' => 1])
                ->whereIn('category_id', $ids)
                ->limit(25)
                ->orderBy('id', 'desc')
                ->get();
            $arr[$key]['products'] = $product;
        }

        return view('frontend.index', [
            'banners' => $banners,
            'list' => $arr,
            'products' => $products,
            'article' => $article,
            'project' => $project,
            'category' => $categories
        ]);
    }
    //============= trang giới thiệu ==============
    public function aboutUs()
    {
        return view('frontend.about-us');
    }
    //============= trang sản phẩm ===============
    public function product()
    {
        $article = Article::where('is_active',1)
            ->orderBy('id', 'DESC')->get();

        $project = Project::where('is_active',1)
            ->orderBy('id', 'DESC')->get();

        $all_products = Product::where(['is_active' => 1])
            ->orderBy('id', 'desc')
            ->paginate(12);

        if(isset($_GET['sort_by'])){
           $sort_by = $_GET['sort_by'];
           if ($sort_by == 'giam_dan'){
               $all_products = Product::where(['is_active' => 1])
                   ->orderBy('sale', 'desc')
                   ->paginate(12)->appends(request()->query());
           }
           if ($sort_by == 'tang_dan'){
               $all_products = Product::where(['is_active' => 1])
                   ->orderBy('sale', 'asc')
                   ->paginate(12)->appends(request()->query());
           }
           if ($sort_by == 'name_AZ'){
               $all_products = Product::where(['is_active' => 1])
                   ->orderBy('name', 'asc')
                   ->paginate(12)->appends(request()->query());
           }
            if ($sort_by == 'name_ZA'){
                $all_products = Product::where(['is_active' => 1])
                    ->orderBy('name', 'desc')
                    ->paginate(12)->appends(request()->query());
            }
        }
        else{
            $all_products = Product::where(['is_active' => 1])
                ->orderBy('pro_pay', 'desc')
                ->paginate(12);
        }
        return view('frontend.product.product', [
            'all_products' => $all_products,
            'article'=>$article,
            'project'=>$project,
        ]);
    }
    public function category($slug)
    {
        $project = Project::where('is_active',1)
            ->orderBy('id', 'DESC')->get();
        $article = Article::where('is_active',1)
            ->orderBy('id', 'DESC')
            ->get();
        $category = Category::where(['slug'=>$slug])->first();
        if(isset($_GET['sort_by'])){
            $sort_by = $_GET['sort_by'];
            if ($sort_by == 'giam_dan'){
                $all_products = Product::where(['is_active' => 1,'category_id'=> $category->id])
                    ->orderBy('sale', 'desc')
                    ->paginate(12)->appends(request()->query());
            }
            if ($sort_by == 'tang_dan'){
                $all_products = Product::where(['is_active' => 1,'category_id'=> $category->id])
                    ->orderBy('sale', 'asc')
                    ->paginate(12)->appends(request()->query());
            }
            if ($sort_by == 'name_AZ'){
                $all_products = Product::where(['is_active' => 1,'category_id'=> $category->id])
                    ->orderBy('name', 'asc')
                    ->paginate(12)->appends(request()->query());
            }
            if ($sort_by == 'name_ZA'){
                $all_products = Product::where(['is_active' => 1,'category_id'=> $category->id])
                    ->orderBy('name', 'desc')
                    ->paginate(12)->appends(request()->query());
            }
        }else{
            $all_products = Product::where(['is_active' => 1,'category_id'=> $category->id])
                ->orderBy('id', 'desc')
                ->paginate(12);
        }
        return view('frontend.product.product', [
            'all_products' => $all_products,
            'article'=>$article,
            'project'=>$project,
        ]);
    }
    //============= trang chi tiết sản phẩm =================
    public function  ProductDetails($slug)
    {

        $hotProducts = Product::where(['is_active' => 1, 'is_hot' => 1])
            ->limit(8)
            ->orderBy('id', 'desc')
            ->get();

        $product = Product::where(['slug'=>$slug])->first();
        $product->view = $product->view + 1;
        $product->save();
        $comment = Comment::where(['product_id'=>$product->id])->get();

        // sản phẩm tương tự
        $parityProduct = Product::where(['category_id' => $product->category_id ])
            ->limit(8)
            ->orderBy('id', 'desc')
            ->get();

        return view('frontend.product.product-details', [
            'product' => $product,
            'comment' => $comment,
            'parityProduct' => $parityProduct
        ]);
    }
    //===============  bình luận =====================
    public function postComment(Request $request, $slug){
        $customers = Customer::all();
        $comment = new Comment();
        $product = Product::where(['slug'=>$slug])->first();
        $article = Article::where(['slug'=>$slug])->first();
        $project = Project::where(['slug'=>$slug])->first();
        if($product){
            $comment->product_id = $product->id;
        }
        if($project){
            $comment->project_id = $project->id;
        }
        if($article){
            $comment->article_id = $article->id;
        }
        if (Auth::guard('customer')->check() == false){
            $comment->name = $request->input('name');
            $comment->email = $request->input('email');
            $comment->content = $request->input('content');
            $comment->save();
        }else{
            foreach ($customers as $customer) {
                if(Auth::guard('customer')->user()->id == $customer->id){
                    $comment->name = $customer->name;
                    $comment->email = $customer->email;
                    $comment->avatar = $customer->avatar;
                    $comment->content = $request->input('content');
                    $comment->save();
                }
            }
        }

        return back();
    }

    //============= Trang tin tức ==================
    public function blog()
    {
        $project = Project::where('is_active',1)
            ->orderBy('id', 'DESC')->get();
        $category = Category::where([
            'is_active' => 1,
        ])->orderBy('id', 'DESC')->get();
        $data = Article::where('is_active',1)
            ->orderBy('id', 'DESC')
            ->paginate(4);
        return view('frontend.article.blog',[
            'data'=>$data,
            'category'=>$category,
            'project'=>$project
        ]);
    }
    // =============== Trang chi tiết tin tức ===============
    public function blogDetails($slug)
    {
        $hotProducts = Product::where(['is_active' => 1, 'is_hot' => 1])
            ->limit(8)
            ->orderBy('id', 'desc')
            ->get();
        $project = Project::where('is_active',1)
            ->orderBy('id', 'DESC')->get();
        $category = Category::where([
            'is_active' => 1,
        ])->orderBy('id', 'DESC')->get();
        $data = Article::where('is_active',1)
            ->orderBy('id', 'DESC')->get();
        $article = Article::where(['slug'=>$slug])->first();
        $article->view = $article->view + 1;
        $article->save();
        $comment = Comment::where(['article_id'=>$article->id])->get();

        return view('frontend.article.blog-details', [
            'article' => $article,
            'data'=>$data,
            'category' => $category,
            'project'=>$project,
            'hotProducts'=>$hotProducts,
            'comment'=>$comment,
        ]);
    }
    // ============== trang dự án  ===================
    public function project()
    {
        $category = Category::where([
            'is_active' => 1,
        ])->orderBy('id', 'DESC')->get();
        $data = Article::where('is_active',1)
            ->orderBy('id', 'DESC')->get();
        $project = Project::where('is_active',1)
            ->orderBy('id', 'DESC')->get();
        return view('frontend.project.project',[
                'project'=>$project,
                'data' => $data,
                'category' => $category,
            ]
        );
    }
    //========= trang chi tiết dự án =================
    public function projectDetails($slug)
    {
        $hotProducts = Product::where(['is_active' => 1, 'is_hot' => 1])
            ->limit(8)
            ->orderBy('id', 'desc')
            ->get();
        $category = Category::where([
            'is_active' => 1,
        ])->orderBy('id', 'DESC')->get();
        $project = Project::where(['slug'=>$slug])->first();
        $project->view = $project->view + 1;
        $project->save();
        $data = Article::where('is_active',1)
            ->orderBy('id', 'DESC')->get();
        $project1 = Project::where('is_active',1)
            ->orderBy('id', 'DESC')->get();
        $comment = Comment::where(['project_id'=>$project->id])->get();
        return view('frontend.project.project-details', [
            'project'=> $project,
            'project1'=> $project1,
            'category' => $category,
            'data' => $data,
            'hotProducts'=>$hotProducts,
             'comment'=>$comment
        ]);
    }
    //================== trang liên hệ =============
    public function contact()
    {
        return view('frontend.contact');
    }
    public function postContact(Request $request)
    {
        //validate
        $request->validate([
            'name' => 'required|min:3|max:50',
            'email' => 'required|email|regex:/(.+)@(.+)\.(.+)/i|min:10|max:50',
            'phone' => 'required|numeric|digits:10|regex:/(0)[0-9]/',
            'content' => 'required',
        ],[
            'name.required' => 'Bạn cần phải nhập vào tên của bạn',
            'name.min' => 'Họ tên phải có độ dài từ 3 đến 50 kí tự',
            'name.max' => 'Họ tên phải có độ dài từ 3 đến 50 kí tự',

            'email.required' => 'Bạn cần phải nhập vào email',
            'email.email' => 'Email không đúng định dạng',
            'email.regex' => 'Email của bạn không hợp lệ',
            'email.min' => 'Email phải có độ dài từ 10 đến 50 ký tự',
            'email.max' => 'Email phải có độ dài từ 10 đến 50 ký tự',

            'phone.required' => 'Số điện thoại của bạn không được bỏ trống',
            'phone.digits' => 'Số điện thoại phải có độ dài 10 số',
            'phone.numeric' => 'Số điện thoại phải là một số ',
            'phone.regex' => 'Số điện thoại không hợp lệ ',

            'content.required' => 'Bạn cần phải nhập vào nội dung liên hệ'
        ]);

        //luu vào csdl
        $contact = new Contact();
        $contact->name = $request->input('name');
        $contact->phone = $request->input('phone');
        $contact->email = $request->input('email');
        $contact->content = $request->input('content');
        $contact->save();

        return redirect()->route('shop.contact')->with('msg','Bạn vừa gửi liên hệ thành công');
    }
    //=========== trang quản lý giỏ hàng ============
    public function cart()
    {
        return view('frontend.cart.cart');
    }
    //=========== tìm kiếm  ===============
    public function search(Request $request)
    {
        $project = Project::where('is_active',1)
            ->orderBy('id', 'DESC')->get();
        $data = Article::where('is_active',1)
            ->orderBy('id', 'DESC')
            ->get();
        // : b1: Lấy từ khóa tìm kiếm
        $keyword = $request->input('tu-khoa');
        $slug = str_slug($keyword);
//        $sql = "SELECT * FROM products WHERE is_active = 1 AND slug like '%$keyword%'";
        $products = Product::where([
            ['slug', 'like' , '%' .$slug . '%'],
            ['is_active','=',1]
        ])->paginate(12);
        $totalResult = $products->total(); //số lượng kết quả tìm kiếm
        return view('frontend.product.search_product',[
            'products'=>$products,
            'totalResult'=>$totalResult,
            'data'=>$data,
            'project'=>$project,
            'keyword'=>$keyword ? $keyword : ''
        ]);
    }
    //======================

    public function notfound()
    {
        return view('errors.404');
    }
    public function login()
    {
        return view('frontend.login-register');
    }
}
