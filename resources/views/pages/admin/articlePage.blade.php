@section('main_column')
	<div class="post_box">
		<h2>{{ $article->title }}</h2>
		
		<div class="post_info">

            <div class="post_date">
                {{ substrDate($article->created_at) }}
          </div>

            <div class="post_author">
                <span>{{ $article->user->name }}</span>
            </div>

            <div class="post_comment">
                <span>{{ $article->comments->where('text', '<>', 'Комментарий удален.')->count() }} comments</span>
            </div>

            <div class="cleaner"></div>
        </div>
		
		<div class="post_body">
            @isset($article->upload)
                <img class="image" src="{{ getImagePath($article->upload->path . '.' . $article->upload->ext) }}" alt="image"><br>
			@endisset
            {!! $article->content !!}
		</div>

        @can('to_edit_article', $article)
            <a href="{{ route('admin.articles.edit', ['article_id' => $article->id]) }}">Редактировать</a><br>
        @endcan

        @can('to_delete_article', $article)
		    <a href="{{ route('admin.articles.delete', ['article_id' => $article->id]) }}">Удалить</a>
        @endcan
	</div>

	{!! $comments !!}
		
@endsection