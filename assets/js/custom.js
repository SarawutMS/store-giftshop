function basket(URL, ProductID, ACTION, AMOUNT) {
    console.log(URL);
    console.log(ProductID);
    console.log(ACTION);
    console.log(AMOUNT);
    if (URL != '') {
        if (AMOUNT == 0) {
            $.get(URL, { productid: ProductID, action: ACTION });
        } else {
            $.get(URL, { productid: ProductID, action: ACTION, amount: AMOUNT });
        }

    }

}

$("#btn_step").on('click', function (event) {

    $('#order_step1').fadeOut();
    $('#order_step2').fadeIn();
});
$("#btn_step2").on('click', function (event) {

    $('#order_step1').fadeIn();
    $('#order_step2').fadeOut();
});

$("#changepassword").on('click', function (event) {

    $('#changepass_box').fadeIn();
    $('#myprofile').fadeOut();
});

$("#return_changepassword").on('click', function (event) {
    $('#changepass_box').fadeOut();
    $('#myprofile').fadeIn();
});

function category(name,id) {
    $('#cate_step_1').fadeOut();
    $('#cate_step_2').fadeIn();
    $('#category_id').val(id);
    $('#category_name').val(name);
}
function return_category() {
    $('#cate_step_2').fadeOut();
    $('#cate_step_1').fadeIn();
}

function add_category() {
    $('#cate_step_2').fadeOut();
    $('#cate_step_1').fadeOut();
    $('#cate_step_3').fadeIn();
}

function update_total(s) {
    $.get(s, { id: 'tester' }, function (data) {
        $('#total_price_cart').html(data.total_price);
        $('#total_price_cart2').html(data.total_price);
        $('#TOTAL_QTY').html('จำนวนสินค้า: ' + data.total_qty);
    }, 'json');
}

const formatter = new Intl.NumberFormat('en-US');

function post_ajax(s, c = []) {
    const swalWithBootstrapButtons = Swal.mixin({
        buttonsStyling: true,
    })
    
    titles = "<h1 style='color:black'>แจ้งเตือน</h1>";
    message = 'คุณแน่ใจหรือไม่ที่จะดำเนินการต่อ';
    swalWithBootstrapButtons.fire({
        title: titles,
        text: message,
        icon: 'warning',
        showClass: {
            popup: 'animated fadeInDown faster',
            text: 'text-dark'
        },
        hideClass: {
            popup: 'animated fadeOutUp faster'
        },
        showCancelButton: true,
        confirmButtonText: 'ตกลง',
        cancelButtonText: 'ยกเลิก',
        customClass: {
            text: 'text-dark' //insert class here
        },
        reverseButtons: true
    }).then((result) => {
        if (result.value) {

            $.post(s, c, function (data) {
                if (data.type == "success") {
                    if (data.target === "") {
                        swalWithBootstrapButtons.fire(titles, data.alert, 'success')
                    } else {
                        window.location.href = data.target;
                    }
                } else {
                    swalWithBootstrapButtons.fire(titles, data.alert, 'error')
                }
            }, 'json');

        } else if (
            result.dismiss === Swal.DismissReason.cancel
        ) {
            swalWithBootstrapButtons.fire(
                titles,
                'การยกเลิกรายการสำเร็จ',
                'error'
            )
        }
    })
}

function deletes(s, c = []) {
    const swalWithBootstrapButtons = Swal.mixin({
        buttonsStyling: true,
    })
    titles = "<h1 style='color:black'>แจ้งเตือน</h1>";
    message = 'คุณแน่ใจหรือไม่ที่จะทำรายการนี้';
    swalWithBootstrapButtons.fire({
        title: titles,
        text: message,
        icon: 'warning',
        showClass: {
            popup: 'animated fadeInDown faster',
            text: 'text-dark'
        },
        hideClass: {
            popup: 'animated fadeOutUp faster'
        },
        showCancelButton: true,
        confirmButtonText: 'ตกลง',
        cancelButtonText: 'ยกเลิก',
        customClass: {
            text: 'text-dark' //insert class here
        },
        reverseButtons: true
    }).then((result) => {
        if (result.value) {

            $.post(s, { id: c }, function (data) {
                if (data.type == "success") {
                    if (data.target === "") {
                        swalWithBootstrapButtons.fire(titles, data.alert, 'success')
                    } else {
                        window.location.href = data.target;
                    }
                } else {
                    swalWithBootstrapButtons.fire(titles, data.alert, 'error')
                }
            }, 'json');

        } else if (
            result.dismiss === Swal.DismissReason.cancel
        ) {
            swalWithBootstrapButtons.fire(
                titles,
                'การยกเลิกรายการสำเร็จ',
                'error'
            )
        }
    })
}
function post_ajax_cart(s) {
    const swalWithBootstrapButtons = Swal.mixin({
        buttonsStyling: true,
    })
    titles = "<h1 style='color:black'>แจ้งเตือน</h1>";
    message = 'คุณแน่ใจหรือไม่ที่จะทำรายการนี้';
    swalWithBootstrapButtons.fire({
        title: titles,
        text: message,
        icon: 'warning',
        showClass: {
            popup: 'animated fadeInDown faster',
            text: 'text-dark'
        },
        hideClass: {
            popup: 'animated fadeOutUp faster'
        },
        showCancelButton: true,
        confirmButtonText: 'ตกลง',
        cancelButtonText: 'ยกเลิก',
        customClass: {
            text: 'text-dark' //insert class here
        },
        reverseButtons: true
    }).then((result) => {
        if (result.value) {

            $.post(s, { id: 'tester' }, function (data) {
                if (data.type == "success") {
                    if (data.target === "") {
                        swalWithBootstrapButtons.fire(titles, data.alert, 'success')
                    } else {
                        window.location.href = data.target;
                    }
                } else {
                    swalWithBootstrapButtons.fire(titles, data.alert, 'error')
                }
            }, 'json');

        } else if (
            result.dismiss === Swal.DismissReason.cancel
        ) {
            swalWithBootstrapButtons.fire(
                titles,
                'การยกเลิกรายการสำเร็จ',
                'error'
            )
        }
    })
}