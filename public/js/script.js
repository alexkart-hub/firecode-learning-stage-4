$("[id ^= 'add_to_cart_']").on({
    click: function(e) {
        id = this.id.substr(-4, 4);
        $.ajax({
            type: 'GET',
            url: "",
            data: {
                id: id,
            },
            success: function(data) {
                updateLittleCart(data);
            }
        });
    }
});

function updateLittleCart(data) {
    d = JSON.parse(data);
    // console.log(d);
    $('.cart_quantity').text(d.count);
    $('.cart_total p span').text(d.total_price + " ");
}

function updateBigCart(data) {
    d = JSON.parse(data);
    // console.log(d);
    $('.total_item_' + d.id + ' .f').text(d.price + " р.");
    $('.product_price span').text(d.total_price + " ");
}


$('#clear_cart').on({
    click: function(e) {
        $.ajax({
            type: 'GET',
            url: "",
            data: {
                clear: true
            },
            success: function(html) {
                console.log(111);
                location.reload(false);
            }
        });
    }
});

$('.delete_item').on({
    click: function(e) {
        $.ajax({
            type: 'GET',
            url: "",
            data: {
                delete_id: this.id.substr(7)
            },
            success: function(html) {
                // console.log(html);
                location.reload(false);
            }
        });
    }
});

$('.plus').on({
    click: function(e) {
        console.log(this.id);
        val = +$('#quantity_' + this.id.substr(9)).val() + 1;
        $('#quantity_' + this.id.substr(9)).val(val);
        query(this.id.substr(9), val);
    }
});

$('.minus').on({
    click: function(e) {
        val = +$('#quantity_' + this.id.substr(9)).val();
        val = val == 1 ? val : val - 1;
        $('#quantity_' + this.id.substr(9)).val(val);
        query(this.id.substr(9), val);
    }
});

$('.quantity').on({
    input: function(e) {
        // console.log(this.value);
        query(this.id.substr(9), this.value);
    }
});

function query(id, value) {
    $.ajax({
        type: 'GET',
        url: "",
        data: {
            id: id,
            value: value
        },
        success: function(html) {
            updateLittleCart(html);
            updateBigCart(html);
            // console.log(html);
            // location.reload(false);
        }
    });
}

$('.p_plus').on({
    click: function(e) {
        console.log(this.id);
        val = +$('#p_quantity').val() + 1;
        $('#p_quantity').val(val);
    }
});

$('.p_minus').on({
    click: function(e) {
        val = +$('#p_quantity').val();
        val = val == 1 ? val : val - 1;
        $('#p_quantity').val(val);
    }
});

$("[id ^= 'p_add_to_cart_']").on({
    click: function(e) {
        id = this.id.substr(-4, 4);
        $.ajax({
            type: 'GET',
            url: "",
            data: {
                id: id,
                quantity: $('#p_quantity').val()
            },
            success: function(data) {
                updateLittleCart(data);
            }
        });
    }
});