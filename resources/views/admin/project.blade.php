@extends('layouts.base')

@section('title', 'Project')

@section('header_title', 'Project')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card collapsed-card">
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
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="col-12 table-responsive">
        <table class="table w-100 table-striped">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Title</th>
                    <th>Start Periode</th>
                    <th>End Periode</th>
                    <th>Link</th>
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
                    <td>{{ $item->link }}</td>
                    <td></td>
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
    })
</script>
@endsection
