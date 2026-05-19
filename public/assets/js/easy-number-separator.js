
var commaCounter = 10;
function numberSeparator(Number) {
    Number += '';

    for (var i = 0; i < commaCounter; i++) {
        Number = Number.replace(',', '');
    }

    x = Number.split('.');
    y = x[0];
    z = x.length > 1 ? '.' + x[1] : '';
    var rgx = /(\d+)(\d{3})/;

    while (rgx.test(y)) {
        y = y.replace(rgx, '$1' + ',' + '$2');
    }
    commaCounter++;
    return y + z;
}

function numberFormat(amount, decimals = 2) {
    // Ensure the amount is a number and fixed to the required decimal places
    let formattedAmount = parseFloat(amount).toFixed(decimals);

    // Convert the amount into a string and add commas for thousands
    return formattedAmount.replace(/\B(?=(\d{3})+(?!\d))/g, ",");
}

$(document).ready(function () {
    $(document).on('keypress , paste', '.number-separator', function (e) {
        if (/^-?\d*[,.]?(\d{0,3},)*(\d{3},)?\d{0,3}$/.test(e.key)) {
            $('.number-separator').on('input', function () {
                e.target.value = numberSeparator(e.target.value);
            });
        } else {
            e.preventDefault();
            return false;
        }
    });
})