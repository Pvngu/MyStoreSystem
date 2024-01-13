<?php

namespace App\View\Components\Table;

use Closure;
use Hamcrest\Arrays\IsArray;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Table extends Component
{
    public array $headers;
    public $action;
    /**
     * Create a new component instance.
     */
    public function __construct(array $headers, $action)
    {
        $this->headers = $this->formatHeaders($headers);
        $this->action = $action;
        
    }

    private function formatHeaders(array $headers): array {
        return array_map(function ($header) {
            $name = is_array($header) ? $header['name'] : $header;

            return [
                'name' =>$name,
                'column_type' =>$header['column_type'] ?? 'none',
                'classes' => $this->textAlignClasses($header['align'] ?? 'none')
            ];
        }, $headers);
    }

    private function textAlignClasses($align): string {
        return [
            'none' => '',
            'center' => 'center-cell'
        ][$align] ?? '';
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.table.table');
    }
}
