<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class GeoLocation extends Component
{
    public string $latitudeField;

    public string $longitudeField;

    public string $accuracyField;

    public ?string $latitudeValue;

    public ?string $longitudeValue;

    public ?string $accuracyValue;

    public function __construct(
        string $latitudeField,
        string $longitudeField,
        string $accuracyField,
        ?string $latitudeValue = null,
        ?string $longitudeValue = null,
        ?string $accuracyValue = null,
    ) {

        $this->latitudeField =
            $latitudeField;

        $this->longitudeField =
            $longitudeField;

        $this->accuracyField =
            $accuracyField;

        $this->latitudeValue =
            $latitudeValue;

        $this->longitudeValue =
            $longitudeValue;

        $this->accuracyValue =
            $accuracyValue;
    }

    public function render(): View|Closure|string
    {
        return view(
            'components.geo-location'
        );
    }
}