<footer class="footer">
    <img src="/frontend/assets/image/bg-contrinhdathicon.png" alt="" class="background">
    <div class="footer__background">
        <div class="container">
            <div class="footer__start row">
                <div class="col-md-4 col-12">
                    <div class="d-flex">
                        <i class="fa-solid fa-address-book footer__book"></i>
                        <div class="box__book">
                            <p>Thông tin liên hệ</p>
                            <h4 class="footer-book_text">Vật Liệu Xây Dựng Hà Nội</h4>
                        </div>
                    </div>
                    <p class="footer__address">{{$setting->address}}</p>
                    <ul class="footer-list__address">
                        <li><a href=""><i class="color__address fa-solid fa-phone"></i> {{$setting->phone}}</a></li>
                        <li><a href=""><i class="color__address fa-solid fa-envelope"></i>
                                {{$setting->email}}</a></li>
                        <li><a href=""><i class="color__address fa-solid fa-globe"></i>
                                {{$setting->website}}</a></li>
                        <li><a href=""><i class="color__address fa-solid fa-globe"></i>
                                {{$setting->facebook}}</a></li>
                    </ul>
                </div>
                <div class="col-md-4 col-12">
                    <h4 class="footer__title">Quy định & Chính sách</h4>
                    <ul class="list-style-circle">
                        <li><a href="">Chính sách thanh toán</a></li>
                        <li><a href="">Chính sách bảo hành - đổi trả</a></li>
                        <li><a href="">Chính sách bảo mật thông tin</a></li>
                        <li><a href="">Giao nhận - vận chuyển hàng</a></li>
                    </ul>
                </div>
                <div class="col-md-4 col-12">
                    <h4 class="footer__title">Hỗ trợ khách hàng</h4>
                    <ul class="list-style-circle">
                        <li><a href="">Chính sách đại lý - phân phối</a></li>
                        <li><a href="">Dịch vụ tư vấn miễn phí</a></li>
                        <li><a href="">Hỗ trợ kỹ thuật miễn phí</a></li>
                        <li><a href="">Các chương trình khuyến mãi</a></li>
                    </ul>
                    <div>
                        <h4 class="footer__title">Đăng ký nhận bản tin</h4>
                        <div class="footer__email row flex">
                            <input type="email" class="form-control form__email" placeholder="Your email">
                            <button class="footer__submit" type="submit">SIGN UP</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="footer-end p-3">
        <div class="pb-2">
            <ul class="d-flex justify-content-center footer__card">
                <li><a href="#">
                        <i class="fa-brands fa-cc-visa"></i>
                    </a></li>
                <li><a href="#">
                        <i class="fa-brands fa-cc-paypal"></i>
                    </a></li>
                <li><a href="#">
                        <i class="fa-brands fa-cc-stripe"></i>
                    </a></li>
                <li><a href="#">
                        <i class="fa-brands fa-cc-mastercard"></i>
                    </a></li>
                <li><a href="#">
                        <i class="fa-brands fa-cc-discover"></i>
                    </a></li>
            </ul>
        </div>
        <p class="text-center footer__text">Copyright 2022 © N.X.Thanh_179</p>
    </div>
</footer>
