<p class="rs-p-wp-fix"></p>
<rs-module-wrap id="rev_slider_1_1_wrapper" data-source="gallery">
    <rs-module id="rev_slider_1_1" style="" data-version="6.5.9">
        @foreach ($slider as $slider)
            <rs-slides>
                <rs-slide data-key="rs-1" data-title="Slide" data-thumb="{{ $slider->getImageUrl() }}"
                    data-anim="ei:d;eo:d;s:d;r:0;t:fade;sl:d;">

                    <img src="{{ $slider->getImageUrl() }}" title="slider-img-02.jpg" width="1920" height="630"
                        class="rev-slidebg tp-rs-img" data-no-retina>

                    <rs-layer id="slider-1-slide-4-layer-0" data-type="text" data-rsp_ch="on"
                        data-xy="x:c,c,c,c;xo:15px,15px,0,0;yo:187px,187px,80px,80px;"
                        data-text="w:normal;s:16;l:26,26,26,20;fw:400;" data-vbility="t,t,f,f" data-frame_0="y:-100%;"
                        data-frame_0_mask="u:t;" data-frame_1="st:190;sp:1200;sR:190;" data-frame_1_mask="u:t;"
                        data-frame_999="o:0;st:w;sR:7610;"
                        style="z-index:8;font-family:'Krona One', sans-serif;">{{ $slider->getTitle() }}
                    </rs-layer>

                    <rs-layer id="slider-1-slide-4-layer-1" class="rs-selectable" data-type="shape" data-rsp_ch="on"
                        data-xy="x:c,c,c,c;xo:15px,15px,0,0;yo:220px,220px,100px,100px;"
                        data-text="w:normal;s:20,20,12,7;l:0,0,15,9;"
                        data-dim="w:390px,390px,390px,390px;h:2px,2px,2px,2px" data-vbility="t,t,f,f"
                        data-frame_0="y:-100%;" data-frame_0_mask="u:t;" data-frame_1="st:190;sp:1200;sR:190;"
                        data-frame_1_mask="u:t;" data-frame_999="o:0;st:w;sR:7610;"
                        style="z-index:8;background-color:#e33b28;">
                    </rs-layer>

                    <rs-layer id="slider-1-slide-4-layer-2" data-type="text" data-rsp_ch="on"
                        data-xy="x:c,c,c,c;xo:5px,5px,0,0;yo:250px,273px,74px,84px;"
                        data-text="w:normal;s:50,50,58,30;l:116,116,80,60;fw:400;" data-frame_0="y:-100%;"
                        data-frame_0_mask="u:t;" data-frame_1="st:310;sp:1200;sR:310;" data-frame_1_mask="u:t;"
                        data-frame_999="o:0;st:w;sR:7490;"
                        style="z-index:7;font-family:'Krona One', sans-serif;">{{ $slider->getDescription() }}
                    </rs-layer>

                    <a id="slider-1-slide-4-layer-5" class="rs-layer rs-selectable" href="contact-us.html"
                        data-type="text" data-rsp_ch="on"
                        data-xy="x:c,c,c,c;xo:-290px,-290px,0,0;yo:390px,420px,313px,205px;"
                        data-text="w:normal;s:12,12,12,12;l:22,22,22,22;fw:400;"
                        data-padding="t:13,13,13,10;r:30,30,30,30;b:12,12,12,10;l:30,30,30,30;"
                        data-border="bos:solid;boc:#fff;bow:2px,2px,2px,2px;bor:10px,10px,10px,10px;"
                        data-vbility="t,t,t,t" data-frame_0="y:-100%;"
                        data-frame_1="e:power4.inOut;st:1050;sp:500;sR:1050;" data-frame_999="o:0;st:w;sR:7450;"
                        data-frame_hover="c:#fff;bgc:#e33b28;bos:solid;boc:#e33b28;bow:2px,2px,2px,2px;bor:10px,10px,10px,10px;"
                        style="z-index:12; font-family:'Krona One', sans-serif; text-transform: uppercase;">Contact
                        Us
                    </a>
                </rs-slide>
            </rs-slides>
        @endforeach
    </rs-module>
</rs-module-wrap>
