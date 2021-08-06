<!DOCTYPE html>
<html>

<head>
    <?php $place = \App\Models\place::where('id', $id)->first(); ?>

    <title>{{ $place->name }}</title>
    @include('layouts.partials.head')
    @toastr_css

    <style>
            /*
        Max width before this PARTICULAR table gets nasty. This query will take effect for any screen smaller than 760px and also iPads specifically.
        */
        @media
        only screen
        and (max-width: 760px), (min-device-width: 768px)
        and (max-device-width: 1024px)  {
            /* Force table to not be like tables anymore */
            table, thead, tbody, th, td, tr {
                display: block;
            }

            /* Hide table headers (but not display: none;, for accessibility) */
            thead tr {
                position: absolute;
                top: -9999px;
                left: -9999px;
            }

            tr {
            margin: 0 0 1rem 0;
            }

            tr:nth-child(odd) {
            background: #ccc;
            }

            td {
                /* Behave  like a "row" */
                border: none;
                border-bottom: 1px solid #eee;
                position: relative;
                padding-left: 50%;
            }

            td:before {
                /* Now like a table header */
                position: absolute;
                /* Top/left values mimic padding */
                top: 0;
                left: 6px;
                width: 45%;
                padding-right: 10px;
                white-space: nowrap;
            }

            /*
            Label the data
            You could also use a data-* attribute and content for this. That way "bloats" the HTML, this way means you need to keep HTML and CSS in sync. Lea Verou has a clever way to handle with text-shadow.
            */
            td:nth-of-type(1):before { content: "{{ _('النوع') }}"; }
            td:nth-of-type(2):before { content: "{{ __('المنتج') }}"; }
            td:nth-of-type(3):before { content: "{{ __('السعر الاصلي') }}"; }
            td:nth-of-type(4):before { content: "{{ __('الخصم') }}"; }
            td:nth-of-type(5):before { content: "{{ __('السعر الجديد') }}"; }
            td:nth-of-type(6):before { content: "{{ __(' بداية العرض') }}"; }
            td:nth-of-type(7):before { content: "{{ __(' نهاية العرض') }}"; }
        }
        reset table, th, td {
            margin: 0;
            padding: 0;
            padding: 15px;
        }
    </style>
</head>

<body>
    @include('layouts.partials.nav')
    <div class="row">
        <div class="col-12">
            @include('layouts.partials.flash')
        </div>
    </div>

    <div class="services-sec py-4 text-center">
        <div class="container">
            <h1>{{ $place->name }}</h1>
        </div>
    </div>

    <!-- start image section -->
    <div class="image-section py-4">
        <div class="container">
            <img src="/image/place/photo/{{ $place->photo }}">

        </div>

    </div>
    <!-- end image section -->
    <!-- start paragraph section -->
    <div class="paragraph-sec py-4 text-center">
        <div class="container">
            <div class="row">
                <div class="col-md-4 col-sm-12 col-lg-4"></div>
                <div class="col-md-4 col-sm-12 col-lg-4" style="background-color: #c1e885;"><h3> {{ $place->phone }} <i class="fas fa-phone-volume"></i></h3></div>
                <div class="col-md-4 col-sm-12 col-lg-4"></div>
            </div><br>
            <p>
                {{-- هذا النص هو مثال لنص يمكن أن يستبدل في نفس المساحة، لقد تم توليد هذا النص من مولد النص العربى، حيث يمكنك أن تولد مثل هذا النص أو العديد من النصوص الأخرى إضافة إلى زيادة عدد الحروف التى يولدها التطبيق. --}}
                {{ $place->description }}
            </p>

        </div>

    </div>
    <!-- end paragraph section -->
    <!-- start services section -->

    <?php $place_discoun_count = \App\Models\Place_Discount::where('place_id', $place->id)->where('status', '0')->count(); ?>
    <div class="services-sec py-4 text-center">
        <div class="container">
            <h2><b>{{ __('العروض و الكوبونات') }}</b></h2>


            @if ($place_discoun_count > 0)
                    <div style="    text-align: -webkit-center;" >
                        <table role="table">
                            <thead role="rowgroup">
                                <tr role="row">
                                    <th role="columnheader">{{ _('النوع') }}</th>
                                    <th role="columnheader">{{ __('المنتج') }}</th>
                                    <th role="columnheader">{{ __('السعر الاصلي') }}</th>
                                    <th role="columnheader">{{ __('الخصم') }}</th>
                                    <th role="columnheader">{{ __('السعر الجديد') }}</th>
                                    <th role="columnheader">{{ __(' بداية العرض') }}</th>
                                    <th role="columnheader">{{ __('نهاية العرض') }}</th>
                                    {{-- <th role="columnheader">Dream Vacation City</th>
                                    <th role="columnheader">GPA</th>
                                    <th role="columnheader">Arbitrary Data</th> --}}
                                </tr>
                            </thead>
                            <tbody role="rowgroup">
                                <tr role="row">
                                </tr>

                                <?php
                                    $i = 0;
                                    $place_discounts = \App\Models\Place_Discount::where('place_id', $place->id)->where('status', '0')->get();
                                ?>
                                @foreach ($place_discounts as $place_discount)
                                    <tr role="row">
                                        <?php $i++; ?>
                                        <td role="cell">{{ $place_discount->type }}</td>
                                        <td role="cell">{{ $place_discount->name }}</td>
                                        <td role="cell">{{ $place_discount->price }}</td>
                                        <td role="cell">% {{ $place_discount->discount }}</td>
                                        <td role="cell">{{ $place_discount->new_price }}</td>
                                        <td role="cell">{{ $place_discount->start_day }}</td>
                                        <td role="cell">{{ $place_discount->end_day }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
            @else
                <br>
                <h3>عفوا لا يوجد اي عروض او كوبونات في الوقت الحالي</h3>
            @endif






        </div>

    </div>
    <!-- end services section -->
    <!-- start map section -->
    <div class="map-section py-4">
        <div class="container">
            <iframe src="{{ $place->map }}" width="100%" height="300" style="border:0;" allowfullscreen=""
                loading="lazy"></iframe>

        </div>

    </div>
    <!-- end map section -->





    @include('layouts.partials.footer')
    @include('layouts.partials.footer-scripts')

</body>
@jquery
@toastr_js
@toastr_render

</html>
