@php
$contacts = getContact();
@endphp
    <!-- Yandex.RTB R-A-5980996-3 -->
    <script>
        window.yaContextCb.push(()=>{
            Ya.Context.AdvManager.render({
                "blockId": "R-A-5980996-3",
                "type": "floorAd",
                "platform": "desktop"
            })
        })
    </script>
    <div class="container">
        <div class="footer-content pt-5 pb-5">
            <div class="row">
                <div class="col-xl-3 col-lg-3 mb-50">
                    <div class="footer-widget">
                        <div class="footer-logo">
                            <a href="#"><img src="{{asset('assets/icons/logo.png')}}" class="img-fluid" alt="logo"></a>
                        </div>
                        <div class="footer-text">
                            <p> Մեջբերումներ անելիս ակտիվ հղումը <span class="text-white">MediaMess</span>-ին պարտադիր է: Կայքի հոդվածների մասնակի հեռուստառադիոընթերցումն առանց <span class="text-white">MediaMess</span>-ին հղման արգելվում է: Կայքում արտահայտված կարծիքները պարտադիր չէ, որ համընկնեն կայքի խմբագրության տեսակետի հետ:
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-3 col-md-6 mb-30">
                    <div class="footer-widget">
                        <div class="footer-widget-heading my-3">
                            <h3>Բաժիններ</h3>
                        </div>
                        <ul>
                            @foreach($categories as $category)
                            <li><a href="{{ route('postsByCategory', ['id'=>$category->id, 'category' => $category->category]) }}">{{$category->category_name}}</a></li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-3 col-md-6 mb-50">
                    <div class="footer-widget">
                        <div class="footer-social-icon">
                            <div class="footer-widget-heading">
                                <h3>Հետևեք մեզ</h3>
                            </div>

                            @php
                                $icons = getAllIcons();
                            @endphp

                            @foreach($icons as $icon)
                                <a href="{{$icon->link}}" target="_blank"><i class="fa fa-{{$icon->icon}}" style="background: {{$icon->color}}"></i></a>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-3 col-md-6 mb-50">
                    <div class="footer-widget">
                        <div class="footer-social-icon">
                            <div class="footer-widget-heading">
                                <h3>Հեստադարձ կապ</h3>
                            </div>
                            <ul class="d-flex flex-column">
                                @foreach($contacts as $contact)
                                <li class="w-100"><label for="phone">Հեռախոսահամար։</label><a href="tel:{{$contact->phone}}" id="phone" class="px-2">{{$contact->phone}}</a></li>
                                <li class="w-100"><label for=email">Էլ․ հասցե։</label><a href="mailto:{{$contact->email}}" id="email" class="px-2">{{$contact->email}}</a></li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="copyright-area">
        <div class="container">
            <div class="row">
                <div class="col-xl-6 col-lg-6 text-center text-lg-left">
                    <div class="copyright-text">
                        <p> &copy; 2024, All Right Reserved</p>
                    </div>
                </div>
                <div class="col-xl-6 col-lg-6 d-none d-lg-block text-right">
                    <div class="footer-menu">
                        <ul>
                            <li><a href="#footer">Հետադարձ կապ</a></li>
                            <li><a href="#footer">Մեր մասին</a></li>
{{--                            <li><a href="#">Գովազդատուների համար</a></li>--}}
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
