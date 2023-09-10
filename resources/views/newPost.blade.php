<!DOCTYPE html>
<html lang="ja">
<head>
	<!-- Bootstrap CSS -->
	<link rel="stylesheet"
		href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"
		integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z"
		crossorigin="anonymous">
	<link rel="stylesheet" href="{{ asset('/css/post.css')  }}" >
	<script src="{{ asset('/js/diaryapp.js') }}"></script>
	<title>新規投稿</title>
</head>
<body>
	<div class="container" style="margin-top:5rem">
		<div class="item">
			<a href="/diaryListDisplay" class="example">
				<svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="currentColor" class="bi bi-caret-left" viewBox="0 0 16 16" style="color:gray">
				<path d="M10 12.796V3.204L4.519 8 10 12.796zm-.659.753-5.48-4.796a1 1 0 0 1 0-1.506l5.48-4.796A1 1 0 0 1 11 3.204v9.592a1 1 0 0 1-1.659.753z"/>
				</svg>
			</a>
		</div>
	</div>
	<div class="container">
		<div class="col" style= "display:flex;margin-top: 2%;">
            <div>
				<svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16" style="margin-left:5%">
					<path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
					<path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
				</svg>
            </div>
            <h2 style= "margin-left: 1%;">新規投稿</h2>
		</div>
	</div>
	<br>
	<form action="{{ url('/newPost') }}" method="post" enctype="multipart/form-data" onSubmit="return check('登録')">
	@csrf
		<div class="container">
			<h4 style="display:inline; margin-right:3%">{{ $today['dispToday'] }}</h4>
			<input type="hidden" name="date" value="{{ $today['dataToday'] }}">
		</div>
		<br>
		<div class="container">
			<div style="width: 70%;margin-right: auto;">
				<div class="card" style="width:100%; border-radius:10px 10px 10px 10px">
					<div class="card-header">
					画像追加
					</div>
					<div class="card-body" style="width:100%">
						<blockquote class="blockquote mb-0">
							<svg xmlns="http://www.w3.org/2000/svg" width="40" height="35" fill="currentColor" class="bi bi-card-image" viewBox="0 0 16 16">
							<path d="M6.002 5.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0z"/>
							<path d="M1.5 2A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-13zm13 1a.5.5 0 0 1 .5.5v6l-3.775-1.947a.5.5 0 0 0-.577.093l-3.71 3.71-2.66-1.772a.5.5 0 0 0-.63.062L1.002 12v.54A.505.505 0 0 1 1 12.5v-9a.5.5 0 0 1 .5-.5h13z"/>
							</svg>
							<div style="display: inline-block">
								<input type="file" name="image" accept=".jpg,.png">
							</div>
							<footer class="blockquote-footer">今日のハイライトを一緒に記録しましょう</footer>
						</blockquote>
					</div>
				</div>
			</div>
		</div>
		<div class="container" style="margin-top:2%">
			<textarea name="content" id="contents" required="required" th:text="${contents}" maxlength='30000'cols="60"
			placeholder="今日はどんなことがありましたか？"
			style="width: 100%; height: 200px; border: 1px solid ;border-radius:10px 10px 10px 10px;border-color:grey;"></textarea>
		</div>
		<div class="container" style="margin-top:1%">
			<button type="submit"><img src="{{ asset('img/postIcon.png') }}" alt="ペン" width="30" height="30" style="margin-right: 10px;">記録する</button>
		</div>
	</form>
</body>
</html>