<!-- start footer -->
<div class="footer py-4">
    <div class="container">
        <div class="row">
            <?php
                $whats       =\App\Models\Company_Location::pluck('whats')->first();
                $Twitters    = \App\Models\Social_Mail::where('type', 'Twitter')->get();
                $Facebooks   = \App\Models\Social_Mail::where('type', 'Facebook')->get();
                $YouTubes   = \App\Models\Social_Mail::where('type', 'YouTube')->get();
                $Instagrams  = \App\Models\Social_Mail::where('type', 'Instagram')->get();
                $G_Mails     = \App\Models\Social_Mail::where('type', 'G_Mail')->get();
                $Yahoos      = \App\Models\Social_Mail::where('type', 'Yahoo')->get();
                $Telegrams   = \App\Models\Social_Mail::where('type', 'Telegram')->get();
                $Linkeds     = \App\Models\Social_Mail::where('type', 'Linked')->get();
            ?>

            <div class="col-md-3 col-icons-center ">
                <a href="https://api.whatsapp.com/send?phone={{ $whats }}" target="_blank"><i class="fab fa-whatsapp whats"></i></a>

                @foreach ($Facebooks as $Facebook )
                    @if($Facebook->status == '0')
                        <a href="{{ $Facebook->name }}" target="_blank"><i class="fab fa-facebook"></i></a>
                    @endif
                @endforeach

                @foreach ($Instagrams as $Instagram )
                    @if($Instagram->status == '0')
                        <a href="{{ $Instagram->name }}" target="_blank"><i class="fab fa-instagram"></i></a>
                    @endif
                @endforeach

                @foreach ($YouTubes as $YouTube )
                    @if($YouTube->status == '0')
                        <a href="{{ $YouTube->name }}" target="_blank"><i class="fab fa-youtube"></i></a>
                    @endif
                @endforeach

                @foreach ($Twitters as $Twitter )
                    @if($Twitter->status == '0')
                        <a href="{{ $Twitter->name }}" target="_blank"><i class="fab fa-twitter"></i></a>
                    @endif
                @endforeach


                @foreach ($G_Mails as $G_Mail )
                    @if($G_Mail->status == '0')
                        <a href="{{ $G_Mail->name }}" target="_blank"><i class="fa fa-envelope"></i></a>
                    @endif
                @endforeach

                @foreach ($Linkeds as $Linked )
                    @if($Linked->status == '0')
                        <a href="{{ $Linked->name }}" target="_blank"><i class="fab fa-linkedin"></i></a>
                    @endif
                @endforeach

                @foreach ($Yahoos as $Yahoo )
                    @if($Yahoo->status == '0')
                        <a href="{{ $Yahoo->name }}" target="_blank"><i class="fab fa-yahoo"></i></a>
                    @endif
                @endforeach

                @foreach ($Telegrams as $Telegram )
                    @if($Telegram->status == '0')
                        <a href="{{ $Telegram->name }}" target="_blank"><i class="fab fa-telegram"></i></a>
                    @endif
                @endforeach
            </div>


            <div class="col-md-4 text-cenetr">
                <button> <a href="{{ route('home/electronic_card') }}">اشترك الان</a></button>

            </div>
            <div class="col-md-5 col-icons-center ">
                <p>جميع الحقوق محفوظة © 2021 ﺣﺪود اﻟﻜﻮن </p>
            </div>
        </div>
    </div>
</div>
<!-- end footer -->
