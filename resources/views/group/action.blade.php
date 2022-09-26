<div class="flex align-items-center list-user-action">
    <a href="#" title="{{ trans('messages.update_form_title',['form' => trans('messages.user') ]) }}"><i class="ri-pencil-line"></i></a>
    <a href="#" title="{{ trans('messages.delete_form_title',['form'=>  trans('messages.user') ]) }}"  onclick="return confirm('{{ trans('messages.delete_form_message',['form' => trans('messages.user')]) }}')"><i class="ri-delete-bin-line"></i></a>
</div>