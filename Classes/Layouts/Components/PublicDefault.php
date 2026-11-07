<?php

namespace Themes\FocusDefaultTheme\Classes\Layouts\Components;

use Illuminate\View\Component;
use Illuminate\View\View;
use App\Models\Option;

class PublicDefault extends Component
{
    public $currentTheme;
    public ?string $isMinimalViewFromController;
    public ?array $sidebars;
    public array $features; // 👈 EZ HIÁNYZOTT

    public function __construct(
        $isMinimalViewFromController = null,
        array $features = [] // 👈 alapértelmezett
    ) {
        $this->currentTheme = app('options.repository')->get(
            'currentThemeName',
            'FocusDefaultTheme'
        );

        $this->isMinimalViewFromController = $isMinimalViewFromController;
        $this->features = $features; // 👈 ELMENTJÜK

        $sidebars = Option::where('name', 'like', "ts_{$this->currentTheme}_sidebar_%")
            ->get()
            ->pluck('value', 'name')
            ->toArray();

        if (!empty($sidebars)) {
            foreach ($sidebars as &$val) {
                $val = empty($val) ? null : markdownToHtml($val);
            }
        }

        $this->sidebars = $sidebars;
    }

    public function render(): View
    {
        return view('theme::layouts.components.public-default');
    }
}
