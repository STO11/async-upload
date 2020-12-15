@extends('layout.layout')
@section('content')
    <br />
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <!-- Default box -->
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Upload Peoples</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip"
                                    title="Collapse">
                                    <i class="fas fa-minus"></i></button>
                                <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip"
                                    title="Remove">
                                    <i class="fas fa-times"></i></button>
                            </div>
                        </div>
                        <div class="card-body">
                            @include('includes.alert')
                            <a class="btn btn-primary"
                                href="{{ route('panel.upload-peoples.create') }}">Adicionar</a>
                            <br /><br />
                            <div class="card-body table-responsive">
                                <table class="table table-head-fixed text-nowrap">
                                    <thead>
                                        <th>Nome</th>
                                        <th>Phones</th>
                                        <th>Options</th>
                                    </thead>
                                    <tbody>
                                        @if ($peoples->count())
                                            @foreach ($peoples as $people)
                                                <tr>
                                                    <td>{{ $people->person_name }}</td>
                                                    <td>
                                                        @if($people->phones->count())
                                                            @foreach($people->phones as $phone)
                                                            {{ $phone->phone }} <br />
                                                            @endforeach
                                                        @endif 
                                                    </td>
                                                    <td>
                                                        <a class="btn btn-danger" data-toggle="toggle" title="Delete"
                                                            href="{{ route('panel.upload-peoples.destroy', $people->id) }}"><i
                                                                class="fa fa-window-close"></i></a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @endif
                                    </tbody>
                                </table>
                            </div>

                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            <!-- Footer -->
                        </div>
                        <!-- /.card-footer-->
                    </div>
                    <!-- /.card -->
                </div>
            </div>
        </div>
    </section>

@endsection
