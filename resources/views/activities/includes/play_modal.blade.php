<div class="modal fade" tabindex="-1" role="dialog" id="play-modal">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"></h4>
            </div>
            <div class="modal-body text-center">
                {{ trans('general.confirmations.play') }}
                <div class="form-group">
                    <input id="nickname" type="text" class="form-control" placeholder="{{ trans('general.forms.placeholders.enter-your-name') }}" />
                </div>
            </div>
            <div class="modal-footer text-center">
                <button type="button" class="btn btn-default" title="{{ trans('general.buttons.cancel') }}" data-dismiss="modal">
                    <i class="mdi mdi-close"></i>
                </button>
                <button type="button" class="btn btn-success btn-play" title="{{ trans('general.actions.play') }}">
                    <i class="mdi mdi-play-circle-outline"></i>
                </button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
