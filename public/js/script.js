$('#search').on('keyup', function(){
    $value = $(this).val();
    $.ajax({
        type:'get',
        url: '{{ URL::to('search') }}'
    })
});