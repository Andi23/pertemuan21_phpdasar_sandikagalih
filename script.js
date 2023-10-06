$(document).ready(function () {
    $('#cari').hide();

    //even ketika ngetik
    $('#keyword').on('keyup', function () {

        //parameter pertama id elemen html
        // kedua even + function
        //     //parameter pertama id elemen html
        //     //even
        //     //kedua lokasi sumber file
        //     //ketiga value
        //contoh ajax[jquery] load menggunakan 
        //     $('#container').load('ajax/mahasiswa.php?keyword=' + $('#keyword').val());
        // })
        $('.loader').show();

        //contah menggunakan get[jquery]

        $.get('ajax/mahasiswa.php?keyword=' + $('#keyword').val(), function (data) {
            $('#container').html(data);
            $('.loader').hide();
        });
    });

});