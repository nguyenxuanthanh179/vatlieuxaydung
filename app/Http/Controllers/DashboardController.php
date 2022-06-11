<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Customer;
use App\Models\Order;
use App\Models\Product;
use App\Models\Project;
use App\Models\Statistic;
use App\Models\Vendor;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $products = Product::all();
        $orders = Order::all();
        $customers = Customer::all();
        $vendors  = Vendor::all();
        $product_views = Product::limit(10)
                        ->orderBy('view', 'desc')
                        ->get();
        $blog_views = Article::limit(10)
            ->orderBy('view', 'desc')
            ->get();
        $project_views = Project::limit(10)
            ->orderBy('view', 'desc')
            ->get();
        $sales = Statistic::sum('sales');
        $profit = Statistic::sum('profit');

        return view('backend.dashboard.index',[
            'customers' => $customers,
            'orders' => $orders,
            'products' => $products,
            'vendors' => $vendors,
            'product_views' => $product_views,
            'project_views' => $project_views,
            'blog_views' => $blog_views,
            'sales' => $sales,
            'profit' => $profit
        ]);
    }
    public function filter_by_date(Request $request){
        $data= $request->all();
        $from_date = $data['from_date'];
        $to_date = $data['to_date'];
        $get = Statistic::whereBetween('order_date',[$from_date, $to_date])
            ->orderBy('order_date','ASC')
            ->get();
        foreach ($get as $key => $val){
            $chart_data[] = array(
                'period' => $val -> order_date,
                'order'=>$val->total_order,
                'sales'=>$val->sales,
                'profit'=>$val->profit,
                'quantity'=>$val->quantity
            );
        }

        echo $data = json_encode($chart_data);
    }
    public function filter_month(){
        // doanh thu trong 30 ngày
        $sub30days = Carbon::now('Asia/Ho_Chi_Minh')->subDay(30)->toDateString();
        $now = Carbon::now('Asia/Ho_Chi_Minh')->toDateString();

//        Doanh thu theo tuần
//        $now = Carbon::now();
//        $weekStartDate = $now->startOfWeek()->format('Y-m-d ');
//        $weekEndDate = $now->endOfWeek()->format('Y-m-d ');

        $get = Statistic::whereBetween('order_date',[$sub30days, $now])
            ->orderBy('order_date','ASC')
            ->get();
        foreach ($get as $key => $val){
            $chart_data[] = array(
                'period' => $val -> order_date,
                'order'=>$val->total_order,
                'sales'=>$val->sales,
                'profit'=>$val->profit,
                'quantity'=>$val->quantity
            );
        }
        echo $data = json_encode($chart_data);

    }

}
