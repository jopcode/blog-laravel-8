@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="section-header">
            <h3 class="page__heading">Articles</h3>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            @can('create-article')
                                <a href="{{ route('articles.create') }}" class="btn btn-warning">New</a>
                            @endcan

                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Title</th>
                                        <th>Category</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($articles as $article)
                                        <tr>
                                        <th>{{ $article->title }}</th>
                                            <th>{{ $article->category->name }}</th>
                                            <th>
                                                @can('edit-article')
                                                    <a href="{{ route('articles.edit', $article->id) }}" class="btn btn-info">Edit</a>
                                                @endcan

                                                @can('delete-article')
                                                    {!! Form::open(['url' => route('articles.destroy', $article->id), 'method' => 'delete', 'style' => 'display:inline']) !!}
                                                        {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                                                    {!! Form::close() !!}
                                                @endcan
                                            </th>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="pagination justify-content-end">
                                {{ $articles->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

