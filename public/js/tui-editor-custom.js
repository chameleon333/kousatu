
//エディターから画像挿入時に走る
function ImageUpload(images){
    var upload_file = "";
    console.log(images);
    var dataimg = new FormData();
    dataimg.append('image', images);
    console.log("dataimg "+dataimg.get('image'));
    console.log("dataimg2 "+dataimg);
    
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        // url:'{{ action("ArticlesController@store") }}',
        url:'/articles',
        type: 'POST',
        async: false,
        cache: false,
        contentType: false,
        processData: false,
        data: dataimg,
            success: function(response){
                console.log("response: "+response);
                upload_file = response;
            },
            error:function (XMLHttpRequest, textStatus, errorThrown) {
                alert('error');
                console.log(XMLHttpRequest);
                console.log(textStatus);
                console.log(errorThrown);
            }
    });

    return upload_file;

}

//記事投稿の際、エディター内データをtextareaに写して、postを受け取る
function callBody(){
    document.getElementById('edit_content').innerHTML = this.editor.getMarkdown();
}


this.editor = new tui.Editor({
    el: document.querySelector('#editSection'),
    previewStyle: 'vertical',
    height: '500px',
    placeholder: 'Markdawn記法であなたの考察を共有しましょう！',
    hooks: {
        addImageBlobHook: function(blob, callback){
            var upload_file = ImageUpload(blob);
            console.log("upload_file "+upload_file);
            callback(upload_file, 'alt text');
        }
    },
    initialEditType: 'markdown',
    toolbarItems: ['heading',
    'bold',
    'italic',
    'strike',
    'divider',
    'hr',
    'quote',
    'divider',
    'ul',
    'ol',
    'task',
    'indent',
    'outdent',
    'divider',
    'table',
    'image',
    'link',
    'divider',
    'code',
    'codeblock',
    'divider',],
    hideModeSwitch:true
});
//textareaから取得したデータの改行コードを統一する
var body = document.getElementById('edit_content').value.replace(/\r\n|\r/g, "\n");
var lines = body.split('¥n');
var content = [lines].join('¥n');

editor.setValue(content);

// ModeSwitch = new ModeSwitch($rootElement,initialType);
