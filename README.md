Mukadi ChartJs Bundle
=================
Build awesome charts directly from ORM Entities, using `MukadiChartJsBundle` to create
high quality chart mapped directly to your data model.
`MukadiChartJsBundle` is an adaptation of the [mukadi/chartjs-builder](https://github.com/mbo2olivier/mukadi-chartjs-builder) package for symfony, Here are some provided features:

* a service for build chart from DQL queries and native SQL queries
* a Twig extension for render chart in the view

## Installation

Install the bundle via composer by running the following command:

 `php composer.phar require mukadi/chartjs-bundle`

And run `php bin/console assets:install` for installing assets in the public web directory

## Chart Factory

The bundle provide the `Mukadi\ChartJSBundle\Factory\ChartFactory` service (or `@mukadi.chart.factory` if you are not using autowiring):

You can use chart factory like any other symfony service:

``` php
namespace App\Controller;

use App\Chart\VideoGame;
use Mukadi\ChartJSBundle\Factory\ChartFactory;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AppController extends AbstractController{

    #[Route('/', name: 'app_app')]
    public function index(ChartFactory $factory): Response {
        $chart = $factory
                ->withDql() # if you plan to use DQL query
                ->createChartBuilder()
                ->asBar()
                    ->query("SELECT COUNT(j) total, AVG(j.prix) prix, j.console console FROM \App\Entity\VideoGame j group by j.console")
                    ->labels('console')
                    ->dataset("Prix moyen")
                        ->data('prix')->useRandomBackgroundColor()
                    ->end()
                    ->dataset("Nombre")
                        ->data('total')->useRandomBackgroundColor()
                    ->end()
                ->build()
                ->getChart()
                ;

        $chart2 = $factory
                ->withNativeSql() # if you gonna use native SQL query
                ->createChartBuilder()
                ->asBar()
                    ->query("SELECT COUNT(*) total, AVG(prix) prix, console FROM jeux_video GROUP BY console")
                    ->labels('console')
                    ->dataset("Prix moyen")
                        ->data('prix')->useRandomBackgroundColor()
                    ->end()
                    ->dataset("Nombre")
                        ->data('total')->useRandomBackgroundColor()
                    ->end()
                ->build()
                ->getChart()
                ;

        return $this->render('app/index.html.twig', [
            'chart' => $chart,
            'chart2' => $chart2,
        ]);
    }
}
```
Please, see the [mukadi/chartjs-builder documentation](https://github.com/mbo2olivier/mukadi-chartjs-builder) if you want to learn more about chart construction.

## Render chart in twig template

In twig template use the dedicated function for chart rendering:

``` jinja
{{ mukadi_chart(chart) }}
```
Don't forget to include libraries in your page:

``` html
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/4.2.1/chart.umd.min.js"></script>
<script src="/bundles/mukadichartjs/mukadi.chart.min.js"></script>

```
And that's all !

## Use chart definitions
The Charts definition is an elegant way to build your charts in separate classes, so you get a more readable code and also reusable charts (a very powerful feature when combining with parametrized query). Read more about chart definition in the core [mukadi/chartjs-builder](https://github.com/mbo2olivier/mukadi-chartjs-builder) library.

Create your chart by implementing the `Mukadi\Chart\ChartDefinitionInterface` interface:
``` php
namespace App\Chart;

use Mukadi\Chart\ChartDefinitionBuilderInterface;
use Mukadi\Chart\ChartDefinitionInterface;

class VideoGameChart implements ChartDefinitionInterface {
    
    public function define(ChartDefinitionBuilderInterface $builder): void
    {
        $sql = "SELECT COUNT(*) total, AVG(prix) prix, console FROM jeux_video WHERE possesseur = :possesseur GROUP BY console";

        $builder
            ->asPolarArea()
            ->query($sql)
            ->labels('console')
            ->dataset("Total")
                ->data('total')->useRandomBackgroundColor()
            ->end()
            ->dataset("Prix moyen")
                ->data('prix')->useRandomBackgroundColor()
            ->end()
        ;
    }
}
```

In your controller you only have to write this:
```php
 $chart = $factory
                ->withNativeSql()
                ->createFromDefinition(VideoGameChart::class)
                ->setParameter(':possesseur', 'Michel')
                ->getChart()
                ;
```

Note: you can use the FCQN of the chart definition only if the class is managed by the DI component, if you are using the standard symfony `services.yml` file so it's automatically handled for you, if you don't you must do it by yourself. 