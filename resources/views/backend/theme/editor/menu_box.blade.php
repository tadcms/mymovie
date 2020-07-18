@php
    $menu_id = 0;
    if (isset($option_card[$input['name']]['menu'])) {
        $menu_id = intval($option_card[$input['name']]['menu']);
    }
    $menu = $menu_info($menu_id, $shop_id);
@endphp

<div class="theme-setting theme-setting--text editor-item">
    <label class="next-label">{{ trans('main.menu') }}</label>
    <select name="{{ $card['code'] }}[{{ $input['name'] }}][menu]" class="load-menu">
        @if($menu->id)
            <option value="{{ $menu->id }}">{{ $menu->name }}</option>
        @endif
    </select>
</div>