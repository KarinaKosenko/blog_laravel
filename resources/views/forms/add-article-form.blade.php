<form method="post">
	{{ csrf_field() }}
	
	Заголовок:<br>
	<input type="text" name="title" value="{{ $article->title or old('title') }}"><br>
	@if ($errors->has('title'))
		<div class="warning_message">
			<strong> {{ $errors->first('title') }} </strong>
		</div>
	@endif
	
	Содержание:<br>
	<textarea name="content">{{ $article->content or old('content') }}</textarea><br>
	@if ($errors->has('content'))
		<div class="warning_message">
			<strong> {{ $errors->first('content') }} </strong>
		</div>
	@endif
	
	<input type="submit" value="Сохранить">
</form>
<br>
<span>{{ $msg }}</span>