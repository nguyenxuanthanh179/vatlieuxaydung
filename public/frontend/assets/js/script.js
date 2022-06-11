
// ============= fixed header and btn scroll top==================
var mybutton = document.getElementById("btnScrollToTop");
var menu = document.getElementById("scroll");
window.onscroll = function() {
    if (window.scrollY > 190) {
        menu.classList.add("sticky");
        mybutton.style.display = "block";
    } else {
        menu.classList.remove("sticky");
        mybutton.style.display = "none";
    }
}
$('#btnScrollToTop').click(function(){
    window.scrollTo({
            top: 0,
            left: 0,
            behavior: "smooth"
        }
    )
});

// ============silder image details product==========

let thumbnails = document.getElementsByClassName('thumbnail')

let activeImages = document.getElementsByClassName('active')

for (var i=0; i < thumbnails.length; i++){

  thumbnails[i].addEventListener('click', function(){
    // console.log(activeImages)

    if (activeImages.length > 0){
      activeImages[0].classList.remove('active')
    }
    this.classList.add('active')
    document.getElementById('featured').src = this.src
  })
}
$("#slideRight").click(function(){
    $("#slider").scrollLeft(+180)
});
$("#slideLeft").click(function(){
    $("#slider").scrollLeft(-180)
});

// ============chuyển tab============
$(document).ready(function()
{
    // Hàm active tab nào đó
    function activeTab(obj)
    {
        // Xóa class active tất cả các tab
        $('.tab-wrapper ul li').removeClass('active');

        // Thêm class active vòa tab đang click
        $(obj).addClass('active');

        // Lấy href của tab để show content tương ứng
        var id = $(obj).find('a').attr('href');

        // Ẩn hết nội dung các tab đang hiển thị
        $('.tab-item').hide();

        // Hiển thị nội dung của tab hiện tại
        $(id) .show();
    }

    // Sự kiện click đổi tab
    $('.tab li').click(function(){
        activeTab(this);
        return false;
    });

    // Active tab đầu tiên khi trang web được chạy
    activeTab($('.tab li:first-child'));
});



// =========== slider product ==========
$(document).ready(function(){
  if($('.bbb_viewed_slider').length){
    var viewedSlider = $('.bbb_viewed_slider');
    viewedSlider.owlCarousel(
      {
        loop:true,
        margin:30,
        autoplay:true,
        autoplayTimeout:4000,
        nav:false,
        dots:false,
        responsive:
      {
        250 :{items:1},
        333:{items:2},
        575:{items:2},
        767:{items:3},
        1024:{items:4},
        1199:{items:4}
      }
    });

    if($('.bbb_viewed_prev').length){
      var prev = $('.bbb_viewed_prev');
      prev.on('click', function(){
        viewedSlider.trigger('prev.owl.carousel');
      });
    }

    if($('.bbb_viewed_next').length){
      var next = $('.bbb_viewed_next');
      next.on('click', function(){
        viewedSlider.trigger('next.owl.carousel');
      });
    }
  }
});

//=============category sub menu=============
$('.category-sub-menu ul li.has-sub > a').on('click', function () {
    $(this).removeAttr('href');
    var element = $(this).parent('li');
    if (element.hasClass('open')) {
        element.removeClass('open');
        element.find('li').removeClass('open');
        element.find('ul').slideUp();
    } else {
        element.addClass('open');
        element.children('ul').slideDown();
        element.siblings('li').children('ul').slideUp();
        element.siblings('li').removeClass('open');
        element.siblings('li').find('li').removeClass('open');
        element.siblings('li').find('ul').slideUp();
    }
});

//====== thông báo hết hàng ==========
$('.add__cart1').click(function(){
    // tìm cái thằng có id = toast rồi gán vào biến toast
    var toast = document.getElementById("toast");
    toast.className = "show"; // Thêm class "show" vào toast
    // hàm setTimeout, Sau 3s sẽ thực hiện function xóa bỏ class "show" khỏi thằng toast
    setTimeout(function(){
        toast.className = toast.className.replace("show", "");
    }, 2000);

});


//============= Giỏ hàng ==============
$(function () {
    // xóa sản phẩm khỏi giỏ hàng
    $(document).on("click", '.remove-to-cart', function () {
        var result = confirm("Bạn có chắc chắn muốn xóa sản phẩm này khỏi giỏ hàng ?");
        if (result) {
            var product_id = $(this).attr('data-id');
            $.ajax({
                url: '/gio-hang/xoa-sp-gio-hang/' + product_id,
                type: 'get',
                data: {
                    id: product_id
                }, // dữ liệu truyền sang nếu có
                dataType: "HTML", // kiểu dữ liệu trả về
                success: function (response) {
                    $('#my-cart').html(response);
                },
                error: function (e) { // lỗi nếu có
                    console.log(e.message);
                }
            });
        }
    });

    // cập nhật số lượng của từng sản phẩm trong giỏ hàng
    $(document).on("click", '.update-qty', function (e) {
        var rowId = $(this).attr('data-id');
        var qty = $(this).closest('.quantity').find('.item-qty').val(); // lấy số lượng của ô input
        // Kiểm tra Nếu không phải là số nguyên Hoặc số lượng < 1
        if (isNaN(qty) || qty < 1) {
            alert("Số lượng là số nguyên lớn hơn >= 1");
            $(this).closest('.quantity').find('.item-qty').val(1);
            return false;
        }
        if (qty > 99) {
            alert("Số lượng đặt quá giới hạn cho phép, hãy liên hệ để đặt số lượng lớn");
            $(this).closest('.quantity').find('.item-qty').val(1);
            return false;
        }
        $.ajax({
            url: '/gio-hang/cap-nhat-so-luong-sp',
            type: 'get',
            data: {
                rowId: rowId,
                qty: qty
            }, // dữ liệu truyền sang nếu có
            dataType: "HTML", // kiểu dữ liệu trả về
            success: function (response) {
                if (response != false) {
                    $('#my-cart').html(response);
                }
            },
            error: function (e) { // lỗi nếu có
                console.log(e.message);
            }
        });
    });
})


$('input.input-qty').each(function() {
    var $this = $(this),
        qty = $this.parent().find('.is-form'),
        min = Number($this.attr('min')),
        max = Number($this.attr('max'))
    if (min == 0) {
        var d = 0
    } else d = min
    $(qty).on('click', function() {
        if ($(this).hasClass('minus')) {
            if (d > min) d += -1
        } else if ($(this).hasClass('plus')) {
            var x = Number($this.val()) + 1
            if (x <= max) d += 1
        }
        $this.attr('value', d).val(d)
    })
})
