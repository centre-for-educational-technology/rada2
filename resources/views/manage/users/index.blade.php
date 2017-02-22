@extends('layouts.app')

@section('footer-scripts')
<script>
    $(document).ready(function() {
        $('.mdi-close-circle-outline').on('click', function() {
            var confirmation = confirm('{{ trans("pages.manage.users.index.confirmations.role") }}');

            if ( confirmation ) {
                var _this = $(this),
                    user = _this.data('user-id'),
                    role = _this.data('role-id');

                $.ajax({
                    cache: false,
                    method: 'DELETE',
                    url: '{{ url("/api/manage/users") }}/' + user + '/roles/' + role,
                    success: function(data, textStatus, jqXHR) {
                        _this.parent().fadeOut('medium', function() {
                            $(this).remove();
                        });
                        $('#user-' + user).find('button').data('user-roles', data.roles);
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        _this.parent().addClass('animated shake');
                        setTimeout(function() {
                            _this.parent().removeClass('animated shake');
                        }, 1000);
                    }
                });
            }
        });

        $('#rolesModal').on('show.bs.modal', function(e) {
            var form = $(this).find('form'),
                button = $(e.relatedTarget),
                userId = button.data('user-id'),
                userName = button.data('user-name'),
                userRoles = button.data('user-roles');
                form.attr('action', form.data('action-base') + '/' + userId);
                $(this).find('h4.modal-title > strong').text(userName);
                if ( userRoles ) {
                    _.each(userRoles, function(role) {
                        form.find('input[type="checkbox"][name="roles[]"][value="' + role.id + '"]').prop('checked', true);
                        if ( role.zoo ) {
                            form.find('select[name="role_' + role.id + '_zoo"]').val(role.zoo);
                        }
                    });
                }

        });
        $('#rolesModal').on('hidden.bs.modal', function(e) {
            var form = $(this).find('form');

            form.trigger('reset');
            form.attr('action', '');
            $(this).find('h4.modal-title > strong').text('');
        });
    });
</script>
@endsection

@section('content')
<div class="container">
    <div class="modal fade" tabindex="-1" role="dialog" id="rolesModal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">
                        <strong></strong>:
                        {{ trans('pages.manage.users.index.modal.title') }}
                    </h4>
                </div>
                <div class="modal-body">
                    <form name="roles" action="" method="post" data-action-base="{{ url('/manage/users') }}">
                        <input type="hidden" name="page" value="{{ $users->currentPage() }}">
                        {{ csrf_field() }}
                        <div class="form-group">
                            @foreach($roles as $role)
                                <div class="row">
                                    <div class="col-xs-6">
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox" name="roles[]" value="{{ $role->id }}">
                                                {{ trans( 'general.roles.' . $role->name ) }}
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-xs-6">
                                        @if ( $role->name !== 'admin' )
                                        <select name="role_{{ $role->id }}_zoo">
                                            @foreach(Activity::getZooOptions() as $id => $title)
                                                <option value="{{ $id }}">{{ $title }}</option>
                                            @endforeach
                                        </select>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">{{ trans('general.forms.buttons.cancel') }}</button>
                    <button type="button" class="btn btn-primary" onclick="$(this).parent().parent().find('form').submit();">{{ trans('general.forms.buttons.save') }}</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-12">
                            {{ trans('pages.manage.users.index.heading') }}
                        </div>
                    </div>
                </div>

                <div class="panel-body">
                    @if ( count($users) === 0 )
                        <div class="well">{{ trans('pages.manage.users.index.none-found') }}</div>
                    @else
                        <table class="table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>{{ trans('auth.register.form.name') }}</th>
                                    <th class="hidden-xs">{{ trans('auth.general.email') }}</th>
                                    <th class="hidden-xs">{{ trans('general.date-time.created-at') }}</th>
                                    <th class="hidden-xs">{{ trans('general.date-time.updated-at') }}</th>
                                    <th class="hidden-xs">{{ trans('pages.manage.users.index.accounts') }}</th>
                                    <th>{{ trans('pages.manage.users.index.roles') }}</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($users as $user)
                                    <tr id="user-{{ $user->id }}">
                                        <td>{{ $user->name }}</td>
                                        <td class="hidden-xs">{{ $user->email }}</td>
                                        <td class="hidden-xs">{{ date(trans('general.date-time.formats.short'), strtotime($user->created_at)) }}</td>
                                        <td class="hidden-xs">{{ date(trans('general.date-time.formats.short'), strtotime($user->updated_at)) }}</td>
                                        <td class="sz-account-types hidden-xs">
                                            <i class="mdi mdi-account-key {{ $user->password ? ' active' : 'inactive' }}"></i>
                                            @if( $user->social_accounts )
                                                @foreach( $user->social_accounts as $social )
                                                    @if ( $social->isGoogle() )
                                                        <i class="mdi mdi-google"></i>
                                                    @elseif ( $social->isFacebook() )
                                                        <i class="mdi mdi-facebook-box"></i>
                                                    @endif
                                                @endforeach
                                            @endif
                                        </td>
                                        <td>
                                            @if ( $user->roles )
                                                @foreach ( $user->roles as $role)
                                                    <span class="badge sz-role-badge">
                                                        {{ trans('general.roles.' . $role->name) }}
                                                        @if ( $role->pivot->zoo )
                                                            ({{ $role->pivot->zoo ? App\Activity::getZoo($role->pivot->zoo) : '' }})
                                                        @endif
                                                        <i class="mdi mdi-close-circle-outline" data-role-id="{{ $role->id }}" data-user-id="{{ $user->id }}"></i>
                                                    </span>
                                                @endforeach
                                            @endif
                                        </td>
                                        <td>
                                            <button class="btn btn-primary btn-xs" data-toggle="modal" data-target="#rolesModal" data-user-id="{{ $user->id }}" data-user-name="{{ $user->name }}" data-user-roles="{{ json_encode( $user->getRolesData() ) }}">
                                                <i class="mdi mdi-plus"></i>
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                        <div class="text-center">
                            {{ $users->links() }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
