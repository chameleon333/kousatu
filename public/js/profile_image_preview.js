$('#add_profile_image').change(function(e){
    var file = e.target.files[0];
    var reader = new FileReader();

    var cvs = document.getElementById('canvas_profile_image');
    var ctx = cvs.getContext('2d');

    //画像でない場合処理を終了する
    if(file.type.indexOf("image") < 0){
        return false;
    }

    //アップロードした画像を設定する
    reader.onload = (function(file) {
        return function(e) {
            var img = new Image();
            img.src = e.target.result;
            img.onload = function() {
                ctx.drawImage(img, 0,0,300,300);
            }
        };
    })(file);
    reader.readAsDataURL(file);
});

function on_click(){
    console.log("on_click");
}