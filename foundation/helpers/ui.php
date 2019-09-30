<?php

namespace ui {

    use Arcanedev\Html\Elements\Span;
    use Arcanesoft\Foundation\Helpers\UI\Actions\ButtonAction;
    use Arcanesoft\Foundation\Helpers\UI\Actions\LinkAction;
    use Closure;

    /**
     * @param  string  $name
     * @param  string  $url
     *
     * @return \Arcanesoft\Foundation\Helpers\UI\Actions\LinkAction
     */
    function action_link(string $name, string $url) {
        return LinkAction::action($name, $url);
    }

    /**
     * @param  string  $name
     * @param  string  $url
     *
     * @return \Arcanesoft\Foundation\Helpers\UI\Actions\LinkAction
     */
    function action_link_icon(string $name, string $url) {
        return LinkAction::action($name, $url, false);
    }

    /**
     * @param  string  $name
     *
     * @return \Arcanesoft\Foundation\Helpers\UI\Actions\ButtonAction|mixed
     */
    function action_button(string $name) {
        return ButtonAction::action($name);
    }

    /**
     * @param  string  $name
     *
     * @return \Arcanesoft\Foundation\Helpers\UI\Actions\ButtonAction
     */
    function action_button_icon($name) {
        return ButtonAction::action($name, false);
    }

    /**
     * @param  int|float      $count
     * @param  \Closure|null  $condition
     *
     * @return \Arcanedev\Html\Elements\Span
     */
    function count_pill($count, Closure $condition = null)
    {
        if (is_null($condition))
            $condition = function ($count) { return $count > 0 ? 'badge-info' : 'badge-light'; };

        return Span::make()
            ->class(['badge', 'badge-pill', $condition($count)])
            ->text($count);
    }
}
