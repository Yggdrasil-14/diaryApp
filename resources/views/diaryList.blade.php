<!DOCTYPE html>
<html lang="ja">
<head>
<!-- Bootstrap CSS -->
<link rel="stylesheet"
	href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"
	integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z"
	crossorigin="anonymous">
<title>日記一覧</title>
</head>
<style>
body {
	background-color: antiquewhite;
}
p {
	font-size: larger
}
hr.style14 {
	border: 0;
	height: 1px;
	background-image: -webkit-linear-gradient(left, #f0f0f0, #8c8b8b, #f0f0f0);
	background-image: -moz-linear-gradient(left, #f0f0f0, #8c8b8b, #f0f0f0);
	background-image: -ms-linear-gradient(left, #f0f0f0, #8c8b8b, #f0f0f0);
	background-image: -o-linear-gradient(left, #f0f0f0, #8c8b8b, #f0f0f0);
}
hr.style17 {
	border-top: 1px solid #8c8b8b;
	text-align: center;
}
hr.style17:after {
	content: '§';
	display: inline-block;
	position: relative;
	top: -14px;
	padding: 0 10px;
	background: antiquewhite;
	color: #8c8b8b;
	font-size: 18px;
	-webkit-transform: rotate(60deg);
	-moz-transform: rotate(60deg);
	transform: rotate(60deg);
}
.paginationWrap {
    display: flex;
    justify-content: center;
    margin-top: 38px;
    margin-bottom: 40px;
}

.paginationWrap ul.pagination {
    display: inline-block;
    padding: 0;
    margin: 0;
}

.paginationWrap ul.pagination li {
  display: inline;
  margin-right: 4px;
}

.paginationWrap ul.pagination li a {
    color: #2f3859;
    padding: 8px 14px;
    text-decoration: none;
}

.paginationWrap ul.pagination li a.active {
    background-color: #f2a349;
    color: white;
    border-radius: 40px;
    width: 38px;
    height: 38px;
}

.paginationWrap ul.pagination li a:hover:not(.active) {
    background-color: #edae66;
    border-radius: 40px;
}
</style>
<body>
	<input id="diarysCnt" type="hidden" value= {{ $diarysCnt }} ></input>
	<header data-role="header"></header>
	<br>
	<div class="container">
		<div class="col" style= "display:flex; margin-bottom: 5%;margin-top: 5%;">
            <div>
                <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor" class="bi bi-book" viewBox="0 0 16 16">
                <path d="M1 2.828c.885-.37 2.154-.769 3.388-.893 1.33-.134 2.458.063 3.112.752v9.746c-.935-.53-2.12-.603-3.213-.493-1.18.12-2.37.461-3.287.811V2.828zm7.5-.141c.654-.689 1.782-.886 3.112-.752 1.234.124 2.503.523 3.388.893v9.923c-.918-.35-2.107-.692-3.287-.81-1.094-.111-2.278-.039-3.213.492V2.687zM8 1.783C7.015.936 5.587.81 4.287.94c-1.514.153-3.042.672-3.994 1.105A.5.5 0 0 0 0 2.5v11a.5.5 0 0 0 .707.455c.882-.4 2.303-.881 3.68-1.02 1.409-.142 2.59.087 3.223.877a.5.5 0 0 0 .78 0c.633-.79 1.814-1.019 3.222-.877 1.378.139 2.8.62 3.681 1.02A.5.5 0 0 0 16 13.5v-11a.5.5 0 0 0-.293-.455c-.952-.433-2.48-.952-3.994-1.105C10.413.809 8.985.936 8 1.783z"/>
                </svg>
            </div>
            <h2 style= "margin:0 vertical-align: middle;">日記一覧</h2>
			<a href="/newPostDisplay" id="toNewPostDisplay" class="example" style="margin-left: auto;">
				<svg xmlns="http://www.w3.org/2000/svg" width="80" height="80" fill="currentColor" class="bi bi-plus-circle-fill" viewBox="0 0 16 16" style="color: grey;">
				<path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8.5 4.5a.5.5 0 0 0-1 0v3h-3a.5.5 0 0 0 0 1h3v3a.5.5 0 0 0 1 0v-3h3a.5.5 0 0 0 0-1h-3v-3z"/>
				</svg>
			</a>
		</div>
	</div>

	<!-- 日記未存在表示 -->
	<div id="noDiary">
		<br>
		<img src="{{ asset('img/noDiary.png') }}" alt="日記がありません" width="500" height="500" style="margin: auto;display: block;">
		<div style="text-align: center;">
			<h4>日記が存在しません</h4>
			<p>＋を押して日記を作成しましょう</p><br>
			<a href="/newPostDisplay" class="example">
				<svg xmlns="http://www.w3.org/2000/svg" width="100" height="100" fill="currentColor" class="bi bi-plus-circle-fill" viewBox="0 0 16 16" style="color: grey;">
				<path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8.5 4.5a.5.5 0 0 0-1 0v3h-3a.5.5 0 0 0 0 1h3v3a.5.5 0 0 0 1 0v-3h3a.5.5 0 0 0 0-1h-3v-3z"/>
				</svg>
			</a>
		</div>
	</div>
	{{ $data->links('pagination::default') }}
	<!-- 日記表示 -->
	<div class="container">
		<div id="diarys">
				<hr class="style17">
			@foreach($data as $diaryData)
				<br>
				<div class="container">
					<h4 style="display:inline; margin-right:3%">{{ substr($diaryData->date,5,5) }}</h4><h5 style="display:inline;vertical-align: bottom;">{{ substr($diaryData->date,0,4) }}</h5>
				</div>
				<div class="container">
					@if (!is_null($diaryData->img_path))
						<img src="{{ asset($diaryData->img_path) }}" alt="test" width="400" height="300">
					@endif
					<p>{{ $diaryData->content }}</p>
				</div><br>
				<hr class="style17">
			@endforeach
		</div>
	</div>
</body>
<script>
	if(document.getElementById("diarysCnt").value >= 1){
		document.getElementById("noDiary").style.display = "none";
		document.getElementById("diarys").style.display = "block";
	}else{
		document.getElementById("noDiary").style.display = "block";
		document.getElementById("diarys").style.display = "none";
		document.getElementById("toNewPostDisplay").style.display = "none";
	};
</script>
</html>
