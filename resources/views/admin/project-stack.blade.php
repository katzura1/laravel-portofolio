@extends('layouts.base')

@section('title', 'Project Stack')

@section('header_title', 'Project Stack')

@section('content')
<div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    {{ $project->title }}
                </h3>
            </div>
            <div class="card-body">
                <ul>
                    <li><b>Periode</b> : {{ date('F Y', strtotime($project->start_periode)). ' - '.date('F Y',
                        strtotime($project->end_periode))
                        }}</li>
                    <li><b>Summary</b> : <br />{{ $project->summary }}</li>
                    <li><b>Link</b> : <a href="{{ $project->link }}" target="_blank">Project Link</a></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card collapsed-card" id="card_project">
            <div class="card-header">
                <h3 class="card-title">Form Project Stack</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                        <i class="fas fa-plus"></i>
                    </button>
                </div>
            </div>
            <div class="card-body" style="display: none">
                <form id="form_project_stack" method="POST">
                    @csrf
                    <input type="hidden" name="id">
                    <input type="hidden" name="_method" value="POST">
                    <input type="hidden" name="id_project" value="{{ $project->id }}">
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="id_stack">Stack</label>
                                <select name="id_stack" id="id_stack" class="form-control form-control-sm" required>
                                    <option value="" selected disabled>Select Stack</option>
                                    @foreach ($stacks as $item)
                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-12 text-right">
                            <button type="submit" class="btn btn-primary">
                                <i class="fa fa-save"></i> Save Project Stack
                            </button>

                            <button type="button" class="btn btn-danger btn-cancel d-none">
                                <i class="fa fa-times"></i> Cancel
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="col-md-6 table-responsive">
        <table class="table w-100 table-striped" id="table_project_stack">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Name</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($projectStacks as $key => $item)
                <tr>
                    <td>{{ $key+1 }}</td>
                    <td>{{ $item->stack->name }}</td>
                    <td class="d-flex flex-row flex-wrap align-items-center justfiy-content-center">
                        <button type="button" class="btn btn-sm btn-secondary btn-edit" data-id="{{ $item->id }}"
                            data-id_stack="{{ $item->id_stack }}" <i class="fa fa-edit"></i>
                            Edit
                        </button>
                        <button type="button" class="btn btn-sm btn-danger btn-delete ml-2" data-id="{{ $item->id }}">
                            <i class="fa fa-trash"></i>
                            Delete
                        </button>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center">Project Stacks not found, let's create your first project.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
        {{ $projectStacks->links() }}
    </div>
</div>
@endsection

@section('js')
<script>
    $(document).ready(function(){
        $('#form_project_stack').on('submit', function(e){
            e.preventDefault();

            try {
                const post = () => {
                    const formData = new FormData($('#form_project_stack')[0]);
                    const method = $('#form_project_stack input[name="_method"]').val();
                    const url = method == 'POST' ? "{{ route('admin.project_stack.store') }}" : "{{ route('admin.project_stack.update') }}"
                    ajax_post({
                        url: url,
                        data: formData,
                        contentType: false,
                        processData: false,
                        success: function (result) {
                            Swal.close();
                            if (result.code == 200) {
                            show_success({
                                html: result.message ?? "Data save succesfully.",
                                didClose: () => {
                                    location.reload();
                                },
                            });
                            } else {
                            show_error({
                                html: result.message ?? "Data failed saved..",
                            });
                            }
                        },
                    });
                };

                prompt_swal(post, {
                    title : 'Save Project Stack',
                    html: "do you want to save this project stack ?",
                    confirmButtonText: "Yes, save it!",
                });
            } catch (error) {
                show_error({
                    html : error
                })
            }
        })

        $('#table_project_stack button.btn-edit').on('click', function(){
            const data = $(this).data();

            //fill form
            $('#form_project_stack input[name=_method]').val("PUT");
            $('#form_project_stack input[name=id]').val(data.id);
            $('#form_project_stack select[name=id_stack]').val(data.id_stack);

            //open form
            $('#card_project').removeClass('collapsed-card');
            $('#card_project .card-body').show();
            $('#card_project .btn-tool>i').removeClass('fa-plus').addClass('fa-minus');

            //show cancel button
            $('#card_project .btn-cancel').removeClass('d-none');
        })

        $('#card_project .btn-cancel').on('click', function(){
            $('#form_project_stack input[name=id]').val("");
            $('#form_project_stack input[name=_methode]').val("POST");
            $('#form_project_stack input[name=id]').val("");
            $('#form_project_stack select[name=id_stack]').val("");

            $('#card_project .btn-cancel').addClass('d-none');

            //close form
            $('#card_project').addClass('collapsed-card');
            $('#card_project .card-body').hide();
            $('#card_project .btn-tool>i').removeClass('fa-minus').addClass('fa-plus');
        })

        $('#table_project_stack button.btn-delete').on('click', function(){
            const data = $(this).data();

            try {
                const post = () => {
                    const method = "DELETE";
                    const url = "{{ route('admin.project_stack.destroy') }}"
                    ajax_post({
                        url: url,
                        data: {
                            id : data.id,
                            _method : method,
                        },
                        success: function (result) {
                            Swal.close();
                            if (result.code == 200) {
                            show_success({
                                html: result.message ?? "Data delete succesfully.",
                                didClose: () => {
                                    location.reload();
                                },
                            });
                            } else {
                            show_error({
                                html: result.message ?? "Data failed deleted..",
                            });
                            }
                        },
                    });
                };

                prompt_swal(post, {
                    title : 'Delete Project Stack',
                    html: "do you want to delete this project stack ?",
                    confirmButtonText: "Yes, delete it!",
                });
            } catch (error) {
                show_error({
                    html : error
                })
            }
        })
    })
</script>
@endsection
