@extends('frontend.layouts.main')
@section('blog')

    <main class="main">
        <div class="container">
            <h3 class="main__tiltle mobile-title pt-4 main__color"> TIN TỨC</h3>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-9">

                    @foreach($data as $item)
                    <div class="box_news row">
                        <div class="box_image col-md-5">
                            <a href="{{route('shop.blogDetails',['slug'=>$item->slug])}}"><img class="w-100" src="{{asset($item->image)}}" alt=""></a>
                        </div>
                        <div class="col-md-7">
                            <h3 class="news__title"><a href="{{route('shop.blogDetails',['slug'=>$item->slug])}}">{{$item->title}}</a></h3>
                            <div class="d-flex" style="font-size: 12px; opacity: .7; font-style: italic">
                                <div class="mr-3">
                                    <i class="fa-solid fa-user"></i>
                                    {{@$item->user->name}}
                                </div>
                                <div>
                                    <i class="fa-regular fa-calendar-days"></i>
                                    {{ date('d/m/Y', strtotime($item->updated_at)) }}
                                </div>
                            </div>
                            <style>
                                .blog > p {
                                    line-height: 1.4;
                                }
                            </style>
                            <div class="blog text-justify">{!! $item->summary !!}</div>
                        </div>
                    </div>
                    @endforeach
                    <div class="paginatoin-area">
                        <div class="row">
                            <div class="col-lg-12 col-md-12 d-flex justify-content-center">
                                {{ $data->links() }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 blog__mobile">
                    <div class="mb-3">
                        <h3 class="navbar">Danh mục sản phẩm</h3>
                        <div class="category-sub-menu">
                            <ul class="border__category">
                                @foreach($menu as $item)
                                    @if($item->parent_id==0)
                                        <li class="has-sub">
                                            <a href="{{route('shop.category',['slug'=>$item->slug])}}">{{$item->name}}
                                            </a>
                                            <ul>
                                                @foreach($menu as $child)
                                                    @if($child->parent_id==$item->id)
                                                        <li><a href="{{route('shop.category',['slug'=>$child->slug])}}">{{$child->name}}</a></li>
                                                    @endif
                                                @endforeach
                                            </ul>
                                        </li>
                                    @endif
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    <div>
                        <h3 class="navbar">Tin tức mới</h3>
                        <div class="navbar__news">
                            <ul class="navbar-list__news">
                                @foreach($data as $item)
                                    @if($item->is_new == 1)
                                    <li class="row">
                                        <div class="box__image col-md-3">
                                            <a href="{{route('shop.blogDetails',['slug'=>$item->slug])}}">
                                                <img class="news-img__icon"
                                                src="{{asset($item->image)}}" alt="">
                                            </a>
                                        </div>
                                        <div>
                                           <div>
                                               <a href="{{route('shop.blogDetails',['slug'=>$item->slug])}}">
                                                   {{$item->title}}
                                               </a>
                                           </div>
                                            <div style="margin-top: 3px; font-size: 11px; opacity: .7; font-style: italic">
                                                <i class="fa-regular fa-calendar-days"></i>
                                                {{ date('d/m/Y', strtotime($item->updated_at)) }}
                                            </div>
                                        </div>
                                    </li>
                                    @endif
                                @endforeach
                                @foreach($project as $item)
                                    @if($item->is_new == 1)
                                        <li class="row">
                                            <div class="box__image col-md-3">
                                                <a href="{{route('shop.projectDetails',['slug'=>$item->slug])}}">
                                                    <img class="news-img__icon"
                                                         src="{{asset($item->image)}}" alt="">
                                                </a>
                                            </div>

                                            <div>
                                                <div>
                                                    <a href="{{route('shop.projectDetails',['slug'=>$item->slug])}}">
                                                        {{$item->title}}
                                                    </a>
                                                </div>
                                                <div style="margin-top: 3px; font-size: 11px; opacity: .7; font-style: italic">
                                                    <i class="fa-regular fa-calendar-days"></i>
                                                    {{ date('d/m/Y', strtotime($item->updated_at)) }}
                                                </div>
                                            </div>
                                        </li>
                                    @endif
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

@endsection
