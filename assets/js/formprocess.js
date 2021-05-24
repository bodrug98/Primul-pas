function calculateEquation() {
    $('input').removeClass('is-invalid');

    let _a = $('input[name=a]').val();
    let _b = $('input[name=b]').val();
    let _c = $('input[name=c]').val();

    let existsErrors = false;

    if (!_a) {
        $('input[name=a]').addClass('is-invalid');
        existsErrors = true;
    }

    if (!_b) {
        $('input[name=b]').addClass('is-invalid');
        existsErrors = true;
    }

    if (!_c) {
        $('input[name=c]').addClass('is-invalid');
        existsErrors = true;
    }
    
    if (existsErrors) {
        return;
    }

    var formData = {
        'a': _a,
        'b': _b,
        'c': _c,
    };

    $.ajax({
        type: 'POST', 
        url: '/equations/App/calculate_equation.php',
        data: formData
    }).done(function (data) {
        console.log("Data = ", data)
        let response = JSON.parse(data);

        if (response.error) {
            $('.results-data').html(`<p class="results-error">${response.error}</p>`);
        } else {
            $('.results-data').html(returnResultElement("x1", response.data.x1) + "<br>" + returnResultElement("x2", response.data.x2));
        }
        
    });
}

function resetForm() {
    $('input').removeClass('is-invalid');
    $('input').val("");

    $('.results-data').empty();
}

function returnResultElement(label, value) {
    return  `<span class="result">${label} = <span class="result-value">${value}</span></span>`
}

