<div class="container-fluid">
    <div class="row">
        <!-- Left Sidebar start-->
        <div class="side-menu-fixed">
            <div class="scrollbar side-menu-bg" style="overflow: scroll">
                <ul class="nav navbar-nav side-menu" id="sidebarnav">
                    <!-- menu item Dashboard-->
                    <li>
                        <a href="{{ url('/dashboard') }}">
                            <div class="pull-left"><i class="ti-home"></i><span class="right-nav-text">{{__('الـرئـيـسـيـة')}}</span>
                            </div>
                            <div class="clearfix"></div>
                        </a>
                    </li>
                    <!-- menu title -->
                    <li class="mt-10 mb-10 text-muted pl-4 font-medium menu-title">{{__('حـدود الـكـون')}} </li>

                     <!-- Admins-->

                     {{-- @if (auth()->user()->hasRole(['super_admin', 'admin'])) --}}
                     @if (auth()->user()->hasRole('super_admin'))
                        <li>
                            <a href="javascript:void(0);" data-toggle="collapse" data-target="#admins-icon">
                                <div class="pull-left"><i class="fas fa-user"></i><span class="right-nav-text">{{__('الادمــن')}}</span></div>
                                <div class="pull-right"><i class="ti-plus"></i></div>
                                <div class="clearfix"></div>
                            </a>

                            <ul id="admins-icon" class="collapse" data-parent="#sidebarnav">
                                <li><a href="{{route('admins.index')}}">{{__('قـائـمـة الادمـن')}}</a></li>
                            </ul>
                        </li>
                     @endif


                     <!-- Users-->
                     <li>
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#users-icon">
                            <div class="pull-left"><i class="fas fa-users"></i><span class="right-nav-text">{{__('الـمـسـتـخـدمـيـن')}}</span></div>
                            <div class="pull-right"><i class="ti-plus"></i></div>
                            <div class="clearfix"></div>
                        </a>
                        <ul id="users-icon" class="collapse" data-parent="#sidebarnav">
                            <li><a href="{{route('users.index')}}">{{__('قائمة المستخدمين')}}</a></li>
                        </ul>
                    </li>


                    <!-- Regions-->
                    <li>
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#regions-menu">
                            <div class="pull-left"><i class="fad fa-address-book"></i><span
                                    class="right-nav-text">{{__('مـنـطـقـة - حــي') }}</span></div>
                            <div class="pull-right"><i class="ti-plus"></i></div>
                            <div class="clearfix"></div>
                        </a>
                        <ul id="regions-menu" class="collapse" data-parent="#sidebarnav">
                            <li><a href="{{route('regions.index')}}">{{__('مـنـطـقـة - حــي') }}</a></li>
                        </ul>
                    </li>

                    <!-- category-->
                    <li>
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#category-menu">
                            <div class="pull-left"><i class="fad fa-address-book"></i><span
                                    class="right-nav-text">{{__('الـتـصـنـيـفـات') }}</span></div>
                            <div class="pull-right"><i class="ti-plus"></i></div>
                            <div class="clearfix"></div>
                        </a>
                        <ul id="category-menu" class="collapse" data-parent="#sidebarnav">
                            <li><a href="{{route('categories.index')}}">{{__('قـائـمـة الـتـصـنـيـفـات') }}</a></li>
                        </ul>
                    </li>

                    <!-- Places-->
                    <li>
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#place-menu">
                            <div class="pull-left"><i class="fad fa-address-book"></i><span
                                    class="right-nav-text">{{__('الامـاكـن') }}</span></div>
                            <div class="pull-right"><i class="ti-plus"></i></div>
                            <div class="clearfix"></div>
                        </a>
                        <ul id="place-menu" class="collapse" data-parent="#sidebarnav">
                            <li><a href="{{route('places.index')}}">{{__('قـائـمـة الامـاكـن') }}</a></li>
                        </ul>
                    </li>

                    <!-- Chemical-->
                     <li>
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#chemical-menu">
                            <div class="pull-left"><i class="fad fa-address-book"></i><span
                                    class="right-nav-text">{{__('كـن شـريـك مـعـنـا مـجـانـا ') }}</span></div>
                            <div class="pull-right"><i class="ti-plus"></i></div>
                            <div class="clearfix"></div>
                        </a>
                        <ul id="chemical-menu" class="collapse" data-parent="#sidebarnav">
                            <li><a href="{{route('chemical.index')}}">{{__('المراكز و المجمعات ') }}</a></li>
                        </ul>
                    </li>


                    @if (auth()->user()->hasRole(['super_admin', 'super_admin_join','admin_join']))
                        <!-- join-->
                        <li>
                            <a href="javascript:void(0);" data-toggle="collapse" data-target="#join-menu">
                                <div class="pull-left"><i class="fad fa-address-book"></i><span
                                        class="right-nav-text">{{__('المـشـتـركـيـن') }}</span></div>
                                <div class="pull-right"><i class="ti-plus"></i></div>
                                <div class="clearfix"></div>
                            </a>
                            <ul id="join-menu" class="collapse" data-parent="#sidebarnav">
                                <li><a href="{{route('join.index')}}">{{__('المـشـتـركـيـن') }}</a></li>
                            </ul>
                        </li>
                    @endif

                    <!-- About Us-->
                    <li>
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#aboutus-menu">
                            <div class="pull-left"><i class="fad fa-address-book"></i><span
                                    class="right-nav-text">{{__('مـن نـحـن') }}</span></div>
                            <div class="pull-right"><i class="ti-plus"></i></div>
                            <div class="clearfix"></div>
                        </a>
                        <ul id="aboutus-menu" class="collapse" data-parent="#sidebarnav">
                            <li><a href="{{route('aboutus.index')}}">{{__('مـن نـحـن') }}</a></li>
                        </ul>
                    </li>
                    <!-- Contact Us-->
                    <li>
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#contact-menu">
                            <div class="pull-left"><i class="fad fa-address-book"></i><span
                                    class="right-nav-text">{{__('اتـصـل بـنـا') }}</span></div>
                            <div class="pull-right"><i class="ti-plus"></i></div>
                            <div class="clearfix"></div>
                        </a>
                        <ul id="contact-menu" class="collapse" data-parent="#sidebarnav">
                            <li><a href="{{route('contacts.index')}}">{{__('اتـصـل بـنـا') }}</a></li>
                        </ul>
                    </li>

                    <!-- Socials -->
                    <li>
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#social-menu">
                            <div class="pull-left"><i class="fad fa-address-book"></i><span
                                    class="right-nav-text">{{__('سـوشـيـال مـيـديـا') }}</span></div>
                            <div class="pull-right"><i class="ti-plus"></i></div>
                            <div class="clearfix"></div>
                        </a>
                        <ul id="social-menu" class="collapse" data-parent="#sidebarnav">
                            <li><a href="{{route('socials.index')}}">{{__('سـوشـيـال مـيـديـا') }}</a></li>
                        </ul>
                    </li>

                    <!-- Advs -->
                    <li>
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#advs-menu">
                            <div class="pull-left"><i class="fad fa-address-book"></i><span
                                    class="right-nav-text">{{__('الاعــلانــات') }}</span></div>
                            <div class="pull-right"><i class="ti-plus"></i></div>
                            <div class="clearfix"></div>
                        </a>
                        <ul id="advs-menu" class="collapse" data-parent="#sidebarnav">
                            <li><a href="{{route('advs.index')}}">{{__('قـائـمـة الاعــلانــات') }}</a></li>
                        </ul>
                    </li>

                    <!-- Company Word -->
                    <li>
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#word-menu">
                            <div class="pull-left"><i class="fad fa-book"></i><span
                                    class="right-nav-text">{{__('كـلـمـة الـشـركـة') }}</span></div>
                            <div class="pull-right"><i class="ti-plus"></i></div>
                            <div class="clearfix"></div>
                        </a>
                        <ul id="word-menu" class="collapse" data-parent="#sidebarnav">
                            <li><a href="{{route('company_words.index')}}">{{__('كـلـمـة الـشـركـة') }}</a></li>
                        </ul>
                    </li>


                    <!-- Location-->
                    <li>
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#location-menu">
                            <div class="pull-left"><i class="fad fa-address-card"></i><span
                                    class="right-nav-text">{{('اتصل/مقر الشركة')}}</span></div>
                            <div class="pull-right"><i class="ti-plus"></i></div>
                            <div class="clearfix"></div>
                        </a>
                        <ul id="location-menu" class="collapse" data-parent="#sidebarnav">
                            <li><a href="{{route('company_location.index')}}">{{trans('front_trans.company_location')}}</a></li>                        </ul>
                    </li>

                    <!-- News-->
                    {{-- <li>
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#news-menu">
                            <div class="pull-left"><i class="fad fa-newspaper"></i><span
                                    class="right-nav-text">{{trans('front_trans.news')}}</span></div>
                            <div class="pull-right"><i class="ti-plus"></i></div>
                            <div class="clearfix"></div>
                        </a>
                        <ul id="news-menu" class="collapse" data-parent="#sidebarnav">
                            <li><a href="{{route('news.index')}}">{{trans('front_trans.last_news')}}</a></li>
                        </ul>
                    </li> --}}

                    <!-- Jobs-->
                    {{-- <li>
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#Jobs-menu">
                            <div class="pull-left"><i class="fad fa-address-card"></i><span
                                    class="right-nav-text">{{trans('front_trans.jobs')}}</span></div>
                            <div class="pull-right"><i class="ti-plus"></i></div>
                            <div class="clearfix"></div>
                        </a>
                        <ul id="Jobs-menu" class="collapse" data-parent="#sidebarnav">
                            <li><a href="{{route('company_jobs.index')}}">{{trans('front_trans.company_jobs')}}</a></li>
                            <li><a href="{{route('job_messages')}}">{{trans('front_trans.job_request_list')}}</a></li>
                        </ul>
                    </li> --}}



                </ul>
            </div>
        </div>

        <!-- Left Sidebar End-->

        <!--=================================
