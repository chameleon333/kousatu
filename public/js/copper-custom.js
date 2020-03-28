function getCanvas(sourceCanvas){
    var canvas = document.createElement('canvas');
    var context = canvas.getContext('2d');
    var width = sourceCanvas.width;
    var height = sourceCanvas.height;

    canvas.width = width;
    canvas.height = height;
    context.drawImage(sourceCanvas, 0, 0, width, height);
    return canvas;

}

$(function(){

    $('#add_profile_image').on('change', function(event){
        var trimingImage = event.target.files;

        trimingImage = trimingImage[0];

        // 画像のチェックを行いますが、あくまでjsでのチェックなのでサーバーサイドでもう一度チェックを行ってください。
        if(!trimingImage.type.match('image/jp.*') // jpg jpeg でない
            &&!trimingImage.type.match('image/png') // png でない
            &&!trimingImage.type.match('image/gif') // gif でない
            &&!trimingImage.type.match('image/bmp') // bmp でない
        ){
            alert(trimingImage.type + 'は登録できません。');
            $(this).val('');
            return false;
        }

        var fileReader = new FileReader();

        fileReader.onload = function(e){
            var int32View = new Uint8Array(e.target.result);
            if((int32View.length>4 && int32View[0]==0xFF && int32View[1]==0xD8 && int32View[2]==0xFF && int32View[3]==0xE0)
            || (int32View.length>4 && int32View[0]==0xFF && int32View[1]==0xD8 && int32View[2]==0xFF && int32View[3]==0xDB)
            || (int32View.length>4 && int32View[0]==0xFF && int32View[1]==0xD8 && int32View[2]==0xFF && int32View[3]==0xD1)
            || (int32View.length>4 && int32View[0]==0x89 && int32View[1]==0x50 && int32View[2]==0x4E && int32View[3]==0x47)
            || (int32View.length>4 && int32View[0]==0x47 && int32View[1]==0x49 && int32View[2]==0x46 && int32View[3]==0x38)
            || (int32View.length=2 && int32View[0]==0x42 && int32View[1]==0x4D && int32View[2]==0x46 && int32View[3]==0x38)
            ){ 
                //成功時
                $('#display_profile_image').css('display', 'block'); //モーダル表示
                $('#display_profile_image').attr('src', URL.createObjectURL(trimingImage));
                return true;
            } else {
                //失敗時
                alert(trimingImage.type + 'は登録できません。');
                $('#display_profile_image').val('');
                return false;
            }
        };

        $('#exampleModalCenter').modal();

        fileReader.readAsArrayBuffer(trimingImage);

        fileReader.onloadend = function(e){
            var image = document.getElementById('display_profile_image');
            var button = document.getElementById('crop_btn');
            console.log(image);
            console.log(cropper);
            var croppable = false;
            var cropper = new Cropper(image, {
                aspectRatio: 1,
                viewMode: 1,
                ready: function () {
                    croppable = true;
                },
            });
            console.log(croppable);
            // fileReaderが完了した後にボタンクリックイベントを作成する必要があります。
            button.onclick = function(){
                var croppedCanvas;
                if (!croppable) {
                    alert('トリミングする画像が設定されていません。');
                    return false;
                }
                
                // cropper.jsに用意されている機能
                croppedCanvas = cropper.getCroppedCanvas();
                // 下記toBlob関数はブラウザによって名前が違います。
                var blob;

                if(croppedCanvas.toBlob){
                    croppedCanvas.toBlob(function(blob){
                        var trimedImageForm = new FormData();
                        trimedImageForm.append('blob', blob);
                    });
                }

                // 画面にトリミング結果を出力する
                var result = document.getElementById('result');
                var Image;
                Canvas = getCanvas(croppedCanvas);
                Image = document.createElement('img');
                Image.src = Canvas.toDataURL()
                Image.name = 'trimed';
                Image.id = 'trimed';
                Image.style = 'width:150px';
                result.innerHTML = '';
                result.appendChild(Image);

            }

        }


    });

});
