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
	<title>削除一覧</title>
</head>
<body>
	<input id="diarysCnt" type="hidden" value= {{ $diarysCnt }} ></input>
	<div class="container" style="margin-top:5rem">
		<div class="item">
			<a href="/diary/list" class="example">
				<svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="currentColor" class="bi bi-caret-left" viewBox="0 0 16 16" style="color:gray">
				<path d="M10 12.796V3.204L4.519 8 10 12.796zm-.659.753-5.48-4.796a1 1 0 0 1 0-1.506l5.48-4.796A1 1 0 0 1 11 3.204v9.592a1 1 0 0 1-1.659.753z"/>
				</svg>
			</a>
		</div>
	</div>
	<br>
	<div class="container">
		<div class="col" style= "display:flex;margin-top: 2%;">
            <div>
				<svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16" style="margin-left:2%">
					<path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
					<path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
				</svg>
            </div>
            <h2 style= "margin-left: 1%;">削除日記一覧</h2>
		</div>
	</div>

	<!-- 日記未存在表示 -->
	<div id="noTrash">
		<br>
		<div style="text-align: center;">
			<h4 style="margin-top: 2rem;">削除した日記はありません</h4>
		</div>
	</div>
	{{ $data->links('pagination::default') }}
	<!-- 日記表示 -->
	<div class="container">
		<div id="trash">
				<hr class="style17">
			@foreach($data as $diaryData)
				<br>
				<div class="container">
				<h4 style="display:inline; margin-right:3%;vertical-align: bottom;">{{  date('m/d', strtotime($diaryData->date)) }}</h4>
					<h5 style="display:inline;vertical-align: bottom;">{{ date('Y', strtotime($diaryData->date)) }}</h5>
					<form action="{{ route('trash.restoration', ['id'=>$diaryData->id]) }}" method="GET" style="display: inline;" onSubmit="return check('日記を復元')">
						@csrf
						<button type="submit" style="display: contents;">
							<svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-arrow-clockwise" viewBox="0 0 16 16" style="margin-left:5%">
								<path fill-rule="evenodd" d="M8 3a5 5 0 1 0 4.546 2.914.5.5 0 0 1 .908-.417A6 6 0 1 1 8 2v1z"/>
								<path d="M8 4.466V.534a.25.25 0 0 1 .41-.192l2.36 1.966c.12.1.12.284 0 .384L8.41 4.658A.25.25 0 0 1 8 4.466z"/>
							</svg>
						</button>
					</form>
					<form action="{{ route('trash.destroy', ['id'=>$diaryData->id]) }}" method="GET" style="display: inline;" onSubmit="return check('完全に削除')">
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
		document.getElementById("noTrash").style.display = "none";
		document.getElementById("trash").style.display = "block";
	}else{
		document.getElementById("noTrash").style.display = "block";
		document.getElementById("trash").style.display = "none";
	};
</script>
</html>
