@extends('layouts.base')

@section('title', 'Project')

@section('header_title', 'Project')

@section('content')
<div class="row">
    <!-- Error Area -->
    @if (session()->has('error'))
    <div class="col-12">
        <div class="alert alert-danger">
            <p class="m-0">{{ session()->get('error') }}</p>
        </div>
    </div>
    @endif
    <!-- End Error Area -->

    <!-- Form -->
    <div class="col-12">
        <div class="card collapsed-card" id="card_project">
            <div class="card-header">
                <h3 class="card-title">Form Project</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                        <i class="fas fa-plus"></i>
                    </button>
                </div>
            </div>
            <div class="card-body" style="display: none">
                <form id="form_project" method="POST">
                    @csrf
                    <input type="hidden" name="id">
                    <input type="hidden" name="_method" value="POST">
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="title">Title Project</label>
                                <input type="text" class="form-control form-control-sm" name="title" id="title"
                                    required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="start_periode">Start Date</label>
                                <input type="date" class="form-control form-control-sm" name="start_periode"
                                    id="start_periode" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="end_periode">End Date</label>
                                <input type="date" class="form-control form-control-sm" name="end_periode"
                                    id="end_periode" required>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label for="summary">Summary Project</label>
                                <textarea type="text" class="form-control form-control-sm" name="summary" id="summary"
                                    rows="4" required></textarea>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label for="link">Link Project</label>
                                <input type="text" class="form-control form-control-sm" name="link" id="link" required>
                            </div>
                        </div>
                        <div class="col-12 text-right">
                            <button type="submit" class="btn btn-primary">
                                <i class="fa fa-save"></i> Save Project
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
    <!-- End Form -->

    <!-- Table -->
    <div class="col-12 table-responsive">
        <table class="table w-100 table-striped" id="table_project">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Title</th>
                    <th>Start Periode</th>
                    <th>End Periode</th>
                    <th>Link</th>
                    <th>Image</th>
                    <th>Stack</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($projects as $key => $item)
                <tr>
                    <td>{{ $key+1 }}</td>
                    <td>{{ $item->title }}</td>
                    <td>{{ $item->start_periode }}</td>
                    <td>{{ $item->end_periode }}</td>
                    <td>
                        <a href="{{ $item->link }}" target="_blank">Link Project</a>
                    </td>
                    <td>
                        <a href="{{ url('') }}" class="btn btn-sm btn-info text-white">Image</a>
                    </td>
                    <td>
                        <a href="{{ route('admin.project_stack.index', ['id' => $item->id]) }}"
                            class="btn btn-sm btn-warning text-white">Stack</a>
                    </td>
                    <td class="d-flex flex-row flex-wrap align-items-center justfiy-content-center">
                        <button type="button" class="btn btn-sm btn-secondary btn-edit" data-id="{{ $item->id }}"
                            data-title="{{ $item->title }}" data-start_periode="{{ $item->start_periode }}"
                            data-summary="{{ $item->summary }}" data-end_periode="{{ $item->end_periode }}"
                            data-link="{{ $item->link }}">
                            <i class="fa fa-edit"></i>
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
                    <td colspan="6" class="text-center">Projects not found, let's create your first project.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
        {{ $projects->links() }}
    </div>
    <!-- End Table -->
</div>
@endsection

@section('js')
<script>
    $(document).ready(function(){
        $('#form_project').on('submit', function(e){
            e.preventDefault();

            try {
                const post = () => {
                    const formData = new FormData($('#form_project')[0]);
                    const method = $('#form_project input[name="_method"]').val();
                    const url = method == 'POST' ? "{{ route('admin.project.store') }}" : "{{ route('admin.project.update') }}"
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
                    title : 'Save Project',
                    html: "do you want to save this project ?",
                    confirmButtonText: "Yes, save it!",
                });
            } catch (error) {
                show_error({
                    html : error
                })
            }
        })

        $('#table_project button.btn-edit').on('click', function(){
            const data = $(this).data();

            //fill form
            $('#form_project input[name=_method]').val("PUT");
            $('#form_project input[name=id]').val(data.id);
            $('#form_project input[name=title]').val(data.title);
            $('#form_project input[name=start_periode]').val(data.start_periode);
            $('#form_project input[name=end_periode]').val(data.end_periode);
            $('#form_project textarea[name=summary]').val(data.summary);
            $('#form_project input[name=link]').val(data.link);

            //open form
            $('#card_project').removeClass('collapsed-card');
            $('#card_project .card-body').show();
            $('#card_project .btn-tool>i').removeClass('fa-plus').addClass('fa-minus');

            //show cancel button
            $('#card_project .btn-cancel').removeClass('d-none');
        })

        $('#card_project .btn-cancel').on('click', function(){
            $('#form_project input[name=id]').val("");
            $('#form_project input[name=_methode]').val("POST");
            $('#form_project input[name=id]').val("");
            $('#form_project input[name=title]').val("");
            $('#form_project input[name=start_periode]').val("");
            $('#form_project input[name=end_periode]').val("");
            $('#form_project textarea[name=summary]').val("");
            $('#form_project input[name=link]').val("");

            $('#card_project .btn-cancel').addClass('d-none');

            //close form
            $('#card_project').addClass('collapsed-card');
            $('#card_project .card-body').hide();
            $('#card_project .btn-tool>i').removeClass('fa-minus').addClass('fa-plus');
        })

        $('#table_project button.btn-delete').on('click', function(){
            const data = $(this).data();

            try {
                const post = () => {
                    const method = "DELETE";
                    const url = "{{ route('admin.project.destroy') }}"
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
                    title : 'Delete Project',
                    html: "do you want to delete this project ?",
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
