@extends('layout.layout')
@section('title', 'Upload Peoples')
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
                            {!! Form::model(null, ['route' => 'panel.upload-peoples.store', 'files' => true]) !!}
                            <div class="form-group">
                                <label for="nome">Arquivos *</label>
                                {!! Form::file('file', ['class' => 'form-control', 'required']) !!}
                                <sup style="color:red">* Apenas formato XML</sup> 
                            </div>
                            <button type="submit" class="btn btn-primary">Processar</button>
                            {!! Form::close() !!}
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
