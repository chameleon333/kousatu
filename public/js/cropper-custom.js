$(function(){
    
    var $avatar = document.getElementById('avatar');
    var $image = document.getElementById('image');
    var $input = document.getElementById('input');
    var $dummy_image = $('#dummy_image');
    var $binary_image = $('#binary_image');
    var $alert = $('.alert');
    var $modal = $('#modal');
    var cropper;

    $('[data-toggle="tooltip"]').tooltip();

    $input.addEventListener('change', function(e){
        var files = e.target.files;
        var done = function(url){
            $input.value = '';
            $image.src = url;
            $alert.hide();
            $modal.modal('show');
        };
        var reader;
        var file;
        var url;

        if(files && files.length > 0) {
            file = files[0];
            if(URL){
                done(URL.createObjectURL(file));
            } else if (FileReader) {
                reader = new FileReader();
                reader.onload = function(e) {
                    done(reader.result);
                };
                reader.readAsDataURL(file);
            }
        }
    });

    $modal.on('shown.bs.modal', function() {
        cropper = new Cropper($image, {
            aspectRatio: 1,
            viewMode: 3,
        });
    }).on('hidden.bs.modal', function() {
        cropper.destroy();
        cropper = null;
    });

    $('#crop').on('click', function(){
        var initialAvatarURL;
        var canvas;
        var dataURI;

        $modal.modal('hide');

        if(cropper) {
            canvas = cropper.getCroppedCanvas({
                width: 160,
                height: 160,
            });
            initialAvatarURL = avatar.src;
            dataURI = canvas.toDataURL() ;
            avatar.src = dataURI;
            $binary_image.val(dataURI.split(",")[1]);

            $dummy_image.hide();
            $avatar.style.display ="block";
            $alert.removeClass('alert-success alert-warning');
            canvas.toBlob(function(blob) {
                var formData = new FormData();

                formData.append('avatar', blob, 'avatar.jpg');
            });
        }
    });

});

