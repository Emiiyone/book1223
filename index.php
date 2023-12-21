<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GoogleBooks</title>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="style.css" rel="stylesheet">
</head>
<body>
    <div class="wrapper">
        <div class="logoWrap">
            <h1 class="logo"><img src="https://www.google.com/intl/en_ALL/images/branding/googlelogo/2x/googlelogo_color_272x92dp.png" alt="google"></h1>
            <h2 class="cat">BOOKS</h2>
        </div>
        <div class="serch">
            <input type="text" id="key">
            <div class="buttonWrap"><button id="send">検索</button></div>
        </div>
        <div class="myPage"><a href="select.php">MY PAGE</a></div>
        <div class="bookList">
            <table id="list">
                
            </table>
            <button id="getCheckedValuesButton" style="display: none;">選んだ書籍を登録する</button>
        </div>

        <!-- Main[Start] -->
        <form method="post" action="insert.php">
            <div class="jumbotron" style="display:none;">
                <fieldset id="set">
                    <!-- <label for="Label1" id="selectedBookLabel1">Title:<input type="text" id="title" name="book"></label><br>
                    <label for="Label2" id="selectedBookLabel2">出版社:<input type="text" id="publisher" name="publisher"></label><br>
                    <label for="Label3" id="selectedBookLabel3">URL:<input type="text" id="link" name="link"></label><br>
                    <label for="Label4" id="selectedBookLabel4">画像のURL:<input type="text" id="imgLink" name="imgLink"></label><br>  -->
                </fieldset>
                <button id="submitFormButton">データベースに登録する</button>
            </div>
        </form>
    </div>
    <!-- Main[End] -->


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script>
    //検索ボタンをクリックしたら
    $("#send").on("click",function(){

        $(".logoWrap").addClass('small');
        $(".bookList").show();

        const url = "https://www.googleapis.com/books/v1/volumes?q="+$("#key").val(); 
        $.ajax({
            url: url,
            dataType: "json"
        }).done(function(data) {
            //書籍名、出版社、サムネイル[リンク]
            console.log(data);             //オブジェクトの中を確認
            const len = data.items.length; //データの数を取得
            let html = `
                <tr class="ttl">
                    <td>書籍名</td>
                    <td>出版社</td>
                    <td>書影</td>
                    <td>Check</td>
                </tr>
                `;
        
            for(let i=0; i<len; i++){
                console.log(typeof data.items[i].volumeInfo.publisher);
                if(typeof data.items[i].volumeInfo.authors=="undefined"){
                    data.items[i].volumeInfo.authors="著者（不明）";
                }
                const title = data.items[i].volumeInfo.title;
                const publisher = data.items[i].volumeInfo.authors;
                const link = data.items[i].volumeInfo.infoLink;
                const thumbnail = data.items[i].volumeInfo.imageLinks.thumbnail;

                const bookData = JSON.stringify({ title, publisher, link, thumbnail });
                //⇩htmlが上書きされずに追加されていく
                html += ` 
                <tr>
                        <td><a target="_blank" href="${data.items[i].volumeInfo.infoLink}">${title}</a></td>
                        <td>${publisher}</td>
                        <td><img src="${thumbnail}"></td>
                        <td>
                            <label><input type="checkbox" class="myCheckbox">
                            <span class="checkbox-fontas"></span>
                            </label>
                        </td>
                    </tr>
                `;
            }
            $("#getCheckedValuesButton").show();
            //table要素のid="list"に追加
            $("#list").empty().hide().append(html).fadeIn(1000);
        });
    });


    $("#getCheckedValuesButton").on("click", function () {
        const selectedBookDataArray = $(".myCheckbox:checked").map(function () {
            return {
                title: $(this).closest("tr").find("td:eq(0)").text(),
                publisher: $(this).closest("tr").find("td:eq(1)").text(),
                link: $(this).closest("tr").find("a").attr("href"),
                thumbnail: $(this).closest("tr").find("img").attr("src")
            };
        }).get();
        window.location.href = '#set';

        $('#set').empty();

        selectedBookDataArray.forEach(function (bookData, index) {
            $('#set').append(`
                <div class="book-entry">
                    <div class="infoTxt">
                        <p class="shosekimei"><span>書籍名</span>: ${bookData.title}</p>
                        <p class="chosha"><span>著者</span>: ${bookData.publisher}</p>
                    </div>
                    <div class="infoImg">
                        <img src="${bookData.thumbnail}">
                    </div>
                    <div><button type="button" class="remove-book">削除</button></div>
                    <!-- 隠しフィールド -->
                    <input type="hidden" name="title[]" value="${bookData.title}">
                    <input type="hidden" name="publisher[]" value="${bookData.publisher}">
                    <input type="hidden" name="link[]" value="${bookData.link}">
                    <input type="hidden" name="imgLink[]" value="${bookData.thumbnail}">
                </div>
            `);
        });
        $(".jumbotron").show();
    });


    // $("#getCheckedValuesButton").off("click").on("click", function () {
    // const selectedBookDataArray = $(".myCheckbox:checked").map(function () {
    //     const row = $(this).closest("tr");
    //     return {
    //         title: row.find("td:eq(0)").text(),
    //         publisher: row.find("td:eq(1)").text(),
    //         link: row.find("a").attr("href"),
    //         thumbnail: row.find("img").attr("src")
    //     };
    // }).get();
    // $(".jumbotron").show();

    // //このように置換可能（アロー関数の構文）
    // // const selectedBookDataArray = $(".myCheckbox:checked").map(() => ({
    // // title: $(this).closest("tr").find("td:eq(0)").text(),
    // // publisher: $(this).closest("tr").find("td:eq(1)").text(),
    // // link: $(this).closest("tr").find("a").attr("href"),
    // // thumbnail: $(this).closest("tr").find("img").attr("src")
    // // })).get(); ☜jqeryのバージョンによっては、よしなにjsの配列型にしてくれるから、省略可能
    // //(引数) => { // 処理内容 };
    // //const 変数名 = (引数) => { // 処理内容 };

    // // 入力フィールドをクリア☜これやらないと、複数データが取れない
    // $('#set').empty();
    

    // 新しい入力フィールドを追加
    
    // selectedBookDataArray.forEach(function (bookData, index) {
    //         $('#set').append(`
    //         <div class="book-entry">
    //             <p class="label-title">
    //                 <label for="title${index + 1}">Title:</label>
    //                 <input type="text" id="title${index + 1}" name="title[]" value="${bookData.title || ''}">
    //             </p>
    //             <p class="label-publisher">
    //                 <label for="publisher${index + 1}">出版社:</label>
    //                 <input type="text" id="publisher${index + 1}" name="publisher[]" value="${bookData.publisher || ''}">
    //             </p>
    //             <p class="label-link">
    //                 <label for="link${index + 1}">URL:</label>
    //                 <input type="text" id="link${index + 1}" name="link[]" value="${bookData.link || ''}">
    //             </p>
    //             <p class="label-imgLink">
    //                 <label for="imgLink${index + 1}">画像のURL:</label>
    //                 <input type="text" id="imgLink${index + 1}" name="imgLink[]" value="${bookData.thumbnail || ''}">
    //             </p>
    //             <p><button type="button" class="remove-book">削除</button></p>
    //         </div>
    //         `);
    //     });
    // });

    $('#set').on('click', '.remove-book', function() {
        $(this).closest('.book-entry').remove();
    });

    let formData //関数外でも使えるようにここに宣言しとく

    $("#submitFormButton").click(function (e) {
        e.preventDefault(); // フォームのデフォルト送信を阻止       

        // let formData = {
        //     'title' : $('input[name=title]').map(function(){ return $(this).val(); }).get(),
        //     'publisher' : $('input[name=publisher]').map(function(){ return $(this).val(); }).get(),
        //     'link' : $('input[name=link]').map(function(){ return $(this).val(); }).get(),
        //     'imgLink' : $('input[name=imgLink]').map(function(){ return $(this).val(); }).get()
        // };
        console.log('1',formData);
        formData = {
        // 'title' : $('input[name=title]').map(function(){ return $(this).val(); }).get(),では値が取れない！
        'title' : $('input[name="title[]"]').map(function(){ return $(this).val(); }).get(),
        'publisher' : $('input[name="publisher[]"]').map(function(){ return $(this).val(); }).get(),
        'link' : $('input[name="link[]"]').map(function(){ return $(this).val(); }).get(),
        'imgLink' : $('input[name="imgLink[]"]').map(function(){ return $(this).val(); }).get()
        };
        console.log('2',formData);
        // formData = {
        // // 'title' : $('input[name=title]').map(function(){ return $(this).val(); }).get(),では値が取れない！
        // 'title' : $('input[name="title[]"]').map(function(){ return $(this).val(); }).get(),
        // 'publisher' : $('input[name="publisher[]"]').map(function(){ return $(this).val(); }).get(),
        // 'link' : $('input[name="link[]"]').map(function(){ return $(this).val(); }).get(),
        // 'imgLink' : $('input[name="imgLink[]"]').map(function(){ return $(this).val(); }).get()
        // };

        
        //console.log(formData);
        //データベースに登録
        $.ajax({
            type: 'POST',
            url: 'insert.php',
            data: formData,
            dataType: 'json'
        })
        .done(function(data) {
            console.log(data); 
            window.location.href = 'index.php'; 
        })
        .fail(function(jqXHR, textStatus, errorThrown) {
            console.log("Ajax Error:", textStatus);
        });

    });

    </script>


</body>

</html>
