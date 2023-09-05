<!doctype html>
<html lang="ja" xmlns:th="http://www.thymeleaf.org">
<head>
<meta charset="utf-8">
<meta name="viewport"
content="width=device-width, initial-scale=1, shrink-to-fit=no">

<!-- Bootstrap CSS -->
<link rel="stylesheet"
href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"
integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z"
crossorigin="anonymous">
<title>入力画面</title>
<style>
p {
margin: 0;
}

body {
background-color: antiquewhite;
}

.wrap {
display: inline-block;
margin-right: 10px;
}

.contents>.form-control {
display: inline;
height: 500px;
vertical-align: text-top;
}
</style>
</head>

<body>
	<style>
	.card-header:first-child {
	border-radius: 10px 10px 0 0;
	background-color: goldenrod;
	padding: 10px 10px 4px 20px;
	}
	.card-body {
	border-radius: 0 0 10px 10px;
	background-color: wheat;
	}
	.test-container {
		display: flex;
		justify-content: space-around;
	}
	</style>
	
	<div class="container" style="margin-top:5rem">
		<div class="item">
			<a href="/diaryListDisplay" class="example">
				<svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="currentColor" class="bi bi-caret-left" viewBox="0 0 16 16">
				<path d="M10 12.796V3.204L4.519 8 10 12.796zm-.659.753-5.48-4.796a1 1 0 0 1 0-1.506l5.48-4.796A1 1 0 0 1 11 3.204v9.592a1 1 0 0 1-1.659.753z"/>
				</svg>
			</a>
		</div>
	</div>
	<br>
	<div class="container">
		<h4 style="display:inline; margin-right:3%">9/4</h4><h5 style="display:inline;vertical-align: bottom;">2023</h5>
	</div>
	<br>
	<div class="container" style="width:50%">
		<div>
			<div class="card" style="width:50%">
				<div class="card-header">
				画像追加
				</div>
				<div class="card-body">
					<blockquote class="blockquote mb-0">
						<svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor" class="bi bi-card-image" viewBox="0 0 16 16">
						<path d="M6.002 5.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0z"/>
						<path d="M1.5 2A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-13zm13 1a.5.5 0 0 1 .5.5v6l-3.775-1.947a.5.5 0 0 0-.577.093l-3.71 3.71-2.66-1.772a.5.5 0 0 0-.63.062L1.002 12v.54A.505.505 0 0 1 1 12.5v-9a.5.5 0 0 1 .5-.5h13z"/>
						</svg>
						<div style="display: inline-block">
							<input type="file" name="image">
						</div>
						<footer class="blockquote-footer">今日のハイライトを一緒に記録しましょう</footer>
					</blockquote>
				</div>
			</div>
		</div>
	</div>
	<div class="container" style="margin-top:2%">
		<textarea name="contents" id="contents" th:text="${contents}" maxlength='30000'cols="60"
		placeholder="今日はどんなことがありましたか？"
		style="width: 100%; height: 200px; border: 1px solid ;border-radius:10px 10px 10px 10px;border-color:grey;"></textarea>
	</div>
</body>
</html>