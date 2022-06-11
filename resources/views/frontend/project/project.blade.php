@extends('frontend.layouts.main')
@section('project')

    <main class="main">
        <div class="container">
            <h3 class="main__tiltle mt-lg-4 main__color"> DỰ ÁN</h3>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-9 col-md-8 col-12">
                    @foreach($project as $item)
                        <div class="box_news row">
                            <div class="box_image tablet__image col-md-4 col-lg-5">
                                <a href="{{route('shop.projectDetails',['slug'=>$item->slug])}}"><img class="w-100" src="{{asset($item->image)}}" alt=""></a>
                            </div>
                            <div class="col-lg-7 col-md-8">
                                <h3 class="news__title"><a href="{{route('shop.projectDetails',['slug'=>$item->slug])}}">{{$item->title}}</a></h3>
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
                                <div class="blog text-justify tablet__summary">{!! $item->summary !!}</div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="col-lg-3 col-md-4 col-12 project__mobile">
                    <div class="mb-lg-3 mb-md-3">
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
                    <div >
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
                    </div c;>
                </div>
            </div>
        </div>
    </main>

@endsection
