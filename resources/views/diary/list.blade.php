<!DOCTYPE html>
<html lang="ja">
<head>
	<!-- Bootstrap CSS -->
	<link rel="stylesheet"
		href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"
		integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z"
		crossorigin="anonymous">
	<link rel="stylesheet" href="{{ asset('/css/list.css')  }}" >
	<script src="{{ asset('/js/diaryapp.js') }}"></script>
	<title>一覧</title>
</head>
<body>
	<input id="diarysCnt" type="hidden" value= {{ $diarysCnt }} ></input>
	<br>
	<div class="container">
		<div class="col" style= "display:flex; margin-bottom: 5%;margin-top: 5%;">
            <div>
                <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor" class="bi bi-book" viewBox="0 0 16 16">
                <path d="M1 2.828c.885-.37 2.154-.769 3.388-.893 1.33-.134 2.458.063 3.112.752v9.746c-.935-.53-2.12-.603-3.213-.493-1.18.12-2.37.461-3.287.811V2.828zm7.5-.141c.654-.689 1.782-.886 3.112-.752 1.234.124 2.503.523 3.388.893v9.923c-.918-.35-2.107-.692-3.287-.81-1.094-.111-2.278-.039-3.213.492V2.687zM8 1.783C7.015.936 5.587.81 4.287.94c-1.514.153-3.042.672-3.994 1.105A.5.5 0 0 0 0 2.5v11a.5.5 0 0 0 .707.455c.882-.4 2.303-.881 3.68-1.02 1.409-.142 2.59.087 3.223.877a.5.5 0 0 0 .78 0c.633-.79 1.814-1.019 3.222-.877 1.378.139 2.8.62 3.681 1.02A.5.5 0 0 0 16 13.5v-11a.5.5 0 0 0-.293-.455c-.952-.433-2.48-.952-3.994-1.105C10.413.809 8.985.936 8 1.783z"/>
                </svg>
            </div>
            <h2 style= "margin-left: 1%;">日記一覧</h2>
			<a href="/diary/newPost" id="toNewPost" style="margin-left: auto;">
				<svg xmlns="http://www.w3.org/2000/svg" width="80" height="80" fill="currentColor" class="bi bi-plus-circle-fill" viewBox="0 0 16 16" style="color: orange;">
				<path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8.5 4.5a.5.5 0 0 0-1 0v3h-3a.5.5 0 0 0 0 1h3v3a.5.5 0 0 0 1 0v-3h3a.5.5 0 0 0 0-1h-3v-3z"/>
				</svg>
			</a>
			<a href="/diary/trash" id="toTrash" style="margin-left: 2%;">
				<img src="{{ asset('img/trash.png') }}" alt="ゴミ箱" width="83" height="83">
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
			<a href="/diary/newPost" >
				<svg xmlns="http://www.w3.org/2000/svg" width="100" height="100" fill="currentColor" class="bi bi-plus-circle-fill" viewBox="0 0 16 16" style="color: orange;">
				<path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8.5 4.5a.5.5 0 0 0-1 0v3h-3a.5.5 0 0 0 0 1h3v3a.5.5 0 0 0 1 0v-3h3a.5.5 0 0 0 0-1h-3v-3z"/>
				</svg>
			</a>
			<a href="/diary/trash" id="toTrash" style="margin-left: 2%;">
				<img src="{{ asset('img/trash.png') }}" alt="ゴミ箱" width="100" height="100">
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
				<h4 style="display:inline; margin-right:3%;vertical-align: bottom;">{{  date('m/d', strtotime($diaryData->date)) }}</h4>
					<h5 style="display:inline;vertical-align: bottom;">{{ date('Y', strtotime($diaryData->date)) }}</h5>
					<form action="{{ route('diary.edit', ['id'=>$diaryData->id]) }}" method="GET" style="display: inline;">
						@csrf
						<button type="submit" style="display: contents;">
							<svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16" style="margin-left:5%">
								<path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
								<path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
							</svg>
						</button>
					</form>
					<form action="{{ route('diary.delete', ['id'=>$diaryData->id]) }}" method="GET" style="display: inline;" onSubmit="return check('削除')">
						@csrf
						<button type="submit" style="display: contents;">
							<svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16" style="margin-left:2%">
								<path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
								<path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
							</svg>
						</button>
					</form>
				</div>
				<div class="container">
					@if (!is_null($diaryData->img_path))
						<br>
						<img src="{{ asset($diaryData->img_path) }}" alt="test" width="400" height="300" style="margin-left: 3%;">
					@endif
					<br>
					<p style="margin-left: 3%;">{{ $diaryData->content }}</p>
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
		document.getElementById("toNewPost").style.display = "none";
		document.getElementById("toTrash").style.display = "none";
	};
</script>
</html>
