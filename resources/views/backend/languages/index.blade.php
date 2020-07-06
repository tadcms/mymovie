@extends('layouts.backend')

@section('title', trans('app.language'))

@section('content')

    {{ Breadcrumbs::render('manager', [
            'name' => trans('app.language'),
            'url' => route('admin.languages')
        ]) }}

    <div class="cui__utils__content">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-6">
                        <h5 class="mb-0 card-title font-weight-bold">@lang('app.language')</h5>
                    </div>

                    <div class="col-md-6">
                        <div class="float-right">
                            <div class="btn-group">
                                <button type="button" class="btn btn-success sync-language"><i class="fa fa-refresh"></i> @lang('app.sync_language')</button>
                            </div>

                            <div class="btn-group">
                                <a href="javascript:void(0)" class="btn btn-success" data-toggle="modal" data-target="#addModal"><i class="fa fa-plus-circle"></i> @lang('app.add_new')</a>
                                <button type="button" class="btn btn-danger" id="delete-item"><i class="fa fa-trash"></i> @lang('app.delete')</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card-body">

                <div class="row mb-3">
                    <div class="col-md-12">
                        <form method="get" class="form-inline" id="form-search">

                            <div class="form-group mb-2 mr-1">
                                <label for="inputName" class="sr-only">@lang('app.search')</label>
                                <input name="search" type="text" id="inputName" class="form-control" placeholder="@lang('app.search')" autocomplete="off">
                            </div>

                            <div class="form-group mb-2 mr-1">
                                <label for="inputStatus" class="sr-only">@lang('app.status')</label>
                                <select name="status" id="inputStatus" class="form-control">
                                    <option value="1">@lang('app.enabled')</option>
                                    <option value="0">@lang('app.disabled')</option>
                                </select>
                            </div>

                            <button type="submit" class="btn btn-primary mb-2"><i class="fa fa-search"></i> @lang('app.search')</button>
                        </form>
                    </div>

                </div>

                <div class="table-responsive mb-5">
                    <table class="table load-bootstrap-table">
                        <thead>
                            <tr>
                                <th data-width="3%" data-field="state" data-checkbox="true"></th>
                                <th data-field="key">@lang('app.code')</th>
                                <th data-field="name">@lang('app.name')</th>
                                <th data-width="15%" data-field="created">@lang('app.created_at')</th>
                                <th data-width="15%" data-field="status" data-align="center" data-formatter="status_formatter">@lang('app.status')</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="addModal" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form action="{{ route('admin.languages.save') }}" method="post" class="form-ajax">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addModalLabel">@lang('app.add_language')</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label class="col-form-label" for="name">@lang('app.name')</label>

                            <input type="text" name="name" class="form-control" id="name" value="" autocomplete="off" required placeholder="Ex: English, French">
                        </div>

                        <div class="form-group">
                            <label class="col-form-label" for="key">@lang('app.code')</label>

                            <input type="text" name="key" class="form-control" id="key" autocomplete="off" required placeholder="Ex: en, fe">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> @lang('app.save')</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-close"></i> @lang('app.close')</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script type="text/javascript">

        function status_formatter(value, row, index) {
            if (value == 1) {
                return '<span class="text-success">@lang('app.enabled')</span>';
            }
            return '<span class="text-danger">@lang('app.disabled')</span>';
        }

        var table = new LoadBootstrapTable({
            url: '{{ route('admin.languages.getdata') }}',
            remove_url: '{{ route('admin.languages.remove') }}',
        });

        $('.sync-language').on('click', function () {

            let btn = $(this);
            let cIcon = btn.find('i').attr('class');
            btn.find('i').attr('class', 'fa fa-spinner fa-spin');
            btn.prop("disabled", true);

            $.ajax({
                type: 'POST',
                url: '{{ route('admin.languages.sync') }}',
                dataType: 'json',
                data: {}
            }).done(function(data) {

                show_message(data.message, data.status);
                btn.find('i').attr('class', cIcon);
                btn.prop("disabled", false);

                return false;
            }).fail(function(data) {
                show_message(langs.data_error, 'error');
                btn.find('i').attr('class', cIcon);
                btn.prop("disabled", false);
                return false;
            });
        });

    </script>
@endsection