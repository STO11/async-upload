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
                            <h3 class="card-title">Upload Shiporders</h3>

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
                            <a class="btn btn-primary" href="{{ route('panel.upload-shiporders.create') }}">Adicionar</a>
                            <br /><br />
                            <div class="card-body table-responsive">
                                <table class="table table-head-fixed text-nowrap">
                                    <thead>
                                        <th>Order</th>
                                        <th>Person</th>
                                        <th>Itens</th>
                                        <th>Shipto</th>
                                        <th>Opções</th>
                                    </thead>

                                    <tbody>
                                        @if ($shiporders->count())
                                            @foreach ($shiporders as $shiporder)
                                                <tr>
                                                    <td>#{{ $shiporder->order_id }}</td>
                                                    <td>{{ $shiporder->person ? $shiporder->person->person_name : '' }}</td>
                                                    <td>
                                                        @if($shiporder->itens->count())
                                                            @foreach($shiporder->itens as $item)
                                                                Title : {{  $item->title }} <br />
                                                                Note:  {{  $item->note }} <br />
                                                                Quantity : {{  $item->quantity }} <br />
                                                                Price: {{  $item->price }} <br /> <br />
                                                                <hr />
                                                            @endforeach
                                                        @endif
                                                    </td>

                                                    <td>
                                                        @if($shiporder->shipto)
                                                            {{ $shiporder->shipto->name }} <br />
                                                            {{ $shiporder->shipto->address }} <br />
                                                            {{ $shiporder->shipto->city }} <br />
                                                            {{ $shiporder->shipto->country }} <br />
                                                        @endif

                                                    </td>

                                                    <td>
                                                        <a class="btn btn-danger" data-toggle="toggle" title="Delete"
                                                            href="{{ route('panel.upload-peoples.destroy', $shiporder->id) }}"><i
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
