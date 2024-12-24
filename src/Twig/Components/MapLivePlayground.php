<?php

namespace App\Twig\Components;

use Symfony\UX\LiveComponent\Attribute\AsLiveComponent;
use Symfony\UX\LiveComponent\DefaultActionTrait;
use Symfony\UX\Map\InfoWindow;
use Symfony\UX\Map\Live\ComponentWithMapTrait;
use Symfony\UX\Map\Map;
use Symfony\UX\Map\Marker;
use Symfony\UX\Map\Point;
use Symfony\UX\Map\Polygon;

#[AsLiveComponent]
final class MapLivePlayground
{
    use DefaultActionTrait;
    use ComponentWithMapTrait;

    protected function instantiateMap(): Map
    {
        return (new Map())
            ->center(new Point(6.267199740707546, 1.4042545237519999))
            ->zoom(7)
            ->addMarker(new Marker(position: new Point(6.18535077384321, 1.241704475378409), title: 'Lome',
                infoWindow:   new InfoWindow(
                headerContent: '<b>Lyon</b>',
                content: 'The French town in the historic Rhône-Alpes region, located at the junction of the Rhône and Saône rivers.'
            )))->fitBoundsToMarkers()
            ->addPolygon(new Polygon(
                points: [
                    new Point(48.8566, 2.3522),
                    new Point(45.7640, 4.8357),
                    new Point(43.2965, 5.3698),
                    new Point(44.8378, -0.5792),
                ],
                infoWindow: new InfoWindow(
                    content: 'Paris, Lyon, Marseille, Bordeaux',
                ))
            )
            ;
    }
}
