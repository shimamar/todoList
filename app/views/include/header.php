<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ログイン画面</title>
    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <!-- Bootstrapの読み込み -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

    <title>todoリスト</title>

    <style>

    .container {
        background: #E5F8F3;
    }
    .link {
        background: #3AD6B2;
        transition: 0.8s;
    }
    .link_text {
        color: white;
        white-space: nowrap;
    }
    .link:hover {
        background: #75E2C9;
    }
    .link_text:hover {
        color: #EBFAF7;
        text-decoration: none;
    }
    .title {
        color: #28957C;
    }
    .text {
        color: #28957C;
        white-space: nowrap
    }
    .input {
        background: #c6f0e5;
        color: black;
    }
    .input:hover {
        background: #88dfc8;
    }
    .list {
        background: #f4fcfa;
    }
    .list_text {
        color: #175547;
    }
    .list_text:hover {
        color: #2EAB8E;
    }
    .delete_btn {
        background:#a7e7d6;
        white-space: nowrap;
    }
    </style>
</head>
