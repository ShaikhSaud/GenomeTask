$(function(){
    $('#citySelect').select2();

    $('form').submit((e)=>{
        e.preventDefault();

        let loading = $('#loading');
        let weather = $('#weatherCard');
        let error = $('#errorPanel');

        error.html('').addClass('d-none');
        weather.addClass('d-none');
        loading.removeClass('d-none');

        $.ajax({
            url: $(e.target).attr('action'),
            type: 'POST',
            data: $(e.target).serialize(),
            success: (res)=>{
                console.log(res);
                $('.date').html(res.date);
                $('.month').html(res.month);
                $('.w-icon').attr('src', `https://openweathermap.org/img/wn/${res.icon}.png`);
                $('.condition').html(res.title);
                $('.temp').html(res.temp+'°');
                $('.location').html(res.city+', '+res.country);
                $('.wind').html(`${res.wind} MPH`);
                $('.feels').html(`${res.feels}°`);
                $('.humidity').html(`${res.humidity}%`);
                $('.pressure').html(`${res.pressure} mb`);

                weather.removeClass('d-none');
            },
            error: (err)=>{
                if(err.status == 422){
                    let msgHtml = `<p>${err.responseJSON.message}</p><br><ul>`;
    
                    let obj =  err.responseJSON.errors;
    
                    for (var i in obj) {
                        if (obj.hasOwnProperty(i)) {
                            msgHtml += `<li>${obj[i]}</li>`;
                        }
                    }
    
                    msgHtml += `</ul>`;
                    
                    error.html(msgHtml).removeClass('d-none');
                } else if(err.status == 404){
                    error.html(err.responseJSON.msg).removeClass('d-none');
                } else{
                    alert("An error occured while submitting your form.");
                }
                console.error(err);
            },
            complete: ()=>{
                loading.addClass('d-none');
            }
        });
    });

    $('#citySelect').change((e)=>{
        $('form').submit();
    });
});