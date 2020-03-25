$('#add_profile_image').change(function(e){
    var file = e.target.files[0];
    var reader = new FileReader();
    
    //画像でない場合処理を終了する
    if(file.type.indexOf("image") < 0){
        alert("画像ファイルを選択してください。")
        return false;
    }

    reader.onload = (function(file) {
        return function(e) {
            $("#dispaly_profile_image").attr("src", e.target.result);
            $("#dispaly_profile_image").attr("title", file.name);
        };
    })(file);
    reader.readAsDataURL(file);
});

function on_click(){
    console.log("on_click");
}