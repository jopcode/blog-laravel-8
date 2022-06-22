@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="section-header">
            <h3 class="page__heading">Roles</h3>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            @can('create-rol')
                                <a href="{{ route('roles.create') }}" class="btn btn-warning">New</a>
                            @endcan

                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($roles as $rol)
                                        <tr>
                                            <th>{{ $rol->name }}</th>
                                            <th>
                                                @can('edit-rol')
                                                    <a href="{{ route('roles.edit', $rol->id) }}" class="btn btn-info">Edit</a>
                                                @endcan

                                                @can('delete-rol')
                                                    {!! Form::open(['url' => route('roles.destroy', $rol->id), 'method' => 'delete', 'style' => 'display:inline']) !!}
                                                        {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                                                    {!! Form::close() !!}
                                                @endcan
                                            </th>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="pagination justify-content-end">
                                {{ $roles->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

