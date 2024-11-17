<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class FormInput extends Component
{
    /**
     * Create a new component instance.
     */
    public string $name;
    public string $label;
    public string $placeholder;
    public string $type;
    public string $isRequired;
    public array $data;


    public function __construct(array $data = null,string $name, string $label, string $placeholder = '', string $type = 'text', string $isRequired='true')
    {
        $this->name = $name;
        $this->label = $label;
        $this->placeholder = $placeholder;
        $this->type = $type;
        $this->isRequired = $isRequired;
        $this->data=$data;
    }


    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.form-input',['data'=>$this->data]);
    }
}
