<!doctype html>
<html>
<head>
<meta charset="utf-8" />
<title>animeshelf</title>
<link rel="stylesheet" type="text/css" href="reset.css" />
<link rel="stylesheet" type="text/css" href="template.css" />
<link rel="stylesheet" type="text/css" href="add_my_anime.css" />

<script type="text/javascript">
window.onload = function () {
  var comment = document.getElementById('comment');
  comment.addEventListener('keydown', function (data){
    console.log(data);
    if (data.keyCode === 13) {
      if (data.ctrlKey) {
        document.sendForm.submit();
        return false;
      }
    }
  });
}
</script>
</head>
<body>

<header>
<h1><a href="index.php">animeshelf</a></h1>
<nav>
<ul>
<li><h2><a href="index.php">{$userName}</a></h2></li>
<li class="current"><h2><a href="add_my_anime.php">みた登録</a></h2></li>
<li><h2><a href="shelf/">My シェルフ</a></h2></li>
<li><h2><a href="logout.php">ログアウト</a></h2></li>
</ul>
</nav>
</header>

<article>
<div id="mainContents">
<section>
<h1>検索</h1>
<!-- <form name="searchForm" action="javascript:void(0)" onSubmit="document.sendForm.comment.focus()">-->
<form name="searchForm" action="search_anime.php">
<p>アニメ名：<input type="text" name="searchKey" autofocus>
<input type="submit" value="検索"></p>
</form>
</section>

<section>
<h1>登録</h1>
<form name="sendForm" action="added_my_anime.php">
<p>アニメ名：<span id="animeName"></span><input class="hideForm" name="animeName"></p>
<p>話数：<span id="animeNumber"></span><input class="hideForm" name="animeNumber"></p>
<p>コメント：<textarea id="comment" name="comment" rows="2" cols="70"></textarea></p>
<p><input type="submit" value="登録"> （ or Ctrl + Enter で登録）</p>
</form>
</section>

</div>
</article>

<footer>

</footer>

</body>
</html>
