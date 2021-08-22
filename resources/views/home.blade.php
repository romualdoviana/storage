@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="row">
                <div class="row">
                    <div class="col-2">
                        <button class="button" style="margin-block: 10px" data-toggle="modal" data-target="#uploadModal">
                            Novo Arquivo
                        </button>
                    </div>
                </div>
            </div>

            <div class="row">
                <div id="divTableNotasEmitidas" class="col col-12">
                    <table id="tableFiles" class="table table-striped table-hover dt-responsive" cellspacing="0"
                        width="100%">
                        <thead>
                            <tr>
                                <th>Nome</th>
                                <th class="text-right">Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($files as $f =>$key)
                            <tr>
                                <td>{{$key}}</td>
                                <td class="text-right">
                                    <a href="{{route('files.download',  $f)}}" class="fa fa-file-o btn btn-default" data-placement="top" data-toggle="tooltip"  title="Download do Arquivo"></a>
                                    <a href="{{route('files.delete',  $f)}}" class="fa fa-trash btn btn-default" data-placement="top" data-toggle="tooltip" title="Excluir Arquivo"></a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div id="uploadModal" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Upload do Arquivo</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                </div>
                <div class="modal-body">
                    <!-- Form -->
                    <form method='post' enctype="multipart/form-data">
                        <input type='file' name='file' id='file' class='form-control'><br>
                        <input type='button' class='btn btn-info' value='Salvar' id='btn_upload'>
                    </form>

                    <!-- Preview-->
                    <div id='preview'></div>
                </div>

            </div>

        </div>
    </div>
@endsection
@section('javascript')
    <script type="text/javascript">

        $(document).ready(function() {

            $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
            }
        });

            $('#tableFiles').dataTable({
                "order": false,
                autoWidth: false,
                responsive: true,
                "bInfo": false,
                "oLanguage": {
                    "sProcessing": "Aguarde enquanto os dados são carregados ...",
                    "sLengthMenu": "Mostrar _MENU_ registros por pagina",
                    "sZeroRecords": "Nenhum registro correspondente ao criterio encontrado",
                    "sInfoEmtpy": "Exibindo 0 a 0 de 0 registros",
                    "sInfo": "Exibindo de _START_ a _END_ de _TOTAL_ registros",
                    "sInfoFiltered": "",
                    "sSearch": "Procurar ",
                    "oPaginate": {
                        "sFirst": "Primeiro",
                        "sPrevious": "Anterior",
                        "sNext": "Próximo",
                        "sLast": "Último"
                    }
                }
            });


            $('#btn_upload').click(function() {
                filess = document.getElementById('file');
                var fd = new FormData();
                var files = filess.files[0];
                fd.append("nome", filess.name);
                fd.append('file', files);

                // AJAX request
                $.ajax({
                    url: "{{ route('file.post') }}",
                    "method": "POST",
                    contentType: false,
                    enctype: 'multipart/form-data',
                    processData: false,
                    data: fd,
                    success: function(response) {
                        console.log(response);
                        location.reload();
                    }
                });
            });
        });
    </script>
@endsection
