<!--start navbar-->
<div class="header">
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="{{ route('home') }}">
            <img src="{{asset('app-assets/images/new_logo.jpeg')}}" style="height:62px" /></a>
            {{-- <img src="{{asset('app-assets/images/logo.png')}}" /></a> --}}
        <button class="navbar-toggler" type="button" data-toggle="collapse"
            data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
            aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav  ">
                <li class="nav-item dropdown dropdown-types">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        كل الاقسام
                    </a>
                    <?php  $categories = \App\Models\Category::orderBy('id', 'desc')->get(); ?>
                    <div class="dropdown-menu " aria-labelledby="navbarDropdown">
                        @foreach ($categories as $category )
                            <a class="dropdown-item" href="/home/sections/{{ $category->id }}">{{ \Str::limit($category->name, 25) }}</a>
                        @endforeach

                        {{-- <a class="dropdown-item" href="womensectionlocation.html">قسم النساء</a>
                        <a class="dropdown-item" href="medicalplaces.html">خدمات طبية</a>
                        <a class="dropdown-item" href="familyplaces.html">اماكن وعروض عائلية</a>
                        <a class="dropdown-item" href="shopping.html">اماكن تسوق</a>
                        <a class="dropdown-item" href="weddingplanner.html">تجهيز حفلات ومناسبات</a>
                        <a class="dropdown-item" href="travel.html">اماكن سياحية</a>
                        <a class="dropdown-item" href="restaurant.html">مطاعم</a>
                        <a class="dropdown-item" href="caffe.html">مقاهي وكوفي شوب</a> --}}

                    </div>
                </li>
                <li class="nav-item active pages-links">
                    <a class="nav-link" href="{{ route('home') }}">الرئيسية <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('home/aboutus') }}">عن حدود</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('home/electronic_card') }}">اشترك الان</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('home/discount') }}">العروض والكبونات</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('home/medical_request') }}">كـن شـريـك مـعـنـا مـجـانـا</a>
                </li>

            </ul>

            {{-- <form class="form-inline my-2 my-lg-0">
                <select class="select-sec" name="title">
                    <option>المنطقة الشمالية</option>
                    <option>المنطقة الجنوبية</option>
                    <option>المنطقة الوسطي</option>
                    <option>المنطقة الغربية</option>
                    <option>المنطقة الشرقية</option>
                </select>
                <input class="form-control " type="search" placeholder="ابحث عن" aria-label="Search">
            </form> --}}

            <form action="{{ route('/home/search') }}" method="get" class="form-inline my-2 my-lg-0">
                {{ method_field('patch') }}
                @csrf
                <select name="type" class="select-sec">
                    <option value="0">       {{__('اخـتـر---') }}                   </option>
                    <option value="المنطقة الشمالية"  > {{__('المنطقة الشمالية') }}  </option>
                    <option value="المنطقة الجنوبية"  > {{__('المنطقة الجنوبية') }}  </option>
                    <option value="المنطقة الوسطي"    > {{__('المنطقة الوسطي') }}    </option>
                    <option value="المنطقة الشرقية"  > {{__('المنطقة الشرقية') }}   </option>
                    <option value="المنطقة الغربية"   > {{__('المنطقة الغربية') }}   </option>
                </select>

                <input type="text" name="keyword" class="form-control " placeholder=" ...ابحث عن">

                <button type="submit" class="form-control home_search"
                style="background-color: #90b557; border-radius: 50px; font-size: 11px; color: white;">{{__('بــحــث') }}</button>
            </form>

            {{-- @if(session()->has('login_key'))
                <a class="link-enter" href="/front_logout">{{__("تسجيل خروج") }}</a>
            @else
                <a class="link-enter" href="/front_login">{{__("تسجيل دخول") }}</a>
            @endif --}}

        </div>
    </nav>

</div>
<!--end navbar-->
