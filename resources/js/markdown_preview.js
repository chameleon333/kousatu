//textareaから取得したデータの改行コードを統一する
var body = document.getElementById('edit_content').value.replace(/\r\n|\r/g, "\n");
var lines = body.split('¥n');
var content = [lines].join('¥n');

document.getElementById('preview_marked').innerHTML = marked(content)